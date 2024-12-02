@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create User</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="Username">Username</label>
            <input type="text" name="Username" class="form-control">
        </div>
        <div class="mb-3">
            <label for="Role">Role</label>
            <input type="text" name="Role" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection
