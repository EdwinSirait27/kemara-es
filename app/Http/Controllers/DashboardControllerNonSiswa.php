<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengumuman;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;




class DashboardControllerNonSiswa extends Controller
{
    public function index()
    {
        return view('dashboardNonSiswa.dashboardNonSiswa');

    }
    public function create()
    {
        $user = auth()->user()->load('Siswa'); 
        return view('dashboardNonSiswa.create', compact('user'));
    }
    public function getPengumuman()
    {
        $pengumuman = Pengumuman::select(['id', 'pengumuman', 'deskripsi', 'created_at'])
            ->get()
            ->map(function ($item) {
                $item->pengumuman = basename($item->pengumuman);
                $item->action = '<a href="' . route('download.pengumuman', ['id' => $item->id]) . '" class="btn btn-sm btn-primary">Download</a>';
                return $item;
            });
        return DataTables::of($pengumuman)
            ->rawColumns(['action'])
            ->make(true);
    }
    
    
    public function getPembayaran()
{
    $user = auth()->user()->load('Siswa'); 

    $pembayaran = Pembayaran::with('Siswa')
        ->whereHas('Siswa', function ($query) use ($user) {
            $query->where('siswa_id', $user->siswa_id);
        })
        ->select(['id', 'siswa_id', 'status', 'foto', 'tanggalbukti','ket','created_at'])
        ->get()
        ->map(function ($pembayaran) {
            $pembayaran->id_hashed = substr(hash('sha256', $pembayaran->id . env('APP_KEY')), 0, 8);

            // Cek status pembayaran
            if ($pembayaran->status === 'Lunas' || $pembayaran->status === 'Menyicil') 
            {
                $pembayaran->action = '
                    <span class="text-muted" data-bs-toggle="tooltip" data-bs-original-title="Action terkunci karena status Lunas atau Menyicil">
                        <i class="fas fa-lock text-secondary"></i>
                    </span>';
            } else {
                $pembayaran->action = '
                    <a href="' . route('dashboardNonSiswa.edit', $pembayaran->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                        <i class="fas fa-user-edit text-secondary"></i>
                    </a>';
            }

            // $pembayaran->foto = $pembayaran->foto ? $pembayaran->foto : 'kosong';
            $pembayaran->Siswa_Nama = $pembayaran->Siswa ? $pembayaran->Siswa->NamaLengkap : '-';

            return $pembayaran;
        });

    return DataTables::of($pembayaran)
    ->addColumn('NamaLengkap', function ($pembayaran) {
        return $pembayaran->Siswa->NamaLengkap;
    })
    // ->addColumn('foto', function ($pembayaran) {
    //     return $pembayaran->foto;
    // })
        ->rawColumns(['action'])
        ->make(true);
}
//     public function getPembayaran()
//     {
//         $user = auth()->user()->load('Siswa'); 

//         $pembayaran = Pembayaran::with('Siswa')
//         ->whereHas('Siswa', function ($query) use ($user) {
//             $query->where('siswa_id', $user->siswa_id);
//         })
//         ->select(['id','siswa_id','status','foto','tanggalbukti','created_at'])
//         ->get()
//         ->map(function ($pembayaran) {
//             $pembayaran->id_hashed = substr(hash('sha256', $pembayaran->id . env('APP_KEY')), 0, 8);

//             $pembayaran->action = '
//                 <a href="' . route('dashboardNonSiswa.edit', $pembayaran->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
//                     <i class="fas fa-user-edit text-secondary"></i>
//                 </a>';
            
//                 $pembayaran->foto = $pembayaran->foto ? $pembayaran->foto : 'we.jpg';
//                 $pembayaran->Siswa_Nama = $pembayaran->Siswa ? $pembayaran->Siswa->NamaLengkap : '-';
                
//             return $pembayaran;
//         });

//     return DataTables::of($pembayaran)
//     ->addColumn('NamaLengkap', function ($pembayaran) {
//         return $pembayaran->Siswa->NamaLengkap;
//     })
//     ->addColumn('foto', function ($pembayaran) {
//         return $pembayaran->foto;
//     })
//         ->rawColumns(['action'])
//         ->make(true);
// }
public function edit($hashedId)
{
    $pembayaran = Pembayaran::with('Siswa')->get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });
    if (!$pembayaran) {
        abort(404, 'Tahun akademik not found.');
    }
    // $kurikulums = Kurikulum::all();

    return view('dashboardNonSiswa.edit', compact('pembayaran', 'hashedId'));
}

// Fungsi Update
public function update(Request $request, $hashedId)
{
    // Find the payment record using hashed ID
    $pembayaran = Pembayaran::with('Siswa')->get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });

    if (!$pembayaran) {
        abort(404, 'Pembayaran not found.');
    }

    // Validate request
    $request->validate([
        'foto' => ['required','image','mimes:jpeg,png,jpg','max:1024'],
        
    ],
[
    'foto.required' => 'foto wajib diisi',
    'foto.mimes' => 'foto harus bertipe jpeg,png,jpg',
    'foto.max' => 'foto harus kurang dari 1024 kb',
    'foto.image' => 'foto harus berupa gambar',
    
]);

    // Handle file upload
    if ($request->hasFile('foto')) {
        // Delete old file if exists
        if ($pembayaran->foto) {
            Storage::delete('public/bukti_pembayaran/' . $pembayaran->foto);
        }

        // Store new file
        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/bukti_pembayaran', $filename);

        // Update pembayaran record
        $pembayaran->update([
            'foto' => $filename,
            'status' => 'Dalam Antrian',
            'tanggalbukti' => Carbon::now()
        ]);
    }

    return redirect()
        ->route('dashboardNonSiswa.index')
        ->with('success', 'Bukti pembayaran berhasil diupdate.');
}
}
