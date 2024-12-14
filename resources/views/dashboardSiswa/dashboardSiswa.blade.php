@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Dashboard Siswa')

@section('content')
<style>
  .text-center {
      text-align: center;
  }
</style>
@if(session('warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: '{{ session('warning') }}',
        });
    </script>
@endif

