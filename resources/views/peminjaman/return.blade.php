{{-- @extends('layouts.app')

@section('title', 'Pengembalian Barang')

@section('content')
<div class="container">
    <h2 class="mb-4">Pengembalian Barang</h2>

    <td>
        <a href="{{ route('peminjaman.edit', $peminjaman->id) }}" class="btn btn-warning btn-sm">Edit</a>

        @if ($peminjaman->status == 'Dipinjam')
            <a href="{{ route('peminjaman.returnForm', $peminjaman->id) }}" class="btn btn-success btn-sm">Kembalikan</a>
        @endif

        <form action="{{ route('peminjaman.destroy', $peminjaman->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
        </form>
    </td>

    <form action="{{ route('peminjaman.returnUpdate', $peminjaman->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="barang" class="form-label">Barang</label>
            <input type="text" id="barang" class="form-control" value="{{ $peminjaman->barang->nama_barang }}" disabled>
        </div>
        <div class="mb-3">
            <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
            <input type="text" id="nama_peminjam" class="form-control" value="{{ $peminjaman->nama_peminjam }}" disabled>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Dipinjam</label>
            <input type="number" id="jumlah" class="form-control" value="{{ $peminjaman->jumlah_dipinjam }}" disabled>
        </div>
        <div class="mb-3">
            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" id="tanggal_pinjam" class="form-control" value="{{ $peminjaman->tanggal_pinjam }}" disabled>
        </div>
        <div class="mb-3">
            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection --}}
