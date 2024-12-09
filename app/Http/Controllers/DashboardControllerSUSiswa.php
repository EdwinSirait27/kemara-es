<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Siswa;
use Yajra\DataTables\DataTables;
// use Illuminate\Support\Str;
use Carbon\Carbon;
// use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Crypt;
class DashboardControllerSUSiswa extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function indexSiswa()
    {
        return view('dashboardSUSiswa.dashboardSUSiswa');
    }
    public function createSiswa()
    {
        return view('dashboardSUSiswa.createSiswa');
    }
    public function getUsersSiswa()
    {
        $users = User::with('Siswa')
            ->select(['id', 'siswa_id', 'username', 'hakakses', 'Role', 'created_at'])
            ->whereIn('hakakses', ['Siswa', 'NonSiswa'])
            ->get()
            ->map(function ($user) {
                $user->id_hashed = substr(hash('sha256', $user->id . env('APP_KEY')), 0, 8); // 8 karakter pertama dari hash SHA-256
                $user->created_at = Carbon::parse($user->created_at)->format('d-m-Y H:i:s');
                $user->Role = implode(', ', explode(',', $user->Role));
                $user->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $user->id_hashed . '">';
                $user->action = '
            <a href="' . route('dashboardSUSiswa.editSiswa', $user->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
                $user->Siswa_Nama = $user->Siswa ? $user->Siswa->NamaLengkap : '-';
                return $user;
            });
        return DataTables::of($users)
            ->addColumn('Role', function ($user) {
                return $user->Role;
            })
            ->rawColumns(['checkbox', 'action'])
            ->make(true);
    }
    public function editSiswa($hashedId)
    {
        $user = User::with('Siswa')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        $roles = explode(',', $user->getRawOriginal('Role'));


        // Jika user tidak ditemukan
        if (!$user) {
            abort(404, 'User not found.');
        }

        // Kirim data user dan hashedId ke view
        return view('dashboardSUSiswa.editSiswa', compact('user', 'hashedId', 'roles'));
    }
    public function updateSiswa(Request $request, $hashedId)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:12|min:7|regex:/^[a-zA-Z0-9_-]+$/',
            'password' => 'nullable|string|max:12|min:7',
            'hakakses' => 'required|string|in:Siswa,NonSiswa',
            'Role' => 'required|array|min:1|in:Siswa,NonSiswa',
            'NamaLengkap' => 'nullable|string|max:255',
        ]);

        $user = User::with('Siswa')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });

        if (!$user) {
            return redirect()->route('dashboardSUSiswa.indexSiswa')->with('error', 'ID tidak valid.');
        }

        // Convert Role array to comma-separated string
        $roles = implode(',', $validatedData['Role']);

        $userData = [
            'username' => $validatedData['username'],
            'hakakses' => $validatedData['hakakses'],
            'Role' => $roles, // Simpan sebagai string
        ];

        if (!empty($validatedData['password'])) {
            $userData['password'] = bcrypt($validatedData['password']);
        }

        $user->update($userData);

        if ($user->Siswa) {
            $user->Siswa->update([
                'NamaLengkap' => $validatedData['NamaLengkap'],
            ]);
        }

        return redirect()->route('dashboardSUSiswa.indexSiswa')->with('success', 'User Berhasil Diupdate.');
    }
    public function storeSiswa(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'username' => 'required|string|regex:/^[a-zA-Z0-9_-]+$/|max:12|min:7|unique:users,username',
            'password' => 'required|string|min:7|max:12|confirmed',
            'hakakses' => 'required|string|in:Siswa,NonSiswa',
            'Role' => 'required|array',
            'Role.*' => 'required|string|in:Siswa,NonSiswa',
        ]);

        try {
            User::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'hakakses' => $request->hakakses,
                'Role' => implode(',', $request->Role),
            ]);
            return redirect()->route('dashboardSUSiswa.createSiswa')->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create user: ' . $e->getMessage());
        }
    }
    public function deleteUsersSiswa(Request $request)
    {
        // Validasi UUID
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'uuid',  // Pastikan ID yang dikirimkan adalah UUID
        ]);

        // Hapus pengguna berdasarkan UUID
        User::whereIn('id', $request->ids)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Selected users and their related data deleted successfully.'
        ]);
    }


}
