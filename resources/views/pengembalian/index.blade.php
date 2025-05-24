@extends('layouts.app')

@section('title', 'Daftar Pengembalian Barang')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Barang</th>
                <th>Nama Peminjam</th>
                <th>Jumlah Dikembalikan</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengembalians as $pengembalian)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pengembalian->barang->nama_barang }}</td>
                    <td>{{ $pengembalian->nama_peminjam }}</td>
                    <td>{{ $pengembalian->jumlah }}</td>
                    <td>{{ $pengembalian->tanggal_kembali }}</td>
                    <td>{{ $pengembalian->status }}</td>
                    <td>
                        <a href="{{ route('pengembalian.edit', $pengembalian->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pengembalian.destroy', $pengembalian->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
