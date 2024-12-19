<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\arsip;
use App\Models\Arsipsiswa;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Rules\NoXSSInput;

class ArsipSiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('Siswaarsip.index');

    }
    public function indexUpload()
    {
        
        return view('Uploadarsip.index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'file' => ['required','file','mimes:xlsx,xls,csv|max:5120'],
        ]);

        $filePath = $request->file('file')->store('uploads/excel');

        try {
            Excel::import(new arsip, $filePath);
            Storage::delete($filePath);
            return redirect()->back()->with('success', 'Data arsip siswa berhasil diunggah dan diproses.');
        } catch (\Exception $e) {
            Storage::delete($filePath);
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memproses file: ' . $e->getMessage()]);
        }
    }
    public function getArsipsiswa()
    {
        $arsip = Arsipsiswa::get()
            ->map(function ($arsip) {
                return $arsip;
            });
        return DataTables::of($arsip)
            ->make(true);

    }
}
