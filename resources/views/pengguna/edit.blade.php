@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pengguna</h2>

    <form action="{{ route('pengguna.update', $pengguna->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="{{ $pengguna->email }}" required>
        </div>

        <div class="mb-3">
            <label>Password Baru (opsional):</label>
            <input type="password" name="password" class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
