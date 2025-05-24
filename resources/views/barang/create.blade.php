@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
    <div class="container">
        <h2 class="mb-4">Tambah Barang</h2>
       <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="kategori_barang_id" class="form-label">Kategori</label>
                <select name="kategori_barang_id" id="kategori_barang_id" class="form-select" required>
                    @foreach ($kategoriBarangs as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
            </div>


            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
