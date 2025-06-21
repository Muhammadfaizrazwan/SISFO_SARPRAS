@extends('layouts.app')

@push('styles')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endpush

@section('title', 'Laporan Peminjaman Barang')

@section('content')
<div class="container animate__animated animate__fadeIn">
    <h2 class="mb-4"><i class="fas fa-file-alt me-2"></i>Laporan Peminjaman Barang</h2>

    <form method="GET" action="{{ route('laporan.index') }}" class="mb-4 p-3 bg-light rounded shadow-sm">
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
            <div class="col-md-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="Dipinjam" {{ request('status') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="Dikembalikan" {{ request('status') == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                </select>
            </div>
            <div class="col-md-3 d-grid">
                <button type="submit" class="btn btn-primary"><i class="fas fa-filter me-1"></i>Filter</button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Barang</th>
                    <th>Nama Peminjam</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjamans as $peminjaman)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ optional($peminjaman->barang)->nama_barang ?? 'Barang tidak ditemukan' }}</td>
                        <td>{{ $peminjaman->nama_peminjam }}</td>
                        <td>{{ $peminjaman->jumlah }}</td>
                        <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}</td>
                        <td>{{ $peminjaman->tanggal_kembali ? \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d M Y') : '-' }}</td>
                        <td>
                            @if ($peminjaman->status === 'Dipinjam')
                                <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i>Dipinjam</span>
                            @elseif ($peminjaman->status === 'Dikembalikan')
                                <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Dikembalikan</span>
                            @else
                                <span class="badge bg-secondary">{{ $peminjaman->status }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4 d-flex gap-2">
        <a href="{{ route('laporan.peminjaman.pdf') }}" class="btn btn-primary">Download PDF </a>

        </a>
        <a href="{{ route('laporan.peminjaman.excel') }}" class="btn btn-success shadow-sm">

            <i class="fas fa-file-excel me-1"></i>Export Excel
        </a>
    </div>
</div>
@endsection
