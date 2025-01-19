<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voting;
use App\Models\Hasilvoting;
use App\Models\Osis;
use App\Models\Tombol;
use App\Models\Siswa;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Rules\NoXSSInput;

class VotingController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        $osiss = Osis::with('Siswa')->get();
        $votingg = Voting::get();
        $siswaList = Siswa::pluck('NamaLengkap');

        $voting = Tombol::where('url', 'Voting')->first();
        if (!$voting) {
            return $this->redirectToDashboard()->with('warning', 'Pemilihan Ketua Osis masih tertutup.');
        }

        $start_date = Carbon::parse($voting->start_date);
        $end_date = Carbon::parse($voting->end_date);

        if (Carbon::now()->between($start_date, $end_date)) {
            return view('Voting.Voting', compact('siswaList','osiss', 'votingg'));
        }

        return $this->redirectToDashboard()->with('warning', 'Data Pemilihan Ketua Osis tidak tersedia.');

    }
    public function store(Request $request)
{
    // dd($request->all());
    $request->validate([
        'osis_id' => ['required', 'array', 'min:1', 'max:1' ,'unique:tb_voting,osis_id', new NoXSSInput()],
        'osis_id.*' => ['exists:tb_osis,id', new NoXSSInput()],
    ], [
        'osis_id.required' => 'Anda harus memilih salah satu kandidat.',
        'osis_id.max' => 'Hanya diperbolehkan memilih 1 kandidat.',
        // 'password.min' => 'Password tidak boleh kurang dari 7 karakter.',
    ]);
    $user = Auth::user();
    $user_id = $user->id;
    $already_voted = Voting::where('user_id', $user_id)->exists();
    if ($already_voted) {
        return back()->withErrors(['error' => 'Anda sudah memberikan suara.']);
    }
    $osis_ids = $request->input('osis_id');
    foreach ($osis_ids as $osis_id) {
        $voting = new Voting([
            'user_id' => $user_id,
            'osis_id' => $osis_id,
            'tanggal' => now(),
        ]);
        $voting->save();  
    }
    $hasil_voting = Hasilvoting::updateOrCreate(
        ['osis_id' => $osis_id],
        ['jumlahsuara' => hasilvoting::where('osis_id', $osis_id)->count() + 1]
    );

    return redirect()->route('Voting.index')->with('success', 'Terimakasih telah memberikan hak suara anda :).');
}

    private function redirectToDashboard()
    {
        if (Gate::allows('isSU')) {
            return redirect()->route('dashboardSU.index');
        } elseif (Gate::allows('isKepalaSekolah')) {
            return redirect()->route('dashboardKepalaSekolah.index');
        } elseif (Gate::allows('isAdmin')) {
            return redirect()->route('dashboardAdmin.index');
        } elseif (Gate::allows('isGuru')) {
            return redirect()->route('dashboardGuru.index');
        } elseif (Gate::allows('isKurikulum')) {
            return redirect()->route('dashboardKurikulum.index');
        } elseif (Gate::allows('isSiswa')) {
            return redirect()->route('dashboardSiswa.index');
        } else {
            return redirect('logout');
        }
    }
    public function getVoting(Request $request)
{
    // Ambil parameter filter dari request (jika ada)
    $filterNamaLengkap = $request->input('NamaLengkap');

    // Query Voting dengan relasi
    $voting = Voting::with('User', 'Osis.Siswa') // Pastikan relasi sudah benar
        ->select(['user_id', 'osis_id', 'created_at']);

    // Jika ada filter NamaLengkap, tambahkan kondisi where
    if ($filterNamaLengkap) {
        $voting->whereHas('Osis.Siswa', function ($query) use ($filterNamaLengkap) {
            $query->where('NamaLengkap', $filterNamaLengkap);
        });
    }

    // Transformasi data dengan map
    $voting = $voting->get()->map(function ($voting) {
        $voting->Semua_Nama = $voting->User ? $voting->User->hakakses : '-';
        $voting->SiswaOsis_Nama = $voting->Osis && $voting->Osis->Siswa ? $voting->Osis->Siswa->NamaLengkap : '-';
        return $voting;
    });

    // Return data ke DataTables
    return DataTables::of($voting)
        ->addColumn('SiswaOsis_Nama', function ($voting) {
            return $voting->SiswaOsis_Nama;
        })
        ->addColumn('Semua_Nama', function ($voting) {
            return $voting->Semua_Nama;
        })
        ->addColumn('created_at', function ($voting) {
            return Carbon::parse($voting->created_at)->format('d-m-Y H:i:s');
        })
        ->make(true);
}


//     public function getVoting()
// {
//     $voting = Voting::with('User', 'Osis.Siswa') // Pastikan relasi sudah benar
//         ->select(['id', 'user_id', 'osis_id', 'created_at'])
//         ->get()
//         ->map(function ($voting) {
//             // Log relasi untuk debugging
//             Log::info('Voting Data:', [
//                 'User' => $voting->User,
//                 'Osis' => $voting->Osis,
               
//             ]);

//             $voting->Semua_Nama = $voting->User ? $voting->User->hakakses : '-';
//             $voting->SiswaOsis_Nama = $voting->Osis->Siswa ? $voting->Osis->Siswa->NamaLengkap : '-';

//             return $voting;
//         });

//     return DataTables::of($voting)
//     ->addColumn('SiswaOsis_Nama', function ($voting) {
//         return $voting->SiswaOsis_Nama; // Pastikan data ini ada
//     })
//     ->addColumn('Semua_Nama', function ($voting) {
//         return $voting->Semua_Nama; // Pastikan data ini ada
//     })   
//     ->addColumn('created_at', function ($voting) {
//             return Carbon::parse($voting->created_at)->format('d-m-Y H:i:s');
//         })
//         ->make(true);
// }
    public function getHasil()
{
    $hasil = Hasilvoting::with( 'Osis.Siswa') // Pastikan relasi sudah benar
        ->select(['id',  'osis_id', 'jumlahsuara'])
        ->get()
        ->map(function ($hasil) {
            // Log relasi untuk debugging
            Log::info('Voting Data:', [
                'Osis' => $hasil->Osis,
               
            ]);

            $hasil->Semua_Nama = $hasil->Osis->Siswa ? $hasil->Osis->Siswa->NamaLengkap : '-';
            
            return $hasil;
        });

    return DataTables::of($hasil)
    ->addColumn('Semua_Nama', function ($hasil) {
        return $hasil->Semua_Nama; // Pastikan data ini ada
    })
    
        ->make(true);
}

    // public function getVoting()
    // {
    //     $voting = Voting::with('User','Osis','Siswa')->select(['id', 'user_id','osis_id','created_at'])
    //         ->get()
    //         ->map(function ($voting) {
                
    //         $voting->Semua_Nama = $voting->User ? $voting->User->hakakses : '-';
    //         $voting->SiswaOsis_Nama = $voting->Osis ? $voting->Osis->osis_id : '-';
            
    //             return $voting;
    //         });
    //     return DataTables::of($voting)
    //     ->addColumn('created_at', function ($voting) {
    //         return Carbon::parse($voting->created_at)->format('d-m-Y H:i:s');
    //     })
    //         ->make(true);
    // }
}
