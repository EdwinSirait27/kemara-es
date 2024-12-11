<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class KGSNController extends Controller
{
    public function getPengumumanKGSN()
    {
        $pengumuman = Pengumuman::select(['id', 'pengumuman', 'deskripsi', 'created_at'])
            ->get()
            ->map(function ($item) {
                $item->pengumuman = basename($item->pengumuman);
                $item->created_at = Carbon::parse($item->created_at)->format('d-m-Y H:i:s');
                $item->action = '<a href="' . route('download.pengumuman', ['id' => $item->id]) . '" class="btn btn-sm btn-primary">Download</a>';
                return $item;
            });
        return DataTables::of($pengumuman)
            ->rawColumns(['action'])
            ->make(true);
    }
}
