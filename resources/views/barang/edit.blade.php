@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Data Barang</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada kesalahan saat mengisi form:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barang.update', $barang->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="kategori_barang_id" class="form-label">Kategori Barang</label>
            <select name="kategori_barang_id" id="kategori_barang_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoriBarangs as $kategori)
                    <option value="{{ $kategori->id }}" {{ $barang->kategori_barang_id == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control"
                   value="{{ old('nama_barang', $barang->nama_barang) }}" required>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control"
                   value="{{ old('jumlah', $barang->jumlah) }}" min="1" required>
        </div>



        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
