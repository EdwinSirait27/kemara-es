@extends('app2') 
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
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
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
    from { opacity: 0; transform: scale(0.98); }
    to { opacity: 1; transform: scale(1); }
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
    0% { background-position: -1000px 0; }
    100% { background-position: 1000px 0; }
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
    min-width: 0; /* Prevents flex items from overflowing */
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
</style>
<  <div class="container">
        <h1>Daftar Alumni</h1>
</div>
<div class="card-body">
    <form id="alumni-form" method="POST" action="{{ route('Alumni.store') }}" enctype="multipart/form-data">
        @csrf
                                @if ($errors->has('throttle'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('throttle') }}
                                    </div>
                                @endif
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
                                        <label class="form-label"><i class="fas fa-user"></i> Nama Lengkap</label>
                       
                                        <input type="text" class="form-control @error('NamaLengkap') is-invalid @enderror" 
                               name="NamaLengkap" value="{{ old('NamaLengkap') }}"
                               oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                        @error('NamaLengkap')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label"><i class="fas fa-venus-mars"></i> Jenis Kelamin</label>
                        <select class="form-control @error('JenisKelamin') is-invalid @enderror" name="JenisKelamin">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki" {{ old('JenisKelamin') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                            <option value="Perempuan" {{ old('JenisKelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('JenisKelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label"><i class="fas fa-map-marker"></i> Tempat Lahir</label>
                                        <input type="text" class="form-control @error('TempatLahir') is-invalid @enderror" 
                                               name="TempatLahir" value="{{ old('TempatLahir') }}"
                                               oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                                        @error('TempatLahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label"><i class="fas fa-calendar"></i> Tanggal Lahir</label>
                                        <input type="date" class="form-control @error('TanggalLahir') is-invalid @enderror" 
                                               name="TanggalLahir" value="{{ old('TanggalLahir') }}" max="{{ date('Y-m-d') }}">
                                        @error('TanggalLahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label"><i class="fas fa-pray"></i> Agama</label>
                                        <select class="form-control @error('Agama') is-invalid @enderror" name="Agama">
                                            <option value="">Pilih Agama</option>
                                            @foreach(['Katolik', 'Kristen Protestan', 'Islam', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                                <option value="{{ $agama }}" {{ old('Agama') == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                                            @endforeach
                                        </select>
                                        @error('Agama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-md-4">
                                        <label class="form-label"><i class="fas fa-phone"></i> Nomor Telepon</label>
                        <input type="number" class="form-control @error('NomorTelephone') is-invalid @enderror" 
                               name="NomorTelephone" value="{{ old('NomorTelephone') }}"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="13">
                        @error('NomorTelephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
                                        <input type="email" class="form-control @error('Email') is-invalid @enderror" 
                                               name="Email" value="{{ old('Email') }}">
                                        @error('Email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label"><i class="fas fa-home"></i> Alamat</label>
                                        <input type="text" class="form-control @error('Alamat') is-invalid @enderror" 
                                               name="Alamat" value="{{ old('Alamat') }}">
                                        @error('Alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label"><i class="fas fa-graduation-cap"></i> Tahun Lulus</label>
                                        <input type="number" class="form-control @error('TahunLulus') is-invalid @enderror" 
                                               name="TahunLulus" value="{{ old('TahunLulus') }}" min="1900" max="{{ date('Y') }}">
                                        @error('TahunLulus')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label"><i class="fas fa-book"></i> Jurusan</label>
                        <input type="text" class="form-control @error('Jurusan') is-invalid @enderror" 
                               name="Jurusan" value="{{ old('Jurusan') }}">
                        @error('Jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>




                                    <div class="col-md-4">
                                        <label class="form-label"><i class="fas fa-book"></i> Program Studi</label>
                                        <input type="text" class="form-control @error('ProgramStudi') is-invalid @enderror" 
                                               name="ProgramStudi" value="{{ old('ProgramStudi') }}">
                                        @error('ProgramStudi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label><i class="fas fa-envelope"></i> Password</label>
                                        <div
                                            class="@error('password') border border-danger rounded-3 @enderror position-relative">
                                            <input class="form-control" type="password" placeholder="Masukkan Password"
                                                id="password" name="password" maxlength="12"
                                                oninput="this.value = this.value.replace(/<script.*?>.*?<\ /script>/gi, '')" required>
                                                        <span class="position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer"
                                                            onclick="togglePasswordVisibility('password')">
                                                            <i id="eye-icon-password" class="fas fa-eye"></i>
                                                        </span>
                                                        @error('password')
                                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                        @enderror
                                                        <script>
                                                            function togglePasswordVisibility(inputId) {
                                                                const input = document.getElementById(inputId);
                                                                const icon = document.getElementById(`eye-icon-${inputId}`);
                                                                if (input.type === "password") {
                                                                    input.type = "text";
                                                                    icon.classList.remove("fa-eye");
                                                                    icon.classList.add("fa-eye-slash");
                                                                } else {
                                                                    input.type = "password";
                                                                    icon.classList.remove("fa-eye-slash");
                                                                    icon.classList.add("fa-eye");
                                                                }
                                                            }
                                                        </script>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row
                                                mb-3">
                                            <div class="col-md-4">
                                                <label><i class="fas fa-user"></i> Konfirmasi Password</label>
                                                <div
                                                    class="@error('password_confirmation') border border-danger rounded-3 @enderror position-relative">
                                                    <input class="form-control" type="password"
                                                        placeholder="Konfirmasi Password Baru" id="password_confirmation"
                                                        name="password_confirmation" maxlength="12"
                                                        oninput="this.value = this.value.replace(/<script.*?>.*?<\ /script>/gi, '')"required>
                                                                <span class="position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer"
                                                                    onclick="togglePasswordVisibility('password_confirmation')">
                                                                    <i id="eye-icon-password_confirmation" class="fas fa-eye"></i>
                                                                </span>
                                                                @error('password_confirmation')
                                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                                @enderror
                                                                <script>
                                                                    function togglePasswordVisibility(inputId) {
                                                                        const input = document.getElementById(inputId);
                                                                        const icon = document.getElementById(`eye-icon-${inputId}`);
                                                                        if (input.type === "password") {
                                                                            input.type = "text";
                                                                            icon.classList.remove("fa-eye");
                                                                            icon.classList.add("fa-eye-slash");
                                                                        } else {
                                                                            input.type = "password";
                                                                            icon.classList.remove("fa-eye-slash");
                                                                            icon.classList.add("fa-eye");
                                                                        }
                                                                    }
                                                                </script>
                                        </div>
                                    </div>
                                </div>



















                               
                                <div class="text-center">
                                                    <button type="submit" id="daftar-btn"
                                                        class="btn bg-gradient-info w-35 mt-4 mb-0">Daftar</button>

                                                    <a href="/login" id="cancel-btn"
                                                        class="btn bg-gradient-secondary w-35 mt-4 mb-0">Cancel</a>
                                                </div>

                            </form>
                        </div>
@endsection
