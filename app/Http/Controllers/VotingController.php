<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voting;
use App\Models\Hasilvoting;
use App\Models\Osis;
use App\Models\Tombol;
use Illuminate\Support\Facades\Gate;
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

        $voting = Tombol::where('url', 'Voting')->first();
        if (!$voting) {
            return $this->redirectToDashboard()->with('warning', 'Pemilihan Ketua Osis masih tertutup.');
        }

        $start_date = Carbon::parse($voting->start_date);
        $end_date = Carbon::parse($voting->end_date);

        if (Carbon::now()->between($start_date, $end_date)) {
            return view('Voting.Voting', compact('osiss', 'votingg'));
        }

        return $this->redirectToDashboard()->with('warning', 'Data Pemilihan Ketua Osis tidak tersedia.');

    }
    public function store(Request $request)
{
    // dd($request->all());
    $request->validate([
        'osis_id' => ['required', 'array', 'min:1', new NoXSSInput()],
        'osis_id.*' => ['exists:tb_osis,id', new NoXSSInput()], 
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

    return redirect()->route('Voting.index')->with('success', 'Suara Anda telah tercatat.');
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
}
