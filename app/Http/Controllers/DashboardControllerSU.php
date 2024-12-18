<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Rules\NoXSSInput;

class DashboardControllerSU extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('dashboardSU.dashboardSU');

    }
    public function create()
    {
        return view('dashboardSU.create');
    }
    public function getUsers()
    {
        $users = User::with('Guru')
            ->select(['id', 'guru_id', 'username', 'hakakses', 'Role', 'created_at'])
            ->whereIn('hakakses', ['SU', 'Admin', 'KepalaSekolah', 'Guru', 'Kurikulum'])
            ->get()
            ->map(function ($user) {
                $user->id_hashed = substr(hash('sha256', $user->id . env('APP_KEY')), 0, 8);
                // $user->created_at = Carbon::parse($user->created_at)->format('d-m-Y'); $user->Role = implode(', ', explode(',', $user->Role));
                $user->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $user->id_hashed . '">';
                $user->action = '
            <a href="' . route('dashboardSU.edit1', $user->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
                $user->Guru_Nama = $user->Guru ? $user->Guru->Nama : '-';
                return $user;
            });
        return DataTables::of($users)
        ->addColumn('created_at', function ($user) {
            return Carbon::parse($user->created_at)->format('d-m-Y H:i:s');
        })
            ->addColumn('Role', function ($user) {
                return $user->Role;
            })
            ->rawColumns(['checkbox', 'action'])
            ->make(true);

    }
    public function edit($hashedId)
    {
        $user = User::with('Guru')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        $roles = explode(',', $user->getRawOriginal('Role'));
        if (!$user) {
            abort(404, 'User not found.');
        }
        return view('dashboardSU.edit', compact('user', 'hashedId', 'roles'));
    }
    public function update(Request $request, $hashedId)
    {
        $validatedData = $request->validate([
            'username' => ['required', 'string', 'max:12','min:7','regex:/^[a-zA-Z0-9_-]+$/', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'password' => ['nullable', 'string', 'min:7','max:12','confirmed', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],      
            'hakakses' => ['required', 'string', 'in:SU,KepalaSekolah,Admin,Guru,Kurikulum', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],      
            'Role' => ['required', 'array', 'min:1','in:SU,KepalaSekolah,Admin,Guru,Kurikulum', new NoXSSInput()],      
            'Nama' => ['required', 'string', 'max:255', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],      
            
        ]);
        $user = User::with('Guru')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$user) {
            return redirect()->route('dashboardSU.index')->with('error', 'ID tidak valid.');
        }
        $roles = implode(',', $validatedData['Role']);
        $userData = [
            'username' => $validatedData['username'],
            'hakakses' => $validatedData['hakakses'],
            'Role' => $roles,
        ];
        if (!empty($validatedData['password'])) {
            $userData['password'] = bcrypt($validatedData['password']);
        }
        $user->update($userData);

        if ($user->Guru) {
            $user->Guru->update([
                'Nama' => $validatedData['Nama'],
            ]);
        }
        return redirect()->route('dashboardSU.index')->with('success', 'User Berhasil Diupdate.');
    }
    public function deleteUsers(Request $request)
    {
        $request->validate([
            
            'ids' => ['required', 'array', 'min:1', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
            'ids.*' => ['uuid', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
           
        ]);
        User::whereIn('id', $request->ids)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Selected users and their related data deleted successfully.'
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'username' => ['required', 'string', 'max:12','min:7','regex:/^[a-zA-Z0-9_-]+$/', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'password' => ['nullable', 'string', 'min:7','max:12','confirmed', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],      
            'hakakses' => ['required', 'string', 'in:SU,KepalaSekolah,Admin,Guru,Kurikulum', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],      
            'Role' => ['required', 'array', 'min:1','in:SU,KepalaSekolah,Admin,Guru,Kurikulum', new NoXSSInput()
           ],      
            // 'Nama' => ['required', 'string', 'max:255', new NoXSSInput()],  
        ]);

        try {
            User::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'hakakses' => $request->hakakses,
                'Role' => implode(',', $request->Role),
            ]);
            return redirect()->route('dashboardSU.index')->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create user: ' . $e->getMessage());
        }
    }
}

