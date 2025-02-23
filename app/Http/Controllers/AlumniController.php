<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasippdb;
use App\Models\Alumni;
use App\Rules\NoXSSInput;
use App\Models\Siswa;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AlumniController extends Controller
{
    public function Alumni()
    {
        $informasippdb = Informasippdb::where('status', 'Aktif')->first();
  
        
        return view('Alumni.index', compact('informasippdb'));
    }
    public function index()
    {
        $informasippdb = Informasippdb::where('status', 'Aktif')->first();

        $listalumni = Alumni::paginate(5);
  
        
        return view('Listalumni.index', compact('listalumni','informasippdb'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'foto' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:512'],
            'NamaLengkap' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/',
                'unique:tb_alumni,NamaLengkap',
            ],
            'JenisKelamin' => [
                'required',
                'string',
                'in:Laki-Laki,Perempuan',
            ],
            'TempatLahir' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'TanggalLahir' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'before:today',
            ],
            'Agama' => [
                'required',
                'string',
                'in:Katolik,Kristen Protestan,Islam,Hindu,Buddha,Konghucu',
            ],
            'Alamat' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9\s,.]+$/',
            ],
            'Email' => [
                'required',
                'string',
                'email',
                'max:255',
                new NoXSSInput(),
            ],
            'NomorTelephone' => [
                'required',
                'string',
                'max:13',
                'regex:/^[0-9]+$/',
            ],
            'TahunLulus' => [
                'required',
                'integer',
                'digits:4',
                'min:1901',
                'max:9999',
            ],
            'TahunMasuk' => [
                'required',
                'integer',
                'digits:4',
                'min:1901',
                'max:9999',
            ],
            'Jurusan' => [
                'nullable',
                'string',
                'max:255',
                new NoXSSInput(),
            ],
            'ProgramStudi' => [
                'nullable',
                'string',
                'max:255',
                new NoXSSInput(),
            ],
            'Gelar' => [
                'nullable',
                
                'in:D1,D2,D3,D4,S1,S2,Prof,Tidak Ada',
            ],
            'PerguruanTinggi' => [
                'nullable',
                'string',
                'max:255',
                new NoXSSInput(),
            ],
            'StatusPekerja' => [
                'nullable',
                'string',
                'in:Bekerja,Wirausaha,Belum Bekerja',
            ],
            'NamaPerusahaan' => [
                'nullable',
                'string',
                'max:255',
                new NoXSSInput(),
            ],
            'Ig' => [
                'nullable',
                'string',
                'max:255',
                new NoXSSInput(),
            ],
            'Linkedin' => [
                'nullable',
                'string',
                'max:255',
                new NoXSSInput(),
            ],
          
           
            'Facebook' => [
                'nullable',
                'string',
                'max:255',
                new NoXSSInput(),
            ],
            'Testimoni' => [
                'required',
                'string',
                'max:400',
                new NoXSSInput(),
            ],
        ], [
        
                        // Pesan Custom
                        'foto.required' => 'Foto wajib diunggah.',
                        'foto.image' => 'File harus berupa gambar.',
                        'foto.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
                        'foto.max' => 'Ukuran gambar tidak boleh lebih dari 512 KB.',
                        
                        'NamaLengkap.required' => 'Nama Lengkap wajib diisi.',
                        'NamaLengkap.string' => 'Nama Lengkap harus berupa teks.',
                        'NamaLengkap.max' => 'Nama Lengkap tidak boleh lebih dari 255 karakter.',
                        'NamaLengkap.regex' => 'Nama Lengkap hanya boleh mengandung huruf dan spasi.',
                    
                        'JenisKelamin.required' => 'Jenis Kelamin wajib diisi.',
                        'JenisKelamin.in' => 'Jenis Kelamin harus Laki-Laki atau Perempuan.',
                    
                        'TempatLahir.required' => 'Tempat Lahir wajib diisi.',
                        'TempatLahir.string' => 'Tempat Lahir harus berupa teks.',
                        'TempatLahir.max' => 'Tempat Lahir tidak boleh lebih dari 255 karakter.',
                        'TempatLahir.regex' => 'Tempat Lahir hanya boleh mengandung huruf dan spasi.',
                    
                        'TanggalLahir.required' => 'Tanggal Lahir wajib diisi.',
                        'TanggalLahir.date' => 'Tanggal Lahir harus berupa tanggal yang valid.',
                        'TanggalLahir.date_format' => 'Format Tanggal Lahir harus YYYY-MM-DD.',
                        'TanggalLahir.before' => 'Tanggal Lahir harus sebelum hari ini.',
                    
                        'Agama.required' => 'Agama wajib diisi.',
                        'Agama.in' => 'Agama harus salah satu dari: Katolik, Kristen Protestan, Islam, Hindu, Buddha, Konghucu.',
                    
                        'Alamat.required' => 'Alamat wajib diisi.',
                        'Alamat.string' => 'Alamat harus berupa teks.',
                        'Alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
                        'Alamat.regex' => 'Alamat hanya boleh mengandung huruf, angka, spasi, koma, dan titik.',
                    
                        'Email.required' => 'Email wajib diisi.',
                        'Email.string' => 'Email harus berupa teks.',
                        'Email.max' => 'Email tidak boleh lebih dari 255 karakter.',
                    
                        'NomorTelephone.required' => 'Nomor Telepon wajib diisi.',
                        'NomorTelephone.string' => 'Nomor Telepon harus berupa teks.',
                        'NomorTelephone.max' => 'Nomor Telepon tidak boleh lebih dari 13 karakter.',
                        'NomorTelephone.regex' => 'Nomor Telepon hanya boleh berisi angka.',
                    
                        'TahunLulus.required' => 'Tahun Lulus wajib diisi.',
                        'TahunLulus.integer' => 'Tahun Lulus harus berupa angka.',
                        'TahunLulus.digits' => 'Tahun Lulus harus terdiri dari 4 digit.',
                        'TahunMasuk.required' => 'Tahun Masuk wajib diisi.',
                        'TahunMasuk.integer' => 'Tahun Masuk harus berupa angka.',
                        'TahunMasuk.digits' => 'Tahun Masuk harus terdiri dari 4 digit.',
                    
                        'Gelar.in' => 'Gelar harus salah satu dari: D1, D2, D3, D4, S1, S2, Prof, atau Tidak Ada.',
                    
                        'StatusPekerja.in' => 'Status Pekerja harus salah satu dari: Bekerja, Wirausaha, atau Belum Bekerja.',
                    
                        'Testimoni.required' => 'Kesan dan Pesan wajib diisi.',
                        'Testimoni.string' => 'Kesan dan Pesan harus berupa teks.',
                    ]);
      
        
        try {
            DB::beginTransaction();
            
            $filePath = null;
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
                $file->storeAs('public/alumni', $fileName);
                $filePath = $fileName;
            }
            $tanggalLahir = null;
            if (!empty($validatedData['TanggalLahir'])) {
                $tanggalLahir = Carbon::createFromFormat('Y-m-d', $validatedData['TanggalLahir'])->format('Y-m-d');
            }
            $alumni = Alumni::create([
                'foto' => $filePath,
                'NamaLengkap' => $validatedData['NamaLengkap'],
                'JenisKelamin' => $validatedData['JenisKelamin'],
                'TempatLahir' => $validatedData['TempatLahir'],
                'TanggalLahir' => $tanggalLahir,
                'Agama' => $validatedData['Agama'],
                'Alamat' => $validatedData['Alamat'],
                'Email' => $validatedData['Email'],
                'NomorTelephone' => $validatedData['NomorTelephone'],
                'TahunLulus' => $validatedData['TahunLulus'],
                'TahunMasuk' => $validatedData['TahunMasuk'],
                'Jurusan' => $validatedData['Jurusan'],
                'ProgramStudi' => $validatedData['ProgramStudi'],
                'Gelar' => $validatedData['Gelar'],
                'PerguruanTinggi' => $validatedData['PerguruanTinggi'],
                'StatusPekerja' => $validatedData['StatusPekerja'],
                'NamaPerusahaan' => $validatedData['NamaPerusahaan'],
                'Ig' => $validatedData['Ig'],
                'Linkedin' => $validatedData['Linkedin'],
                'Facebook' => $validatedData['Facebook'],
                'Testimoni' => $validatedData['Testimoni'],
            ]);
    
            DB::commit();
            return redirect()->route('Alumni.index')->with('success', 'Pendaftaran Alumni berhasil, Semoga anda bisa berkontribusi kepada almamater anda:)');
    
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Delete uploaded file if exists
            if ($filePath && Storage::exists('public/alumni/' . $filePath)) {
                Storage::delete('public/alumni/' . $filePath);
            }
            
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])
                ->withInput();
        }
    }
    public function getAlumni()
    {
        $alumni = Alumni::select(['id','foto', 'NamaLengkap', 'Alamat', 'Email','NomorTelephone','TahunMasuk','TahunLulus','Ig','Linkedin','Tiktok','Facebook','Testimoni'])
            ->get()
            ->map(function ($alumni) { 
                return $alumni;
            });
        return DataTables::of($alumni)
           
            ->make(true);
    }
}
