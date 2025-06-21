@extends('layouts.app')

@push('styles')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
@endpush

@section('title', 'Laporan Barang')

@section('content')
<div class="container animate__animated animate__fadeIn">
    <h2 class="mb-4 d-flex align-items-center gap-2">
        <i class="fas fa-boxes"></i>
        Laporan Barang
    </h2>

    <form method="GET" action="{{ route('laporan.barang.pdf') }}" class="mb-4 p-3 bg-light rounded shadow-sm">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control"
                       value="{{ request('tanggal_mulai') }}">
            </div>
            <div class="col-md-3">
                <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control"
                       value="{{ request('tanggal_akhir') }}">
            </div>
            <div class="col-md-3 d-grid">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter me-1"></i>Filter
                </button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Kategori</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Gambar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $barang)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $barang->kategori->nama_kategori }}</td> <!-- Removed badge -->
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->jumlah }}</td>
                        <td>
                            @if ($barang->gambar)
                                <img src="{{ asset('storage/' . $barang->gambar) }}"
                                     alt="{{ $barang->nama_barang }}"
                                     class="img-thumbnail"
                                     style="width: 60px; height: auto;">
                            @else
                                <span class="text-muted fst-italic">Tidak ada</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4 d-flex gap-2">
        <a href="{{ route('laporan.barang.pdf') }}" class="btn btn-secondary">
            <i class="fas fa-file-pdf me-1"></i>Download PDF Barang
        </a>
        <a href="{{ route('laporan.barang.excel') }}" class="btn btn-success shadow-sm">
            <i class="fas fa-file-excel me-1"></i>Export Excel
        </a>
    </div>
</div>
@endsection
