@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold d-flex align-items-center gap-2 animate__animated animate__fadeInDown">
            <i class="fas fa-box-open fa-lg animate__animated animate__bounceIn animate__slow"></i>
            Daftar Barang
        </h2>
        <a href="{{ route('barang.create') }}" class="btn btn-primary shadow-sm animate__animated animate__fadeIn">
            <i class="fas fa-plus me-1"></i> Tambah Barang
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Pencarian -->
    <form action="{{ route('barang.index') }}" method="GET" class="mb-3">
        <div class="input-group shadow-sm rounded" style="overflow: hidden;">
            <span class="input-group-text bg-white border-end-0">
                <i class="fas fa-search text-muted"></i>
            </span>
            <input type="text" name="search" class="form-control border-start-0" placeholder="Cari nama barang..."
                value="{{ request('search') }}" autofocus>
            <button class="btn btn-outline-primary" type="submit">Cari</button>
        </div>
    </form>

    @if($barangs->count())
        <div class="row g-4 animate__animated animate__fadeInUp">
            @foreach ($barangs as $barang)
                <div class="col-md-4 col-sm-6">
                    <div class="card shadow-sm h-100">
                        @if ($barang->gambar)
                            <img src="{{ asset('storage/' . $barang->gambar) }}" class="card-img-top" alt="{{ $barang->nama_barang }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                                <span class="text-muted fst-italic">Tidak ada gambar</span>
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-1">{{ $barang->nama_barang }}</h5>
                            <span class="badge bg-primary mb-2">{{ $barang->kategori->nama_kategori }}</span>
                            <p class="card-text mb-3">Jumlah: <strong>{{ $barang->jumlah }}</strong></p>
                            <div class="mt-auto d-flex justify-content-between">
                                <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-outline-warning btn-action">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger btn-action">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info d-flex align-items-center gap-2 animate__animated animate__fadeIn">
            <i class="fas fa-info-circle"></i> Tidak ada data barang ditemukan.
        </div>
    @endif
</div>

<!-- Style tambahan -->
<style>
    .btn-action {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .btn-action:hover, .btn-action:focus {
        transform: scale(1.05);
        box-shadow: 0 0.4rem 0.8rem rgba(0,0,0,0.12);
        z-index: 1;
    }
    input.form-control:focus {
        box-shadow: 0 0 8px rgba(13,110,253,0.5);
        border-color: #0d6efd;
    }
    .card-img-top {
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }
</style>
@endsection

@push('styles')
<!-- Font Awesome & Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endpush
