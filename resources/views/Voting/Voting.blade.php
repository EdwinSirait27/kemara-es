

@extends('layouts.user_type.auth')
@section('title', 'Pemilihan')
@section('content')
    <style>
        .chart-canvas {
            display: block;
            width: 100%;
            height: 300px;
            z-index: 1;
        }

        .osis-card {
            margin-bottom: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .osis-card:hover {
            transform: scale(1.05);
        }

        .osis-card img {
            width: 80%;
            height: 400px;
            object-fit: cover;
        }

        .osis-card .caption {
            padding: 15px;
            background-color: #f8f9fa;
        }

        .osis-card p {
            margin: 5px 0;
        }

        .vote-button {
            margin-top: 15px;
        }
    </style>

    <div class="container">
        <h3 class="text-center mb-4">Pemilihan Ketua OSIS</h3>
        @if(session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
    <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
        @foreach ($errors->all() as $error)
            <span class="alert-text text-white">
                {{ $error }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </button>
        @endforeach
    </div>
@endif
<form method="POST" action="{{ route('Voting.store') }}" id="voteForm">
    @csrf
    <div class="row">
        @foreach ($osiss as $osis)
            <div class="col-md-4 col-sm-6">
                <div class="osis-card">
                    <div class="image view view-first">
                        <img src="{{ asset('storage/fotosiswa/' . $osis->siswa->foto) }}" alt="Foto {{ $osis->siswa->NamaLengkap }}" />
                    </div>
                    <div class="caption">
                        <p><strong>Nama Lengkap:</strong> {{ $osis->siswa->NamaLengkap }}</p>
                        <p><strong>Visi:</strong> {{ $osis->visi }}</p>
                        <p><strong>Misi:</strong> {{ $osis->misi }}</p>
                        <div class="form-check text-center">
                            {{-- ini itu id osis dari model osisnya bukan dari model voting  --}}
                             <input type="checkbox" name="osis_id[]" value="{{ $osis->id }}"> Pilih
                            
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="text-center vote-button">
        <button type="submit" id="voteButton" class="btn btn-primary">Vote!</button>
    </div>
</form>

    </div>
    <h1>tes</h1>
    

@endsection 
