@extends('layouts.app')

@section('title', 'Laporan Peminjaman Barang')

@section('content')
<div class="container">
    <h2 class="mb-4">Laporan Peminjaman Barang</h2>
    <form method="GET" action="{{ route('laporan.index') }}" class="mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai') }}">
            </div>
            <div class="col-md-3">
                <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
            </div>
            <div class="col-md-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="Dipinjam" {{ request('status') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="Dikembalikan" {{ request('status') == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
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
                    <td>{{ $peminjaman->barang->nama_barang }}</td>
                    <td>{{ $peminjaman->nama_peminjam }}</td>
                    <td>{{ $peminjaman->jumlah_dipinjam }}</td>
                    <td>{{ $peminjaman->tanggal_pinjam }}</td>
                    <td>{{ $peminjaman->tanggal_kembali ?? '-' }}</td>
                    <td>{{ $peminjaman->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        <a href="{{ route('laporan.exportPDF') }}" class="btn btn-danger">Export PDF</a>
        <a href="{{ route('laporan.exportExcel') }}" class="btn btn-success">Export Excel</a>
    </div>
</div>
@endsection
