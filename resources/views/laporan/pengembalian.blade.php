@extends('layouts.app')

@push('styles')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endpush

@section('title', 'Laporan Pengembalian Barang')

@section('content')
<div class="container animate__animated animate__fadeIn">
    <h2 class="mb-4"><i class="fas fa-file-alt me-2"></i>Laporan Pengembalian Barang</h2>

    <form method="GET" action="{{ route('laporan.pengembalian') }}" class="mb-4 p-3 bg-light rounded shadow-sm">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai') }}">
            </div>
            <div class="col-md-4">
                <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
            </div>
            <div class="col-md-4 d-grid">
                <button type="submit" class="btn btn-primary"><i class="fas fa-filter me-1"></i>Filter</button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-success">
                <tr>
                    <th>#</th>
                    <th>Barang</th>
                    <th>Nama Peminjam</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengembalians as $pengembalian)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ optional($pengembalian->barang)->nama_barang ?? 'Barang tidak ditemukan' }}</td>
                        <td>{{ $pengembalian->nama_peminjam }}</td>
                        <td>{{ $pengembalian->jumlah }}</td>
                        <td>{{ \Carbon\Carbon::parse($pengembalian->tanggal_pinjam)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($pengembalian->tanggal_kembali)->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data pengembalian.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 d-flex gap-2">
        <a href="{{ route('laporan.pengembalian.pdf') }}" class="btn btn-primary">
            <i class="fas fa-file-pdf me-1"></i>Download PDF
        </a>
       <a href="{{ route('laporan.pengembalian.excel') }}" class="btn btn-success">Export Excel</a>
        </a>
    </div>
</div>
@endsection
