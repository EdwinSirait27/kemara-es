<?php
namespace App\Http\Controllers;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Rules\NoXSSInput;
use Carbon\Carbon;
class DatasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('Datasiswa.Datasiswa');
    }
    public function indexSiswaall()
    {
        return view('Datasiswaall.index');

    }
    public function getDatasiswaall()
    {
        $siswa = Siswa::all()->load('user')->makeHidden(['foto'])


            ->map(function ($siswa) {
                $siswa->id_hashed = substr(hash('sha256', $siswa->siswa_id . env('APP_KEY')), 0, 8);

                return $siswa;
            });
            // $siswa->created_at = $siswa->User ? $siswa->User->created_at : '-';
        return DataTables::of($siswa)
        ->addColumn('created_at', function ($siswa) {
            return Carbon::parse($siswa->User->created_at)->format('Y');
        })
            ->make(true);
    }
    public function getDatasiswa()
    {
        $siswa = Siswa::select(['siswa_id', 'foto', 'NamaLengkap', 'Agama', 'NomorTelephone', 'Alamat', 'Email'])
            ->get()
            ->map(function ($siswa) {
                $siswa->id_hashed = substr(hash('sha256', $siswa->siswa_id . env('APP_KEY')), 0, 8);
                $siswa->action = '
            <a href="' . route('Datasiswa.edit', $siswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
                $siswa->foto = $siswa->foto ? $siswa->foto : 'we.jpg';
                return $siswa;
            });
        return DataTables::of($siswa)
            ->addColumn('foto', function ($siswa) {
                return $siswa->foto;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function edit($hashedId)
    {
        $siswa = Siswa::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->siswa_id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$siswa) {
            abort(404, 'Siswa not found.');
        }
        return view('Datasiswa.edit', compact('siswa', 'hashedId'));
    }
    public function update(Request $request, $hashedId)
    {
        // dd($request->all());

        $validatedData = $request->validate([
                    'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:512', new NoXSSInput(),
                    function ($attribute, $value, $fail) {
                        $sanitizedValue = strip_tags($value);
                        if ($sanitizedValue !== $value) {
                            $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                        }
                    }],
            'NamaLengkap' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'NomorInduk' => ['required', 'string', 'max:16', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'NamaPanggilan' => ['required', 'string', 'max:16', new NoXSSInput(),
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
            'NISN' => ['required', 'string', 'max:16', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'TempatLahir' => ['required', 'string', 'max:255', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'TanggalLahir' => ['required', 'date', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'Agama' => ['required', 'string', 'in:Katolik,Kristen Protestan,Islam,Hindu,Buddha,Konghucu', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'Alamat' => ['required', 'string', 'max:100', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'RT' => ['required', 'string', 'max:3', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'RW' => ['required', 'string', 'max:3', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'Kelurahan' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'Kecamatan' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'KabKota' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'Provinsi' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'KodePos' => ['required', 'string', 'max:6', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'Email' => ['required', 'string', 'max:100', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'NomorTelephone' => ['required', 'string', 'max:13', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'Kewarganegaraan' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'NIK' => ['required', 'string', 'max:16', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'GolDarah' => ['required', 'string', 'in:A+,A-.A,B+,B-,B,AB+,AB-,AB,O+,O-,O', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'TinggalDengan' => ['required', 'string', 'max:30', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'StatusSiswa' => ['required', 'string', 'in:Lengkap,Yatim,Piatu,Yatim Piatu', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'AnakKe' => ['required', 'string', 'in:1,2,3,4,5', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'SaudaraKandung' => ['required', 'string', 'in:1,2,3,4,5', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'SaudaraTiri' => ['required', 'string', 'in:1,2,3,4,5', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'Tinggicm' => ['required', 'string', 'max:6', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'Beratkg' => ['required', 'string', 'max:6', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'RiwayatPenyakit' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'AsalSD' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'AlamatSD' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'NPSNSD' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'KabKotaSD' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'ProvinsiSD' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'NoIjasah' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'DiterimaTanggal' => ['required', 'date', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'DiterimaDiKelas' => ['required', 'string', 'in:X,XI,XII', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'DiterimaSemester' => ['required', 'string', 'in:Ganjil,Genap', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'MutasiAsalSMP' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'AlasanPindah' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'TglIjasahSD' => ['required', 'date', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'NamaOrangTuaPadaIjasah' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'NamaAyah' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'TahunLahirAyah' => ['required', 'string', 'max:4', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'AlamatAyah' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'NomorTelephoneAyah' => ['required', 'string', 'max:13', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'AgamaAyah' => ['required', 'string', 'in:Katolik,Kristen Protestan,Islam,Hindu,Buddha,Konghucu', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'PendidikanTerakhirAyah' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'PekerjaanAyah' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'PenghasilanAyah' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'NamaIbu' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'TahunLahirIbu' => ['required', 'string', 'max:4', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'AlamatIbu' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'NomorTelephoneIbu' => ['required', 'string', 'max:13', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'AgamaIbu' => ['required', 'string', 'in:Katolik,Kristen Protestan,Islam,Hindu,Buddha,Konghucu', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            },
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'PendidikanTerakhirIbu' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'PekerjaanIbu' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'PenghasilanIbu' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'NamaWali' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'TahunLahirWali' => ['required', 'string', 'max:4', new NoXSSInput()],
            'AlamatWali' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'NomorTelephoneWali' => ['required', 'string', 'max:13', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'AgamaWali' => ['required', 'string', 'in:Katolik,Kristen Protestan,Islam,Hindu,Buddha,Konghucu', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'PendidikanTerakhirWali' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'PekerjaanWali' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'WaliPenghasilan' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'StatusHubunganWali' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'MenerimaBeasiswaDari' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'TahunMeninggalkanSekolah' => ['required', 'string', 'max:4', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'AlasanSebab' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'TamatBelajarTahun' => ['required', 'string', 'max:4', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'InformasiLain' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            
            'status' => ['required', 'in:Aktif,Tidak Aktif,Alumni,Lulus', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            
        ]);
        $siswa = Siswa::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->siswa_id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $file->storeAs('public/fotosiswa', $fileName); // Simpan file ke folder public/fotoguru
            $filePath = $fileName;
        } else {
            // Jika tidak ada file baru yang diunggah, gunakan nilai foto yang lama
            $filePath = $siswa->foto ?? null; // Ambil foto lama atau null jika tidak ada
        }
        if ($siswa && $siswa->foto && Storage::exists('public/fotosiswa/' . $siswa->foto)) {
            Storage::delete('public/fotosiswa/' . $siswa->foto);
        }
        if (!$siswa) {
            return redirect()->route('Datasiswa.index')->with('error', 'ID tidak valid.');
        }
        $siswaData = [
                   'foto' => $filePath,
            'NamaLengkap' => $validatedData['NamaLengkap'],
            'NomorInduk' => $validatedData['NomorInduk'],
            'NamaPanggilan' => $validatedData['NamaPanggilan'],
            'JenisKelamin' => $validatedData['JenisKelamin'],
            'NISN' => $validatedData['NISN'],
            'TempatLahir' => $validatedData['TempatLahir'],
            'TanggalLahir' => $validatedData['TanggalLahir'],
            'Agama' => $validatedData['Agama'],
            'Alamat' => $validatedData['Alamat'],
            'RT' => $validatedData['RT'],
            'RW' => $validatedData['RW'],
            'Kelurahan' => $validatedData['Kelurahan'],
            'Kecamatan' => $validatedData['Kecamatan'],
            'KabKota' => $validatedData['KabKota'],
            'Provinsi' => $validatedData['Provinsi'],
            'KodePos' => $validatedData['KodePos'],
            'Email' => $validatedData['Email'],
            'NomorTelephone' => $validatedData['NomorTelephone'],
            'Kewarganegaraan' => $validatedData['Kewarganegaraan'],
            'NIK' => $validatedData['NIK'],
            'GolDarah' => $validatedData['GolDarah'],
            'TinggalDengan' => $validatedData['TinggalDengan'],
            'StatusSiswa' => $validatedData['StatusSiswa'],
            'AnakKe' => $validatedData['AnakKe'],
            'SaudaraKandung' => $validatedData['SaudaraKandung'],
            'SaudaraTiri' => $validatedData['SaudaraTiri'],
            'Tinggicm' => $validatedData['Tinggicm'],
            'Beratkg' => $validatedData['Beratkg'],
            'RiwayatPenyakit' => $validatedData['RiwayatPenyakit'],
            'AsalSD' => $validatedData['AsalSD'],
            'AlamatSD' => $validatedData['AlamatSD'],
            'NPSNSD' => $validatedData['NPSNSD'],
            'KabKotaSD' => $validatedData['KabKotaSD'],
            'ProvinsiSD' => $validatedData['ProvinsiSD'],
            'NoIjasah' => $validatedData['NoIjasah'],
            'DiterimaTanggal' => $validatedData['DiterimaTanggal'],
            'DiterimaDiKelas' => $validatedData['DiterimaDiKelas'],
            'DiterimaSemester' => $validatedData['DiterimaSemester'],
            'MutasiAsalSMP' => $validatedData['MutasiAsalSMP'],
            'AlasanPindah' => $validatedData['AlasanPindah'],
            'TglIjasahSD' => $validatedData['TglIjasahSD'],
            'NamaOrangTuaPadaIjasah' => $validatedData['NamaOrangTuaPadaIjasah'],
            'NamaAyah' => $validatedData['NamaAyah'],
            'TahunLahirAyah' => $validatedData['TahunLahirAyah'],
            'AlamatAyah' => $validatedData['AlamatAyah'],
            'NomorTelephoneAyah' => $validatedData['NomorTelephoneAyah'],
            'AgamaAyah' => $validatedData['AgamaAyah'],
            'PendidikanTerakhirAyah' => $validatedData['PendidikanTerakhirAyah'],
            'PekerjaanAyah' => $validatedData['PekerjaanAyah'],
            'PenghasilanAyah' => $validatedData['PenghasilanAyah'],
            'NamaIbu' => $validatedData['NamaIbu'],
            'TahunLahirIbu' => $validatedData['TahunLahirIbu'],
            'AlamatIbu' => $validatedData['AlamatIbu'],
            'NomorTelephoneIbu' => $validatedData['NomorTelephoneIbu'],
            'AgamaIbu' => $validatedData['AgamaIbu'],
            'PendidikanTerakhirIbu' => $validatedData['PendidikanTerakhirIbu'],
            'PekerjaanIbu' => $validatedData['PekerjaanIbu'],
            'PenghasilanIbu' => $validatedData['PenghasilanIbu'],
            'NamaWali' => $validatedData['NamaWali'],
            'TahunLahirWali' => $validatedData['TahunLahirWali'],
            'AlamatWali' => $validatedData['AlamatWali'],
            'NomorTelephoneWali' => $validatedData['NomorTelephoneWali'],
            'AgamaWali' => $validatedData['AgamaWali'],
            'PendidikanTerakhirWali' => $validatedData['PendidikanTerakhirWali'],
            'PekerjaanWali' => $validatedData['PekerjaanWali'],
            'WaliPenghasilan' => $validatedData['WaliPenghasilan'],
            'StatusHubunganWali' => $validatedData['StatusHubunganWali'],
            'MenerimaBeasiswaDari' => $validatedData['MenerimaBeasiswaDari'],
            'TahunMeninggalkanSekolah' => $validatedData['TahunMeninggalkanSekolah'],
            'AlasanSebab' => $validatedData['AlasanSebab'],
            'TamatBelajarTahun' => $validatedData['TamatBelajarTahun'],
            'InformasiLain' => $validatedData['InformasiLain'],
            'status' => $validatedData['status'],
            
        ];
        
        $siswa->update($siswaData);
        if ($filePath && Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
        return redirect()->route('Datasiswa.index')->with('success', 'Siswa Berhasil Diupdate.');
    }
  
}
