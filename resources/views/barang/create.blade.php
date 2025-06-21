@extends('layouts.app')

@section('title', 'Tambah Barang')

@push('styles')
<!-- Font Awesome & Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endpush

@section('content')
<div class="container py-4">
    <div class="card shadow animate__animated animate__fadeInUp">
        <div class="card-header bg-primary text-white d-flex align-items-center gap-2">
            <i class="fas fa-plus fa-lg"></i>
            <h4 class="mb-0">Tambah Barang Baru</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Kategori -->
                <div class="mb-3">
                    <label for="kategori_barang_id" class="form-label">
                        <i class="fas fa-tags me-1 text-primary"></i> Kategori Barang
                    </label>
                    <select name="kategori_barang_id" id="kategori_barang_id" class="form-select" required>
                        <option value="" disabled selected>-- Pilih Kategori --</option>
                        @foreach ($kategoriBarangs as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Nama Barang -->
                <div class="mb-3">
                    <label for="nama_barang" class="form-label">
                        <i class="fas fa-box me-1 text-primary"></i> Nama Barang
                    </label>
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" required autofocus>
                </div>

                <!-- Jumlah -->
                <div class="mb-3">
                    <label for="jumlah" class="form-label">
                        <i class="fas fa-layer-group me-1 text-primary"></i> Jumlah
                    </label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required>
                </div>

                <!-- Gambar -->
                <div class="mb-3">
                    <label for="gambar" class="form-label">
                        <i class="fas fa-image me-1 text-primary"></i> Gambar Barang (opsional)
                    </label>
                    <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                    <small class="text-muted">Unggah gambar barang jika ada.</small>
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    input.form-control:focus, select.form-select:focus {
        box-shadow: 0 0 8px rgba(13,110,253,0.5);
        border-color: #0d6efd;
    }
</style>
@endsection
