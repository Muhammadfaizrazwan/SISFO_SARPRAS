@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
    <div class="container">
        <h2 class="mb-4">Daftar Barang</h2>
        <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">Tambah Barang</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif


        <form action="{{ route('barang.index') }}" method="GET" class="mb-3 d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari nama barang..."
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary">Cari</button>
        </form>


        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kategori</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
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
                        <td>
                            <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection
