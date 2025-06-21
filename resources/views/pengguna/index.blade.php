@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex align-items-center mb-4">
        <!-- Logo dengan animasi -->
        <img src="https://cdn-icons-png.flaticon.com/512/1077/1077012.png" alt="Logo Pengguna" width="50" height="50" class="me-3 animate-logo">
        <h2 class="fw-bold text-primary animate-header">Daftar Pengguna</h2>
    </div>

    <a href="{{ route('pengguna.create') }}" class="btn btn-primary mb-4 shadow-sm btn-animate">
        <i class="bi bi-person-plus me-2"></i>Tambah Pengguna
    </a>

    <div class="table-responsive shadow rounded">
        <table class="table table-hover align-middle bg-white">
            <thead class="table-primary">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Email</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengguna as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center">
                        <a href="{{ route('pengguna.edit', $user->id) }}" class="btn btn-sm btn-warning me-2 shadow-sm btn-animate">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="{{ route('pengguna.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger shadow-sm btn-animate">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Tambahkan CSS animasi -->
<style>
    /* Animasi untuk logo berputar */
    @keyframes logo-spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .animate-logo {
        animation: logo-spin 5s linear infinite;
    }

    /* Animasi header fade-in */
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-header {
        animation: fade-in 1s ease forwards;
    }

    /* Animasi tombol scale */
    .btn-animate {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn-animate:hover, .btn-animate:focus {
        transform: scale(1.05);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        z-index: 2;
    }
</style>

<!-- Bootstrap Icons CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

@endsection
