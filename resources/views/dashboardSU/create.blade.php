@extends('layouts.user_type.auth')
@section('title', 'Kesuma-GO | Dashboard SU')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create User') }}</div>

                <div class="card-body">
                    {{-- Tampilkan pesan sukses --}}
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Tampilkan pesan error --}}
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Form untuk membuat user --}}
                    <form method="POST" action="{{ route('dashboardSU.store') }}">
                        @csrf

                        {{-- Input Username --}}
                        <div class="form-group mb-3">
                            <label for="username" class="form-label">{{ __('Username') }}</label>
                            <input id="username" type="text" 
                                   class="form-control @error('username') is-invalid @enderror" 
                                   name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                            
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Input Password --}}
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="new-password">
                            
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Input Password Confirmation --}}
                        <div class="form-group mb-3">
                            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password_confirmation" type="password" 
                                   class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        {{-- Submit Button --}}
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Create User') }}
                            </button>
                            <a href="{{ route('dashboardSU.index') }}" class="btn btn-secondary">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
