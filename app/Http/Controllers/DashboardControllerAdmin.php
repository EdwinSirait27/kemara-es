<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\User;
use App\Models\Siswa;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Rules\NoXSSInput;

use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
class DashboardControllerAdmin extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function getPengumuman()
    {
    $pengumuman = Pengumuman::select(['id', 'pengumuman', 'deskripsi', 'created_at'])
        ->get()
        ->map(function ($item) {
            $item->pengumuman = basename($item->pengumuman);
            $item->created_at = Carbon::parse($item->created_at)->format('d-m-Y H:i:s');        
            $item->action = '<a href="' . route('download.pengumuman', ['id' => $item->id]) . '" class="btn btn-sm btn-primary">Download</a>';
            $item->checkbox = '<input type="checkbox" class="pengumuman-checkbox" value="' . $item->id . '">';
            return $item;
        });
    return DataTables::of($pengumuman)
        ->rawColumns(['action','checkbox'])
        ->make(true);
    }
    public function store(Request $request)
    {
    if (!$request->hasFile('pengumuman')) {
        session()->flash('error', 'Anda harus mengunggah dokumen!');
        return redirect()->route('dashboardAdmin.index');
    } else {
        $this->validate($request, [
            'pengumuman' => ['required', 'mimes:doc,docx,pdf,xls,xlsx,ppt,pptx,png,jpeg', 'max:5120', new NoXSSInput()],

          
        ]);
        $pengumuman = $request->file('pengumuman');
        $nama_pengumuman = $pengumuman->getClientOriginalName();
        $pengumuman->storeAs('public/pengumuman', $nama_pengumuman);
        $user = Auth::user();
        $data = new Pengumuman();
        $data->pengumuman = $nama_pengumuman;
        $data->deskripsi=$user->hakakses;
        $data->save();
        session()->flash('success', 'Dokumen berhasil diunggah.');
        return redirect()->route('dashboardAdmin.index');
    
    }
    }
    
    
    
    public function deletePengumuman(Request $request)
    {
        $request->validate([
            'ids' => ['required', 'arrau', 'min:1', new NoXSSInput()],
            
        ]);
    
        $pengumumanList = Pengumuman::whereIn('id', $request->ids)->get();
    
        foreach ($pengumumanList as $pengumuman) {
            if ($pengumuman->pengumuman && Storage::exists('public/pengumuman/' . $pengumuman->pengumuman)) {
                Storage::delete('public/pengumuman/' . $pengumuman->pengumuman);
            }
        }
    
        // Hapus data pengumuman dari database
        Pengumuman::whereIn('id', $request->ids)->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Selected pengumuman and their related files deleted successfully.',
        ]);
    }
    public function index(Request $request)
    {
        $pengumuman = Pengumuman::all();
        $totaluser = User::count();
        $totallaki = User::whereHas('Siswa', function ($query) {
            $query->where('JenisKelamin', 'Laki-Laki');
        })->count();
        $totalperempuan = User::whereHas('Siswa', function ($query) {
            $query->where('JenisKelamin', 'Perempuan');
        })->count();
       
        $katolik = User::whereHas('Siswa', function ($query) {
            $query->where('Agama', 'Katolik');
        })->count();
        $kristen = User::whereHas('Siswa', function ($query) {
            $query->where('Agama', 'Kristen Protestan');
        })->count();
        $islam = User::whereHas('Siswa', function ($query) {
            $query->where('Agama', 'Islam');
        })->count();
        $hindu = User::whereHas('Siswa', function ($query) {
            $query->where('Agama', 'Hindu');
        })->count();
        $buddha = User::whereHas('Siswa', function ($query) {
            $query->where('Agama', 'Buddha');
        })->count();
        $kong = User::whereHas('Siswa', function ($query) {
            $query->where('Agama', 'Konghucu');
        })->count();
        // $katolik = Siswa::whereIn('Agama', ['Katolik'])
        //     ->count();
        // $kristen = Siswa::whereIn('Agama', ['Kristen Protestan'])
        //     ->count();
        // $islam = Siswa::whereIn('Agama', ['Islam'])
        //     ->count();
        // $hindu = Siswa::whereIn('Agama', ['Hindu'])
        //     ->count();
        // $buddha = Siswa::whereIn('Agama', ['Buddha'])
        //     ->count();
        // $kong = Siswa::whereIn('Agama', ['Konghucu'])
        //     ->count();
            $tahunDipilih = $request->input('tahun');

            // Query untuk menghitung jumlah user
            $query = User::whereIn('hakakses', ['NonSiswa', 'Siswa']);
        
            if ($tahunDipilih) {
                $query->whereYear('created_at', $tahunDipilih);
            }
        
            // Hitung jumlah pengguna berdasarkan filter
            $ppdb = $query->count();
        
            // Ambil daftar tahun unik untuk dropdown filter
            $tahunList = User::selectRaw('YEAR(created_at) as tahun')
                             ->distinct()
                             ->orderBy('tahun', 'desc')
                             ->pluck('tahun');
            // $tahunDipilih = $request->input('tahun', date('Y'));

            // // Query untuk menghitung jumlah user berdasarkan tahun yang dipilih
            // $ppdb = User::whereIn('hakakses', ['NonSiswa', 'Siswa'])
            //             ->whereYear('created_at', $tahunDipilih)
            //             ->count();
        
            // // Ambil daftar tahun unik untuk dropdown filter
            // $tahunList = User::selectRaw('YEAR(created_at) as tahun')
            //                  ->distinct()
            //                  ->orderBy('tahun', 'desc')
            //                  ->pluck('tahun');
        return view('dashboardAdmin.dashboardAdmin', compact('totaluser', 'totallaki', 'totalperempuan', 'katolik', 'kristen', 'islam', 'hindu', 'buddha', 'kong','pengumuman','ppdb', 'tahunDipilih', 'tahunList'));
    }
    

}
