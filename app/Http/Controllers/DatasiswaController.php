<?php
namespace App\Http\Controllers;
use App\Models\Siswa;
use App\Models\Informasippdb;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Rules\NoXSSInput;
class DatasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
    $informasippdb = Informasippdb::where('status', 'Aktif')->first();

        return view('Datasiswa.Datasiswa',compact('informasippdb'));
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
            // $siswa->created = $siswa->user ? $siswa->user->created_at : 'belum di setel';

        return DataTables::of($siswa)
        
            ->make(true);
    }
    public function getDatasiswa(Request $request)
{
    $query = Siswa::select([
        'siswa_id', 'foto', 'NamaLengkap', 'Agama', 'NomorTelephone', 'Alamat', 'Email', 'status'
    ]);

    // Filter berdasarkan status
    if ($request->has('status') && !empty($request->status)) {
        $query->where('status', $request->status);
    }

    $siswa = $query->get()->map(function ($siswa) {
        $siswa->id_hashed = substr(hash('sha256', $siswa->siswa_id . env('APP_KEY')), 0, 8);
        $siswa->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $siswa->id_hashed . '">';
        $siswa->action = '
            <a href="' . route('Datasiswa.edit', $siswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
            $siswa->foto = $siswa->foto ? $siswa->foto : 'we.jpg';
                        return $siswa;
    });

    return DataTables::of($siswa)
                ->addColumn('foto', function ($siswa) {
                return $siswa->foto;
            })
        ->rawColumns(['checkbox', 'action'])
        ->make(true);
}

    // public function getDatasiswa()
    // {
    //     $query = Siswa::with(['Guru', 'Matapelajaran'])
    //     ->select(['id', 'matapelajaran_id', 'guru_id', 'hari', 'awalpel', 'akhirpel', 'awalis', 'akhiris', 'ket']);

    // // Filter berdasarkan hari
   
    //     $siswa = Siswa::select(['siswa_id', 'foto', 'NamaLengkap', 'Agama', 'NomorTelephone', 'Alamat', 'Email','status'])
    //         ->get()
    //         ->map(function ($siswa) {
    //             $siswa->id_hashed = substr(hash('sha256', $siswa->siswa_id . env('APP_KEY')), 0, 8);
    //             $siswa->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $siswa->siswa_id . '">';
    //             $siswa->action = '
    //         <a href="' . route('Datasiswa.edit', $siswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
    //             <i class="fas fa-user-edit text-secondary"></i>
    //         </a>';
    //             $siswa->foto = $siswa->foto ? $siswa->foto : 'we.jpg';
    //             return $siswa;
    //         });
    //     return DataTables::of($siswa)
    //         ->addColumn('foto', function ($siswa) {
    //             return $siswa->foto;
    //         })
    //         ->rawColumns(['action','checkbox'])
    //         ->make(true);
    // }
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
                    'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:512'],
            'NamaLengkap' => ['required', 'string', 'max:50', new NoXSSInput()],
            'NomorInduk' => ['required', 'string', 'max:16', new NoXSSInput()],
            'NamaPanggilan' => ['required', 'string', 'max:16', new NoXSSInput()],
            'JenisKelamin' => ['required', 'string', 'in:Laki-Laki,Perempuan', new NoXSSInput()],
            'NISN' => ['required', 'string', 'max:16', new NoXSSInput()],
            'TempatLahir' => ['required', 'string', 'max:255', new NoXSSInput()],
            'TanggalLahir' => ['required', 'date', new NoXSSInput()],
            'Agama' => ['required', 'string', 'in:Katolik,Kristen Protestan,Islam,Hindu,Buddha,Konghucu', new NoXSSInput()],
            'Alamat' => ['required', 'string', 'max:100', new NoXSSInput()],
            'RT' => ['required', 'string', 'max:3', new NoXSSInput()],
            'RW' => ['required', 'string', 'max:3', new NoXSSInput()],
            'Kelurahan' => ['required', 'string', 'max:50', new NoXSSInput()],
            'Kecamatan' => ['required', 'string', 'max:50', new NoXSSInput()],
            'KabKota' => ['required', 'string', 'max:50', new NoXSSInput()],
            'Provinsi' => ['required', 'string', 'max:50', new NoXSSInput()],
            'KodePos' => ['required', 'string', 'max:6', new NoXSSInput()],
            'Email' => ['required', 'string', 'max:100', new NoXSSInput()],
            'NomorTelephone' => ['required', 'string', 'max:13', new NoXSSInput()],
            'Kewarganegaraan' => ['required', 'string', 'max:50', new NoXSSInput()],
            'NIK' => ['required', 'string', 'max:16', new NoXSSInput()],
            'GolDarah' => ['required', 'string', 'in:A+,A-.A,B+,B-,B,AB+,AB-,AB,O+,O-,O', new NoXSSInput()],
            'TinggalDengan' => ['required', 'string', 'max:30', new NoXSSInput()],
            'StatusSiswa' => ['required', 'string', 'in:Lengkap,Yatim,Piatu,Yatim Piatu', new NoXSSInput()],
            'AnakKe' => ['required', 'string', 'in:1,2,3,4,5', new NoXSSInput()],
            'SaudaraKandung' => ['required', 'string', 'in:1,2,3,4,5', new NoXSSInput()],
            'SaudaraTiri' => ['required', 'string', 'in:1,2,3,4,5', new NoXSSInput()],
            'Tinggicm' => ['required', 'string', 'max:6', new NoXSSInput()],
            'Beratkg' => ['required', 'string', 'max:6', new NoXSSInput()],
            'RiwayatPenyakit' => ['required', 'string', 'max:50', new NoXSSInput()],
            'AsalSD' => ['required', 'string', 'max:50', new NoXSSInput()],
            'AlamatSD' => ['required', 'string', 'max:50', new NoXSSInput()],
            'NPSNSD' => ['required', 'string', 'max:50', new NoXSSInput()],
            'KabKotaSD' => ['required', 'string', 'max:50', new NoXSSInput()],
            'ProvinsiSD' => ['required', 'string', 'max:50', new NoXSSInput()],
            'NoIjasah' => ['required', 'string', 'max:50', new NoXSSInput()],
            'DiterimaTanggal' => ['required', 'date', new NoXSSInput()],
            'DiterimaDiKelas' => ['required', 'string', 'in:X,XI,XII', new NoXSSInput()],
            'DiterimaSemester' => ['required', 'string', 'in:Ganjil,Genap', new NoXSSInput()],
            'MutasiAsalSMP' => ['required', 'string', 'max:50', new NoXSSInput()],
            'AlasanPindah' => ['required', 'string', 'max:50', new NoXSSInput()],
            'TglIjasahSD' => ['required', 'date', new NoXSSInput()],
            'NamaOrangTuaPadaIjasah' => ['required', 'string', 'max:50', new NoXSSInput()],
            'NamaAyah' => ['required', 'string', 'max:50', new NoXSSInput()],
            'TahunLahirAyah' => ['required', 'string', 'max:4', new NoXSSInput()],
            'AlamatAyah' => ['required', 'string', 'max:50', new NoXSSInput()],
            'NomorTelephoneAyah' => ['required', 'string', 'max:13', new NoXSSInput()],
            'AgamaAyah' => ['required', 'string', 'in:Katolik,Kristen Protestan,Islam,Hindu,Buddha,Konghucu', new NoXSSInput()],
            'PendidikanTerakhirAyah' => ['required', 'string', 'max:50', new NoXSSInput()],
            'PekerjaanAyah' => ['required', 'string', 'max:50', new NoXSSInput()],
            'PenghasilanAyah' => ['required', 'string', 'max:50', new NoXSSInput()],
            'NamaIbu' => ['required', 'string', 'max:50', new NoXSSInput()],
            'TahunLahirIbu' => ['required', 'string', 'max:4', new NoXSSInput()],
            'AlamatIbu' => ['required', 'string', 'max:50', new NoXSSInput()],
            'NomorTelephoneIbu' => ['required', 'string', 'max:13', new NoXSSInput()],
            'AgamaIbu' => ['required', 'string', 'in:Katolik,Kristen Protestan,Islam,Hindu,Buddha,Konghucu', new NoXSSInput()],
            'PendidikanTerakhirIbu' => ['required', 'string', 'max:50', new NoXSSInput()],
            'PekerjaanIbu' => ['required', 'string', 'max:50', new NoXSSInput()],
            'PenghasilanIbu' => ['required', 'string', 'max:50', new NoXSSInput()],
            'NamaWali' => ['required', 'string', 'max:50', new NoXSSInput()],
            'TahunLahirWali' => ['required', 'string', 'max:4', new NoXSSInput()],
            'AlamatWali' => ['required', 'string', 'max:50', new NoXSSInput()],
            'NomorTelephoneWali' => ['required', 'string', 'max:13', new NoXSSInput()],
            'AgamaWali' => ['required', 'string', 'in:Katolik,Kristen Protestan,Islam,Hindu,Buddha,Konghucu', new NoXSSInput()],
            'PendidikanTerakhirWali' => ['required', 'string', 'max:50', new NoXSSInput()],
            'PekerjaanWali' => ['required', 'string', 'max:50', new NoXSSInput()],
            'WaliPenghasilan' => ['required', 'string', 'max:50', new NoXSSInput()],
            'StatusHubunganWali' => ['required', 'string', 'max:50', new NoXSSInput()],
            'MenerimaBeasiswaDari' => ['required', 'string', 'max:50', new NoXSSInput()],
            'TahunMeninggalkanSekolah' => ['required', 'string', 'max:4', new NoXSSInput()],
            'AlasanSebab' => ['required', 'string', 'max:50', new NoXSSInput()],
            'TamatBelajarTahun' => ['required', 'date', new NoXSSInput()],
            'InformasiLain' => ['required', 'string', 'max:50', new NoXSSInput()],
            
            'status' => ['required', 'in:Aktif,Tidak Aktif,Alumni,Lulus', new NoXSSInput()],
            
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
    public function updateStatus(Request $request)
{
    try {
        // Log request payload
        Log::info('Request diterima untuk update status:', ['payload' => $request->all()]);

        // Validasi input
        $request->validate([
            'siswa_ids' => ['required','array', new NoXSSInput()],
            'siswa_ids.*' => ['string','exists:tb_siswa,siswa_id',new NoXSSInput()],
        ]);

        Log::info('Siswa IDs yang akan diperbarui:', ['siswa_ids' => $request->siswa_ids]);

        $affectedRows = Siswa::whereIn('siswa_id', $request->siswa_ids)
            ->update(['status' => 'Lulus']);

        Log::info('Jumlah baris yang diperbarui:', ['affected_rows' => $affectedRows]);

        return response()->json([
            'message' => 'Status berhasil diperbarui!',
        ]);
    } catch (\Exception $e) {
        Log::error('Terjadi kesalahan saat update status:', [
            'error_message' => $e->getMessage(),
            'error_trace' => $e->getTraceAsString(),
        ]);

        // Response dengan error
        return response()->json([
            'message' => 'Terjadi kesalahan saat memperbarui status!',
            'error' => $e->getMessage(),
        ], 500);
    }
}

    

    
}
