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
class DashboardControllerAdmin extends Controller
{
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

        return view('dashboardAdmin.dashboardAdmin', compact('totaluser', 'totallaki', 'totalperempuan', 'totalguru', 'katolik', 'kristen', 'islam', 'hindu', 'buddha', 'kong','pengumuman'));
    }
    public function getPengumuman()
{
    $pengumuman = Pengumuman::select(['id', 'pengumuman', 'deskripsi', 'created_at'])
        ->get()
        ->map(function ($item) {
            $item->pengumuman = basename($item->pengumuman);

            $item->created_at = Carbon::parse($item->created_at)->format('d-m-Y H:i:s');        
            $item->checkbox = '<input type="checkbox" class="pengumuman-checkbox" value="' . $item->id . '">';
            return $item;
        });
    return DataTables::of($pengumuman)
        ->rawColumns(['checkbox'])
        ->make(true);
}
public function store(Request $request)
{
    if (!$request->hasFile('pengumuman')) {
        session()->flash('error', 'Anda harus mengunggah dokumen!');
        return redirect()->route('dashboardAdmin.index');
    } else {
        $this->validate($request, [
            'pengumuman' => 'mimes:doc,docx,pdf,xls,xlsx,ppt,pptx',
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
// public function store(Request $request)
// {
//     $request->validate([
//         'pengumuman' => 'required|mimes:pdf,docx,xlsx|max:512',
//         'deskripsi' => 'required|string|max:255', 
//     ]);

//     if ($request->hasFile('pengumuman')) {
//         $file = $request->file('pengumuman');
//         $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
//         $filePath = $file->storeAs('public/pengumuman', $fileName);

//         Pengumuman::create([
//             'pengumuman' => $filePath, // Menyimpan path
//             'file_name' => $fileName, // Menyimpan nama file asli
//             'deskripsi' => $request->deskripsi,
//         ]);
//     }

//     return redirect()->route('dashboardAdmin.index')->with('success', 'Pengumuman created successfully!');
// }

// public function store(Request $request)
// {
//     $request->validate([
//         'pengumuman' => 'required|mimes:pdf,docx,xlsx|max:5210',
//         'deskripsi' => 'required|string|max:255', 
//     ]);

//     $filePath = null;

//     // Proses penyimpanan file
//     if ($request->hasFile('pengumuman')) {
//         $file = $request->file('pengumuman');
//         $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
//         $filePath = $file->storeAs('public/pengumuman', $fileName);
//     }

//     try {
//         // Debug: Cek data sebelum menyimpan ke database
//         \Log::info('Data to be saved: ', [
//             'pengumuman' => $filePath,
//             'deskripsi' => $request->deskripsi,
//         ]);

//         // Simpan data ke database
//         $originalName = $file->getClientOriginalName();
//         Pengumuman::create([
//             'pengumuman' => $filePath,
//             'original_name' => $originalName,
//             'deskripsi' => $request->deskripsi,
//         ]);

//         return redirect()->route('dashboardAdmin.index')->with('success', 'Pengumuman created successfully!');
//     } catch (\Exception $e) {
//         return redirect()->back()->with('error', 'Failed to create pengumuman: ' . $e->getMessage());
//     }
// }

    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     $request->validate([
    //         'pengumuman' => 'required|mimes:pdf,docx,xlsx|max:512',
    //         'deskripsi' => 'required|string|max:255', 
    //     ]);
    //     $filePath = null;
    
    //     if ($request->hasFile('pengumuman')) {
    //         $file = $request->file('pengumuman');
    //         $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
    //         $filePath = 'public/pengumuman/' . $fileName;
    //         $file->storeAs('public/pengumuman', $fileName);
    //     }
    //     try {
    //         Pengumuman::create([
    //             'pengumuman' => $request->$filePath,
    //             'deskripsi' => $request->hakakses,
    //         ]);
    //         return redirect()->route('dashboardAdmin.index')->with('success', 'Pengumuman created successfully!');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Failed to create pengumuman: ' . $e->getMessage());
    //     }
    // }
    // public function deletePengumuman(Request $request)
    // {
    //     $request->validate([
    //         'ids' => 'required|min:1',
           
    //     ]);
    //     Pengumuman::whereIn('id', $request->ids)->delete();
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Selected users and their related data deleted successfully.'
    //     ]);
    // }

public function deletePengumuman(Request $request)
{
    $request->validate([
        'ids' => 'required|array|min:1', // Validasi bahwa 'ids' harus berupa array
    ]);

    $pengumumanList = Pengumuman::whereIn('id', $request->ids)->get();

    foreach ($pengumumanList as $pengumuman) {
        if ($pengumuman->pengumuman && Storage::exists($pengumuman->pengumuman)) {
            Storage::delete($pengumuman->pengumuman);
        }
    }

    // Hapus data dari database
    Pengumuman::whereIn('id', $request->ids)->delete();

    return response()->json([
        'success' => true,
        'message' => 'Selected pengumuman and their related files deleted successfully.',
    ]);
}


}
