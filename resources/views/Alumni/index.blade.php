@extends('app2')
@section('title', 'Alumni - SMA KATOLIK KESUMA MATARAM')
@section('meta_description', 'Selamat datang di pendaftaran alumni SMAKERZ.')

@section('meta_keywords', 'Alumni, Pendaftaran Alumni')

@section('content')
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .container h1 {
            color: var(--primary-color);
            margin-bottom: 20px;
            text-align: center;
            font-size: 2rem;
        }

        .slider-wrapper {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--soft-shadow);
        }

        .slider {
            min-height: 700px;
            display: flex;
            align-items: center;
            justify-content: center;
        }


        .slider-item {
            display: none;
        }

        .slider-item img.slider-image {
            width: 120%;
            max-height: 100vh;
            height: auto;
            width: auto;
            object-fit: contain;
            transition: transform 0.3s ease;
        }


        .slider-item img.slider-image:hover {
            transform: scale(5.02);
        }

        .slider-nav {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 15px;
        }

        .slider-nav button {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .slider-nav button:hover {
            background-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .slider-content {
            padding: 20px;
            line-height: 1.6;
        }

        .slider-content p {
            margin-bottom: 1em;
            text-align: justify;
            color: var(--text-color);
        }

        .author-info {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .author-info p {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }

        .author-info strong {
            color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .slider-wrapper {
                padding: 15px;
            }

            .slider-item img.slider-image {
                max-height: 300px;
            }

            .slider-nav button {
                padding: 8px 15px;
                font-size: 14px;
            }
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            position: relative;
        }

        .container h1 {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: clamp(1.8rem, 4vw, 2.5rem);
            font-weight: 700;
            letter-spacing: -0.5px;
            position: relative;
            padding-bottom: 1rem;
        }

        .container h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            border-radius: 2px;
        }

        /* Modern Slider Wrapper */
        .slider-wrapper {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .slider-wrapper:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        /* Modern Slider Component */
        .slider {
            position: relative;
            margin-bottom: 2rem;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .slider-item {
            display: none;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.98);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .slider-item img.slider-image {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 12px;
            transition: all 0.5s ease;
        }

        .slider-item:hover img.slider-image {
            transform: scale(1.03);
            filter: brightness(1.05);
        }

        /* Modern Slider Navigation */
        .slider-nav {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .slider-nav button {
            background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .slider-nav button:hover {
            background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Modern Content Section */
        .slider-content {
            padding: 2rem;
            line-height: 1.8;
        }

        .slider-content p {
            margin-bottom: 1.5rem;
            text-align: justify;
            color: var(--text-color);
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Modern Author Information */
        .author-info {
            margin-top: 2rem;
            padding: 1.5rem;
            background: linear-gradient(to right, rgba(var(--primary-color-rgb), 0.05), rgba(var(--accent-color-rgb), 0.05));
            border-radius: 12px;
            border: 1px solid rgba(var(--primary-color-rgb), 0.1);
        }

        .author-info p {
            font-size: 0.95rem;
            color: var(--text-color);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .author-info strong {
            color: var(--primary-color);
            font-weight: 600;
        }

        /* Glass Morphism Effect */
        .glass-effect {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
        }

        /* Loading Skeleton Animation */
        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }

            100% {
                background-position: 1000px 0;
            }
        }

        .loading {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 1000px 100%;
            animation: shimmer 2s infinite;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .container {
                padding: 1.5rem;
            }

            .slider-item img.slider-image {
                height: 400px;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .slider-wrapper {
                padding: 1rem;
            }

            .slider-item img.slider-image {
                height: 300px;
            }

            .slider-nav button {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }

            .slider-content p {
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .slider-item img.slider-image {
                height: 250px;
            }

            .author-info {
                padding: 1rem;
            }
        }

        /* Print Styles */
        @media print {
            .slider-nav {
                display: none;
            }

            .slider-wrapper {
                box-shadow: none;
            }

            .slider-item {
                page-break-inside: avoid;
            }
        }

        /* disini diganti */
        /* Form Container Styles */
        .card-body {
            padding: 2rem;
            background: linear-gradient(to right, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.98));
            border-radius: 1rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        /* Form Row Styling */
        .row.mb-3 {
            margin-bottom: 2rem !important;
            position: relative;
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            gap: 1rem;
            width: 100%;
        }

        /* Column Styling */
        .col-md-4 {
            flex: 1;
            min-width: 0;
            /* Prevents flex items from overflowing */
            padding: 0 0.5rem;
        }

        /* Label Styling */
        .col-md-4 label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
        }

        .col-md-4 label i {
            color: #3498db;
            font-size: 1rem;
        }

        /* Input Field Styling */
        .form-control {
            width: 100%;
            border: 2px solid #e9ecef;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
            background-color: #ffffff;
        }

        .form-control::placeholder {
            color: #95a5a6;
            font-size: 0.9rem;
        }

        /* Error Styling */
        .text-danger {
            font-size: 0.8rem;
            margin-top: 0.5rem !important;
            display: block;
            font-weight: 500;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .row.mb-3 {
                flex-wrap: wrap;
            }

            .col-md-4 {
                flex: 100%;
                margin-bottom: 1rem;
            }
        }

        /* Hover Effects */
        .form-control:hover {
            border-color: #cbd5e0;
        }

        .col-md-4:hover label {
            color: #3498db;
        }

        /* Error State */
        .form-control.is-invalid {
            border-color: #e74c3c;
        }

        /* Styling tombol */
        #daftar-btn {
            background: linear-gradient(135deg, #007bff, #00c3ff);
            /* Gradasi biru */
            border: none;
            color: white;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 4px 10px rgba(0, 123, 255, 0.3);
        }

        #daftar-btn:hover {
            background: linear-gradient(135deg, #0056b3, #0097d7);
            box-shadow: 0px 6px 15px rgba(0, 123, 255, 0.5);
            transform: scale(1.05);
        }

        /* Styling tombol Cancel */
        #cancel-btn {
            background: linear-gradient(135deg, #6c757d, #adb5bd);
            /* Gradasi abu-abu */
            border: none;
            color: white;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 4px 10px rgba(108, 117, 125, 0.3);
        }

        #cancel-btn:hover {
            background: linear-gradient(135deg, #495057, #868e96);
            box-shadow: 0px 6px 15px rgba(108, 117, 125, 0.5);
            transform: scale(1.05);
        }

        /* Agar tombol sejajar di tengah */
        .text-center {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
    </style>
    < <div class="container">
        <h1>Daftar Alumni</h1>
        </div>
        <div class="card-body">
            <form id="alumni-form" method="POST" action="{{ route('Alumni.store') }}" enctype="multipart/form-data">
                @csrf
                {{-- @if ($errors->has('throttle'))
                    <div class="alert alert-danger">
                        {{ $errors->first('throttle') }}
                    </div>
                @endif --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label"><i class="fas fa-user"></i> Nama Lengkap Alumni</label>

                        <input type="text" class="form-control @error('NamaLengkap') is-invalid @enderror"
                            name="NamaLengkap" id="NamaLengkap" value="{{ old('NamaLengkap') }}"
                            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" placeholder="Nama Lengkap Alumni"
                            required>
                        <p class="text-muted text-xs mt-2">Silahkan isi nama lengkap anda.</p>
                        @error('NamaLengkap')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><i class="fas fa-venus-mars"></i> Jenis Kelamin</label>
                        <select class="form-control @error('JenisKelamin') is-invalid @enderror" name="JenisKelamin"
                            id="JenisKelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki" {{ old('JenisKelamin') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki
                            </option>
                            <option value="Perempuan" {{ old('JenisKelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>
                        @error('JenisKelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><i class="fas fa-map-marker"></i> Tempat Lahir</label>
                        <input type="text" class="form-control @error('TempatLahir') is-invalid @enderror"
                            name="TempatLahir" id="TempatLahir" value="{{ old('TempatLahir') }}"
                            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" placeholder="Tmepat Lahir"
                            required>
                        @error('TempatLahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label"><i class="fas fa-calendar"></i> Tanggal Lahir</label>
                        <input type="date" class="form-control @error('TanggalLahir') is-invalid @enderror"
                            name="TanggalLahir" id="TanggalLahir" value="{{ old('TanggalLahir') }}"
                            max="{{ date('Y-m-d') }}" required>
                        @error('TanggalLahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label"><i class="fas fa-pray"></i> Agama</label>
                        <select class="form-control @error('Agama') is-invalid @enderror" name="Agama"id="Agama" required>
                            <option value="">Pilih Agama</option>
                            @foreach (['Katolik', 'Kristen Protestan', 'Islam', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                <option value="{{ $agama }}" {{ old('Agama') == $agama ? 'selected' : '' }}>
                                    {{ $agama }}</option>
                            @endforeach
                        </select>
                        @error('Agama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-4">
                        <label class="form-label"><i class="fab fa-whatsapp"></i> Nomor Whatsapp Aktif</label>
                        <input type="number" class="form-control @error('NomorTelephone') is-invalid @enderror"
                            name="NomorTelephone" id="NomorTelephone" value="{{ old('NomorTelephone') }}"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            maxlength="13"placeholder="Nomor Telephone" required>
                        @error('NomorTelephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" class="form-control @error('Email') is-invalid @enderror" name="Email"
                            id="Email" value="{{ old('Email') }}"placeholder="Email" required>
                        @error('Email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><i class="fas fa-home"></i> Alamat</label>
                        <input type="text" class="form-control @error('Alamat') is-invalid @enderror" name="Alamat"
                            id="Alamat" required value="{{ old('Alamat') }}"placeholder="Alamat">
                        @error('Alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><i class="fas fa-graduation-cap"></i> Tahun Masuk SMA</label>
                        <input type="number" class="form-control @error('TahunMasuk') is-invalid @enderror"
                            name="TahunMasuk" id="TahunMasuk"value="{{ old('TahunMasuk') }}" min="1900"
                            max="{{ date('Y') }}"placeholder="Tahun Masuk SMA" required>
                        @error('TahunMasuk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label"><i class="fas fa-graduation-cap"></i> Tahun Lulus SMA</label>
                        
                        <input type="number" class="form-control @error('TahunLulus') is-invalid @enderror"
                        name="TahunLulus" id="TahunLulus"value="{{ old('TahunLulus') }}" min="1900"
                        max="{{ date('Y') }}"placeholder="Tahun Lulus SMA" required>
                    @error('TahunLulus')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><i class="fas fa-book"></i> Jurusan</label>
                        <input type="text" class="form-control @error('Jurusan') is-invalid @enderror" name="Jurusan"
                            id="Jurusan" value="{{ old('Jurusan') }}"placeholder="Jurusan">
                        <p class="text-muted text-xs mt-2">Diisi - jika tidak melanjutkan ke perguruan tinggi.</p>
                        @error('Jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><i class="fas fa-book"></i> Program Studi</label>
                        <input type="text" class="form-control @error('ProgramStudi') is-invalid @enderror"
                            name="ProgramStudi" id="ProgramStudi"value="{{ old('ProgramStudi') }}"
                            placeholder="Program Studi">
                        <p class="text-muted text-xs mt-2">Diisi - jika tidak melanjutkan ke perguruan tinggi.</p>

                        @error('ProgramStudi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label"><i class="fas fa-venus-mars"></i> Gelar</label>
                            <select class="form-control @error('Gelar') is-invalid @enderror" name="Gelar" id="Gelar">
                                <option value="">Pilih Gelar</option>
                                <option value="D1" {{ old('Gelar') == 'D1' ? 'selected' : '' }}>D1</option>
                                <option value="D2" {{ old('Gelar') == 'D2' ? 'selected' : '' }}>D2</option>
                                <option value="D3" {{ old('Gelar') == 'D3' ? 'selected' : '' }}>D3</option>
                                <option value="D4" {{ old('Gelar') == 'D4' ? 'selected' : '' }}>D4</option>
                                <option value="S1" {{ old('Gelar') == 'S1' ? 'selected' : '' }}>S1</option>
                                <option value="S2" {{ old('Gelar') == 'S2' ? 'selected' : '' }}>S2</option>
                                <option value="Prof" {{ old('Gelar') == 'Prof' ? 'selected' : '' }}>Prof</option>
                                <option value="Tidak Ada" {{ old('Gelar') == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada
                                </option>
    
                            </select>
                            <p class="text-muted text-xs mt-2">Pilih Tidak Ada jika tidak melanjutkan ke perguruan tinggi.</p>
    
                            @error('Gelar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><i class="fas fa-book"></i> Perguruan Tinggi</label>
                            <input type="text" class="form-control @error('PerguruanTinggi') is-invalid @enderror"
                                name="PerguruanTinggi" value="{{ old('PerguruanTinggi') }}"placeholder="Perguruan Tinggi"
                                id="PerguruanTinggi">
                            <p class="text-muted text-xs mt-2">Diisi - jika tidak melanjutkan ke perguruan tinggi.</p>
    
                            @error('PerguruanTinggi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><i class="fas fa-venus-mars"></i>Status Pekerja</label>
                            <select class="form-control @error('StatusPekerja') is-invalid @enderror" name="StatusPekerja"
                                id="StatusPekerja">
                                <option value="">Pilih Status</option>
                                <option value="Bekerja" {{ old('StatusPekerja') == 'Bekerja' ? 'selected' : '' }}>Bekerja
                                </option>
                                <option value="Wirausaha" {{ old('StatusPekerja') == 'Wirausaha' ? 'selected' : '' }}>
                                    Wirausaha</option>
                                <option value="Belum Bekerja" {{ old('StatusPekerja') == 'Belum Bekerja' ? 'selected' : '' }}>
                                    Belum Bekerja</option>
    
                            </select>
    
                            @error('StatusPekerja')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label"><i class="fas fa-book"></i> Nama Instansi / Perusahaan</label>
                                <input type="text" class="form-control @error('NamaPerusahaan') is-invalid @enderror"
                                    name="NamaPerusahaan" id="NamaPerusahaan"
                                    value="{{ old('NamaPerusahaan') }}"placeholder="Nama Perusahaan">
                                <p class="text-muted text-xs mt-2">Diisi - jika tidak bekerja.</p>
        
                                @error('NamaPerusahaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
        
                            </div>
                            <div class="col-md-4">
                                <label class="form-label"><i class="fab fa-instagram"></i> Instagram</label>
                                <input type="text" class="form-control @error('Ig') is-invalid @enderror" name="Ig"
                                    id="Ig"value="{{ old('Ig') }}" placeholder="Instagram">
                                <p class="text-muted text-xs mt-2">Diisi Username Instagram anda optional.</p>
        
                                @error('Ig')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label"><i class="fab fa-linkedin"></i>LinkedIn</label>
                                <input type="text" class="form-control @error('Linkedin') is-invalid @enderror"
                                    name="Linkedin" id="Linkedin" value="{{ old('Linkedin') }}"placeholder="Linkedin">
                                <p class="text-muted text-xs mt-2">Diisi Username LinkedIn anda optional.</p>
        
                                @error('linkedin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label"><i class="fab fa-facebook"></i> Facebook</label>
                                <input type="text" class="form-control @error('Facebook') is-invalid @enderror"
                                    name="Facebook" id="Facebook" value="{{ old('Facebook') }}"placeholder="Facebook">
                                <p class="text-muted text-xs mt-2">Diisi Username Facebook anda optional.</p>
        
                                @error('Facebook')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label"><i class="fab fa-upload"></i> Upload Foto</label>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto"
                                    id="foto" accept="image/*" onchange="previewImage(event)">
                                <p class="text-muted text-xs mt-2">Foto harus berukuran 512 KB Kebawah dan ekstensi .jpeg, .jpg,
                                    dan .png</p>
        
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Pratinjau Foto</label>
                                <br>
                                <img id="preview" src="#" alt="Pratinjau Foto" class="img-thumbnail"
                                    style="display: none; max-width: 300px; height: auto;">
                            </div>
                        </div>
        
                        <script>
                            function previewImage(event) {
                                var input = event.target;
                                var reader = new FileReader();
        
                                reader.onload = function() {
                                    var preview = document.getElementById('preview');
                                    preview.src = reader.result;
                                    preview.style.display = 'block';
                                };
        
                                if (input.files && input.files[0]) {
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                        </script>
        
        
        
        
        

    
    




                   <br>
                <div class="col-md-4">
                    <label class="form-label"><i class="fas fa-male"></i> Kesan & Pesan</label>
                    <textarea type="text" class="form-control @error('Testimoni') is-invalid @enderror" name="Testimoni"
                        value="{{ old('Testimoni') }}"placeholder="Silahkan anda menuliskan kesan dan pesan anda" required></textarea>
                    @error('Testimoni')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
        </div>


        <br>
        <br>
        <div class="text-center">
            <!-- Tombol Daftar -->
            <button type="submit" id="daftar-btn">Daftar</button>

            <!-- Tombol Cancel -->
            <a href="/Beranda" id="cancel-btn">Cancel</a>
        </div>
        <br>
        <br>
        <br>


        </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if (session('warning'))
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: '{{ session('warning') }}',
                });
            </script>
        @endif
        @if (session('success'))
            <script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif
        {{-- @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error') }}',
                });
            </script>
        @endif --}}
        <script>
            document.getElementById('daftar-btn').addEventListener('click', function(e) {
                e.preventDefault(); // Mencegah pengiriman form langsung
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Pastikan data yang Anda masukkan sudah benar!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Daftar!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika pengguna mengkonfirmasi, submit form
                        document.getElementById('alumni-form').submit();
                    }
                });
            });
        </script>
    @endsection
