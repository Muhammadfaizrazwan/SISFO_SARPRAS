@extends('layouts.app')

@section('title', 'Kategori Barang')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">
            <i class="fas fa-tags text-primary me-2"></i> Kategori Barang
        </h2>
        <a href="{{ route('kategori.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Kategori
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($kategoriBarangs->count())
        <div class="table-responsive">
            <table class="table table-hover align-middle shadow-sm animate__animated animate__fadeIn">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th><i class="fas fa-tag me-1"></i>Nama Kategori</th>
                        <th style="width: 20%;"><i class="fas fa-cogs me-1"></i>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategoriBarangs as $kategori)
                        <tr class="align-middle">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-2">
                                        <i class="fas fa-box text-secondary fa-lg"></i>
                                    </div>
                                    <div>{{ $kategori->nama_kategori }}</div>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-1"></i> Belum ada kategori barang.
        </div>
    @endif
</div>
@endsection

@push('styles')
<!-- Animate.css for smooth entrance -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endpush
