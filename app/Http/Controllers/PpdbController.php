<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Tombol;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Rules\NoXSSInput;
class PpdbController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
{
    $ppdb = Tombol::where('url', 'Ppdb')->first();
    if (!$ppdb) {
        return redirect()->back()->with('warning', 'Data PPDB tidak tersedia.');
    }
    $start_date = Carbon::parse($ppdb->start_date);
    $end_date = Carbon::parse($ppdb->end_date);
    if (Carbon::now()->between($start_date, $end_date)) {
        return view('Ppdb.Ppdb');
    }
    return redirect()->back()->with('warning', 'PPDB masih tertutup.');
}

 

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'hakakses' => ['nullable', 'string', 'in:NonSiswa', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'Role' => ['nullable', 'string', 'in:NonSiswa', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'password' => ['required', 'string', 'min:7', 'max:12', 'confirmed', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'current_password' => ['nullable', 'string', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'NamaLengkap' => ['required', 'string', 'max:255', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'NamaPanggilan' => ['nullable', 'string', 'max:100', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'JenisKelamin' => ['required', 'string', 'in:Laki-Laki,Perempuan', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'TempatLahir' => ['nullable', 'string', 'max:255', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'TanggalLahir' => ['nullable', 'date', new NoXSSInput()],
            'Agama' => ['required', 'string', 'in:Katolik,Kristen Protestan,Islam,Hindu,Buddha,Konghucu', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'status' => ['nullable', 'string', 'in:Aktif,Tidak Aktif', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'Alamat' => ['nullable', 'string', 'max:255', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'NomorTelephone' => ['nullable', 'numeric', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'NomorTelephoneAyah' => ['nullable', 'numeric', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'siswa_id' => ['nullable', 'numeric', 'max:4', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'username' => ['required', 'string', 'min:7', 'max:12', 'regex:/^[a-zA-Z0-9_-]+$/', 'unique:users,username', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            
        ]);
        try {
            DB::beginTransaction();
            $siswa = Siswa::create([
                'NamaLengkap' => $validatedData['NamaLengkap'],
                'NamaPanggilan' => $validatedData['NamaPanggilan'],
                'JenisKelamin' => $validatedData['JenisKelamin'],
                'TempatLahir' => $validatedData['TempatLahir'],
                'TanggalLahir' => $validatedData['TanggalLahir'],
                'Agama' => $validatedData['Agama'],
                'Alamat' => $validatedData['Alamat'],
                'NomorTelephone' => $validatedData['NomorTelephone'],
                'NomorTelephoneAyah' => $validatedData['NomorTelephoneAyah'],
                'status' => 'Nonaktif',
            ]);
            User::create([
                'username' => $validatedData['username'],
                'password' => Hash::make($validatedData['password']),
                'hakakses' => 'NonSiswa',
                'Role' => 'NonSiswa',
                'siswa_id' => $siswa->siswa_id,
            ]);
            DB::commit();
            return redirect()->route('login')->with('success', 'Pendaftaran berhasil dibuat, Silahkan Login');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])
                ->withInput();
        }
    }
}
