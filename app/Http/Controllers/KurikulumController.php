<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kurikulum;
// use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Rules\NoXSSInput;


class KurikulumController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('Kurikulum.Kurikulum');

    }
    public function create()
    {
        return view('Kurikulum.create');
    }
    public function getUsers()
    {
        $kurikulum = Kurikulum::select(['id', 'kurikulum', 'status', 'ket', 'created_at', 'updated_at'])
            ->get()
            ->map(function ($kurikulum) {
                $kurikulum->id_hashed = substr(hash('sha256', $kurikulum->id . env('APP_KEY')), 0, 8);
                $kurikulum->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $kurikulum->id_hashed . '">';
                $kurikulum->action = '
            <a href="' . route('Kurikulum.edit', $kurikulum->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
                // $user->Guru_Nama = $user->Guru ? $user->Guru->Nama : '-';
                return $kurikulum;
            });
        return DataTables::of($kurikulum)
        ->addColumn('created_at', function ($kurikulum) {
            return Carbon::parse($kurikulum->created_at)->format('m-d-Y');
        })
        ->addColumn('updated_at', function ($kurikulum) {
            return Carbon::parse($kurikulum->updated_at)->format('m-d-Y');
        })           
        ->rawColumns(['checkbox', 'action'])
            ->make(true);

    }
    public function edit($hashedId)
    {
        $kurikulum = Kurikulum::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$kurikulum) {
            abort(404, 'User not found.');
        }
        return view('Kurikulum.edit', compact('kurikulum', 'hashedId'));
    }
    public function update(Request $request, $hashedId)
    {
        $validatedData = $request->validate([
            'kurikulum' => ['required', 'string', 'max:50','unique:tb_kurikulum,kurikulum', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],      
            'status' => ['required', 'string', 'in:Aktif,Tidak Aktif', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],      
            'ket' => ['required', 'string', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],      
            
        ]);
        $kurikulum = Kurikulum::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$kurikulum) {
            return redirect()->route('Kurikulum.index')->with('error', 'ID tidak valid.');
        }
        $kurikulumData = [
            'kurikulum' => $validatedData['kurikulum'],
            'status' => $validatedData['status'],
            'ket' => $validatedData['ket'],
            // 'ket' => $roles,
        ];
        $kurikulum->update($kurikulumData);
        return redirect()->route('Kurikulum.index')->with('success', 'Kurikulum Berhasil Diupdate.');
    }
    public function deleteUsers(Request $request)
    {
        $request->validate([
            'ids' => ['required','array','min:1', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],      
            
        ]);
        Kurikulum::whereIn('id', $request->ids)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Selected Kurikulum and their related data deleted successfully.'
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
          'kurikulum' => ['required', 'string', 'max:50','unique:tb_kurikulum,kurikulum', new NoXSSInput(),
          function ($attribute, $value, $fail) {
              $sanitizedValue = strip_tags($value);
              if ($sanitizedValue !== $value) {
                  $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
              }
          }],      
            'status' => ['required', 'string', 'in:Aktif,Tidak Aktif', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],      
            'ket' => ['required', 'string', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],      
            
        ]);
        try {
            Kurikulum::create([
                'kurikulum' => $request->kurikulum,
                'status' => $request->status,
                'ket' => $request->ket,
            ]);
            return redirect()->route('Kurikulum.index')->with('success', 'Kurikulum created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create Kurikulum: ' . $e->getMessage());
        }
    }
}
