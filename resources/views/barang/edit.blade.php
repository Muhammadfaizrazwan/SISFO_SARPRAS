@extends('layouts.app')

@section('title', 'Edit Barang')

@push('styles')
<!-- Font Awesome & Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endpush

@section('content')
<div class="container py-4">
    <div class="card shadow animate__animated animate__fadeInUp">
        <div class="card-header bg-primary text-white d-flex align-items-center gap-2">
            <i class="fas fa-edit fa-lg"></i>
            <h4 class="mb-0">Edit Data Barang</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger animate__animated animate__shakeX">
                    <strong>Oops!</strong> Ada kesalahan saat mengisi form:<br><br>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Kategori -->
                <div class="mb-3">
                    <label for="kategori_barang_id" class="form-label">
                        <i class="fas fa-tags me-1 text-primary"></i> Kategori Barang
                    </label>
                    <select name="kategori_barang_id" id="kategori_barang_id" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoriBarangs as $kategori)
                            <option value="{{ $kategori->id }}" {{ $barang->kategori_barang_id == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Nama Barang -->
                <div class="mb-3">
                    <label for="nama_barang" class="form-label">
                        <i class="fas fa-box me-1 text-primary"></i> Nama Barang
                    </label>
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control"
                           value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                </div>

                <!-- Jumlah -->
                <div class="mb-3">
                    <label for="jumlah" class="form-label">
                        <i class="fas fa-layer-group me-1 text-primary"></i> Jumlah
                    </label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control"
                           value="{{ old('jumlah', $barang->jumlah) }}" min="1" required>
                </div>

                <!-- Gambar -->
                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-image me-1 text-primary"></i> Gambar Barang Saat Ini
                    </label>
                    <div class="mb-2">
                        @if ($barang->gambar)
                            <img src="{{ asset('storage/' . $barang->gambar) }}"
                                 alt="Gambar Barang" class="img-thumbnail"
                                 style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                            <p class="text-muted fst-italic">Tidak ada gambar</p>
                        @endif
                    </div>
                    <label for="gambar" class="form-label">
                        <i class="fas fa-upload me-1 text-primary"></i> Ganti Gambar (opsional)
                    </label>
                    <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Styling tambahan -->
<style>
    input.form-control:focus, select.form-select:focus {
        box-shadow: 0 0 8px rgba(13,110,253,0.4);
        border-color: #0d6efd;
    }
</style>
@endsection
