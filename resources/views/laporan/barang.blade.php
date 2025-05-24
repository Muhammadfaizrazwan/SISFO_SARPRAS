@extends('layouts.app')

@section('title', 'Laporan Barang')

@section('content')
    <div class="container">
        <h2 class="mb-4">Laporan Barang</h2>

        <form method="GET" action="{{route('laporanBarang.exportPDF') }}" class="mb-4">
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
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
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
                        <td>{{ $barang->kategori->nama_kategori }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->jumlah }}</td>
                        <td>
                            @if ($barang->gambar)
                                <img src="{{ asset('storage/' . $barang->gambar) }}" alt="{{ $barang->nama_barang }}"
                                    width="60">
                            @else
                                <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        <div class="mt-4">
          <a href="{{ route('laporanBarang.exportPDF') }}" class="btn btn-danger">Export PDF</a>
<a href="{{ route('laporanBarang.exportExcel') }}" class="btn btn-success">Export Excel</a>

        </div>
    </div>
@endsection
