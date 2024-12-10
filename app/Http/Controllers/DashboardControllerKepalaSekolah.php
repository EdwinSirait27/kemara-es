<?php

namespace App\Http\Controllers;


use App\Models\Pengumuman;
use App\Models\User;
use App\Models\Siswa;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DashboardControllerKepalaSekolah extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        $pengumuman = Pengumuman::all();
        $totaluser = User::count();
        $totallaki = User::whereHas('Siswa', function ($query) {
            $query->where('JenisKelamin', 'Laki-Laki');
        })->count();
        $totalperempuan = User::whereHas('Siswa', function ($query) {
            $query->where('JenisKelamin', 'Perempuan');
        })->count();
        $totalguru = User::whereIn('hakakses', ['SU', 'Guru', 'Admin', 'KepalaSekolah', 'Kurikulum'])
            ->count();
        $katolik = Siswa::whereIn('Agama', ['Katolik'])
            ->count();
        $kristen = Siswa::whereIn('Agama', ['Kristen Protestan'])
            ->count();
        $islam = Siswa::whereIn('Agama', ['Islam'])
            ->count();
        $hindu = Siswa::whereIn('Agama', ['Hindu'])
            ->count();
        $buddha = Siswa::whereIn('Agama', ['Buddha'])
            ->count();
        $kong = Siswa::whereIn('Agama', ['Konghucu'])
            ->count();

        return view('dashboardKepalaSekolah.dashboardKepalaSekolah', compact('totaluser', 'totallaki', 'totalperempuan', 'totalguru', 'katolik', 'kristen', 'islam', 'hindu', 'buddha', 'kong','pengumuman'));
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
        return redirect()->route('dashboardKepalaSekolah.index');
    } else {
        $this->validate($request, [
            'pengumuman' => 'mimes:doc,docx,pdf,xls,xlsx,ppt,pptx,png,jpeg|max:5120',
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
        return redirect()->route('dashboardKepalaSekolah.index');

    }
}



    public function deletePengumuman(Request $request)
    {
        $request->validate([
            'ids' => 'required|array|min:1',
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
    
}
