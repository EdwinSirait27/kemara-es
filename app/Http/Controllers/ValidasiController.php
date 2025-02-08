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
class ValidasiController extends Controller
{
    public function index()
    {
        return view('Validasi.index');

    }
    public function getValidasi()
    {
        $pembayaran = Pembayaran::with('Siswa')
            ->select(['id', 'siswa_id', 'status', 'tanggalbukti', 'ket','created_at'])
            ->get()
            ->map(function ($user) {
                $user->id_hashed = substr(hash('sha256', $user->id . env('APP_KEY')), 0, 8);
                // $user->created_at = Carbon::parse($user->created_at)->format('d-m-Y'); $user->Role = implode(', ', explode(',', $user->Role));
                $user->action = '
            <a href="' . route('Validasi.edit', $user->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
                $user->Siswa_Nama = $user->Siswa ? $user->Siswa->NamaLengkap : '-';
                return $user;
            });
        return DataTables::of($pembayaran)
        ->addColumn('NamaLengkap', function ($pembayaran) {
            return $pembayaran->Siswa ? $pembayaran->Siswa->NamaLengkap : '-';
        })
        
        ->addColumn('foto', function ($pembayaran) {
            return $pembayaran->foto;
        })
            ->rawColumns([ 'action'])
            ->make(true);

    }   
    public function edit($hashedId)
{
    $pembayaran = Pembayaran::with('Siswa')->get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });
    if (!$pembayaran) {
        abort(404, 'Tahun akademik not found.');
    }
    return view('Validasi.edit', compact('pembayaran', 'hashedId'));
}
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
        'status' => ['required','in:Dalam Antrian,Lunas,Menyicil'], 
        'ket' => ['required','string','max:255'], 
    ], [
        'ket.required' => 'keterangan wajib diisi.',
       
        
]);
    $pembayaran->update([
        
        'status' => $request->status,
        'ket' => $request->ket,
    ]);

    return redirect()
        ->route('Validasi.index')
        ->with('success', 'Bukti pembayaran berhasil diupdate.');
}
}
