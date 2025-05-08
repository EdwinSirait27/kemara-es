<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Rules\NoXSSInput;
class DataguruController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('Dataguru.Dataguru');

    }
    public function indexGuruall()
    {
        return view('Dataguruall.index');

    }
    public function getDataguruall()
    {
        $guru = Guru::all()->makeHidden(['foto'])

            ->map(function ($guru) {
                $guru->id_hashed = substr(hash('sha256', $guru->guru_id . env('APP_KEY')), 0, 8);
                return $guru;
            });
        return DataTables::of($guru)
            ->make(true);
    }
    // public function getDataguru()
    // {
    //     $guru = Guru::select(['guru_id', 'foto', 'Nama', 'TugasMengajar', 'NomorTelephone', 'Alamat', 'Email'])
    //         ->get()
    //         ->map(function ($guru) {
    //             $guru->id_hashed = substr(hash('sha256', $guru->guru_id . env('APP_KEY')), 0, 8);
    //             $guru->action = '
    //         <a href="' . route('Dataguru.edit', $guru->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
    //             <i class="fas fa-user-edit text-secondary"></i>
    //         </a>';
    //             $guru->foto = $guru->foto ? $guru->foto : 'we.jpg';
    //             return $guru;
    //         });
    //     return DataTables::of($guru)
    //         ->addColumn('foto', function ($guru) {
    //             return $guru->foto;
    //         })
    //         ->rawColumns(['action'])
    //         ->make(true);
    // }
    public function getDataguru(Request $request)
    {
          $guru = Guru::select(['guru_id', 'foto', 'Nama', 'TugasMengajar', 'NomorTelephone', 'Alamat', 'Email'])
            ->get()
            ->map(function ($guru) {
            $guru->id_hashed = substr(hash('sha256', $guru->guru_id . env('APP_KEY')), 0, 8);
            $guru->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $guru->id_hashed . '">';
            $guru->action = '
                <a href="' . route('Dataguru.edit', $guru->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                    <i class="fas fa-user-edit text-secondary"></i>
                </a>';
                $guru->foto = $guru->foto ? $guru->foto : 'we.jpg';
                            return $guru;
        });
    
        return DataTables::of($guru)
                    ->addColumn('foto', function ($guru) {
                    return $guru->foto;
                })
            ->rawColumns([ 'action'])
            ->make(true);
    }

    public function edit($hashedId)
    {
        $guru = Guru::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->guru_id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$guru) {
            abort(404, 'guru not found.');
        }
        return view('Dataguru.edit', compact('guru', 'hashedId'));
    }
    public function update(Request $request, $hashedId)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'Nama' => ['nullable', 'string', 'max:50', new NoXSSInput()],
            'TempatLahir' => ['nullable', 'string', 'max:255', new NoXSSInput()],
            'TanggalLahir' => ['nullable', 'date', new NoXSSInput()],
            'Agama' => ['nullable', 'string', 'in:Katolik,Kristen Protestan,Islam,Hindu,Buddha,Konghucu', new NoXSSInput()],
            'JenisKelamin' => ['nullable', 'string', 'in:Laki-Laki,Perempuan', new NoXSSInput()],
            'StatusPegawai' => ['nullable', 'string', 'max:255', new NoXSSInput()],
            'NipNips' => ['nullable', 'string', 'max:16', new NoXSSInput()],
            'Nuptk' => ['nullable', 'string', 'max:16', new NoXSSInput()],
            'Nik' => ['nullable', 'string', 'max:16', new NoXSSInput()],
            'Npwp' => ['nullable', 'string', 'max:16', new NoXSSInput()],
            'NomorSertifikatPendidik' => ['nullable', 'string', 'max:16', new NoXSSInput()],
            'TahunSertifikasi' => ['nullable', 'date', new NoXSSInput()],
            'jadwalkenaikangaji' => ['nullable', 'date', new NoXSSInput()],
            'PendidikanAkhir' => ['nullable', 'string', 'max:100', new NoXSSInput()],
            'TahunTamat' => ['nullable', 'date', new NoXSSInput()],
            'Jurusan' => ['nullable', 'string', 'max:100', new NoXSSInput()],
            'TugasMengajar' => ['nullable', 'string', 'max:100', new NoXSSInput()],
            'TahunPensiun' => ['nullable', 'date', new NoXSSInput()],
            'Pangkat' => ['nullable', 'string', 'max:50', new NoXSSInput()],
            'jadwalkenaikanpangkat' => ['nullable', 'date', new NoXSSInput()],
            'Jabatan' => ['nullable', 'string', 'max:50', new NoXSSInput()],
            'NomorTelephone' => ['nullable', 'string', 'max:13', new NoXSSInput()],
            'Alamat' => ['nullable', 'string', 'max:100', new NoXSSInput()],
            'Email' => ['nullable', 'string', 'max:100', new NoXSSInput()],
            'status' => ['required', 'in:Aktif,Tidak Aktif', new NoXSSInput()],
            'foto' => ['nullable','image','mimes:jpeg,png,jpg','max:512'],
        
        ],
    [
        'foto.mimes' => 'harus bertipe jpeg,png,jpg',
        'foto.max' => 'foto harus kurang dari 512 kb',
        'foto.image' => 'harus berupa gambar',
        'status.required' => 'harus diisi ya untuk status',
            
        ]);
        $guru = Guru::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->guru_id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $file->storeAs('public/fotoguru', $fileName); // Simpan file ke folder public/fotoguru
            $filePath = $fileName;
        } else {
            // Jika tidak ada file baru yang diunggah, gunakan nilai foto yang lama
            $filePath = $guru->foto ?? null; // Ambil foto lama atau null jika tidak ada
        }
        if ($guru && $guru->foto && Storage::exists('public/fotoguru/' . $guru->foto)) {
            Storage::delete('public/fotoguru/' . $guru->foto);
        }
        if (!$guru) {
            return redirect()->route('Dataguru.index')->with('error', 'ID tidak valid.');
        }
        $guruData = [
            'foto' => $filePath,
            'Nama' => $validatedData['Nama'],
            'TempatLahir' => $validatedData['TempatLahir'],
            'TanggalLahir' => $validatedData['TanggalLahir'],
            'Agama' => $validatedData['Agama'],
            'JenisKelamin' => $validatedData['JenisKelamin'],
            'StatusPegawai' => $validatedData['StatusPegawai'],
            'NipNips' => $validatedData['NipNips'],
            'Nuptk' => $validatedData['Nuptk'],
            'Nik' => $validatedData['Nik'],
            'Npwp' => $validatedData['Npwp'],
            'NomorSertifikatPendidik' => $validatedData['NomorSertifikatPendidik'],
            'TahunSertifikasi' => $validatedData['TahunSertifikasi'],
            'jadwalkenaikangaji' => $validatedData['jadwalkenaikangaji'],
            'PendidikanAkhir' => $validatedData['PendidikanAkhir'],
            'TahunTamat' => $validatedData['TahunTamat'],
            'Jurusan' => $validatedData['Jurusan'],
            'TugasMengajar' => $validatedData['TugasMengajar'],
            'TahunPensiun' => $validatedData['TahunPensiun'],
            'Pangkat' => $validatedData['Pangkat'],
            'jadwalkenaikanpangkat' => $validatedData['jadwalkenaikanpangkat'],
            'Jabatan' => $validatedData['Jabatan'],
            'NomorTelephone' => $validatedData['NomorTelephone'],
            'Alamat' => $validatedData['Alamat'],
            'Email' => $validatedData['Email'],
            'status' => $validatedData['status'],

        ];
        
        $guru->update($guruData);
        if ($filePath && Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
        return redirect()->route('Dataguru.index')->with('success', 'Guru Berhasil Diupdate.');
    }
    
   
    
}
