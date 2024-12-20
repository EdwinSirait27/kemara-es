<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Facades\Log;

use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Rules\NoXSSInput;

class SiswalulusController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('Siswalulus.index');

    }
    public function indexSiswalulusall()
    {
        return view('Siswalulusall.index');

    }
    public function create()
    {
        return view('Siswalulus.create');
    }
    public function getSiswalulus()
    {
        $users = User::with('Siswa')
    ->select(['id', 'siswa_id', 'hakakses', 'created_at'])
    ->whereIn('hakakses', ['Siswa'])
    ->whereHas('Siswa', function ($query) {
        $query->whereIn('status', ['Lulus']);
    })
    ->get()
            ->map(function ($user) {
                $user->id_hashed = substr(hash('sha256', $user->siswa_id . env('APP_KEY')), 0, 8);
                $user->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $user->siswa_id . '">';
                $user->Siswa_Nama = $user->Siswa ? $user->Siswa->NamaLengkap : '-';
                $user->Siswa_NomorTelephone = $user->Siswa ? $user->Siswa->NomorTelephone : '-';
                $user->Siswa_NomorTelephoneAyah = $user->Siswa ? $user->Siswa->NomorTelephoneAyah : '-';
                $user->Siswa_Alamat = $user->Siswa ? $user->Siswa->Alamat : '-';
                $user->Siswa_Email = $user->Siswa ? $user->Siswa->Email : '-';
                $user->Siswa_TamatBelajarTahun = $user->Siswa ? $user->Siswa->TamatBelajarTahun : '-';
                $user->Siswa_Status = $user->Siswa ? $user->Siswa->status : '-';
              
                return $user;
            });
        return DataTables::of($users)
        ->rawColumns(['checkbox'])
        ->addColumn('created_at', function ($user) {
            return Carbon::parse($user->created_at)->format('Y-m-d');
        })

            ->make(true);

    }
    public function getSiswalulusall()
    {
        // $siswa = Siswa::all()->load('user')->makeHidden(['foto'])

        $siswa = Siswa::all()
        ->load('user')
        ->makeHidden(['foto'])
        ->filter(function ($item) {
            return $item->status === 'Lulus';
        })
    
            ->map(function ($siswa) {
                $siswa->id_hashed = substr(hash('sha256', $siswa->siswa_id . env('APP_KEY')), 0, 8);

                return $siswa;
            });
            // $siswa->created_at = $siswa->User ? $siswa->User->created_at : '-';
        return DataTables::of($siswa)
        ->addColumn('created_at', function ($siswa) {
            return Carbon::parse($siswa->user->created_at)->format('Y-m-d');
        })
            ->make(true);
    }
    public function updateStatusalumni(Request $request)
{
    try {
        Log::info('Request diterima untuk update status:', ['payload' => $request->all()]);

        $request->validate([
            'siswa_ids' => ['required','array', new NoXSSInput()],
            'siswa_ids.*' => ['string','exists:tb_siswa,siswa_id',new NoXSSInput()],
        ]);

        Log::info('Siswa IDs yang akan diperbarui:', ['siswa_ids' => $request->siswa_ids]);

        $affectedRows = Siswa::whereIn('siswa_id', $request->siswa_ids)
            ->update(['status' => 'Alumni']);

        Log::info('Jumlah baris yang diperbarui:', ['affected_rows' => $affectedRows]);

        return response()->json([
            'message' => 'Status berhasil diperbarui!',
        ]);
    } catch (\Exception $e) {
        Log::error('Terjadi kesalahan saat update status:', [
            'error_message' => $e->getMessage(),
            'error_trace' => $e->getTraceAsString(),
        ]);

        // Response dengan error
        return response()->json([
            'message' => 'Terjadi kesalahan saat memperbarui status!',
            'error' => $e->getMessage(),
        ], 500);
    }
}

}
