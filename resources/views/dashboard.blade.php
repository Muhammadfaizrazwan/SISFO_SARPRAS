@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard Admin</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Kategori Barang</h5>
                    <p class="card-text">Kelola data kategori barang.</p>
                    <a href="{{ route('kategori.index') }}" class="btn btn-light">Lihat Kategori</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Barang</h5>
                    <p class="card-text">Kelola data barang.</p>
                    <a href="{{ route('barang.index') }}" class="btn btn-light">Lihat Barang</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Peminjaman</h5>
                    <p class="card-text">Kelola data peminjaman barang.</p>
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-light">Lihat Peminjaman</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pengembalian</h5>
                    <p class="card-text">Kelola data pengembalian barang.</p>
                    <a href="{{ route('pengembalian.index') }}" class="btn btn-light">Lihat Pengembalian</a>
                </div>
            </div>
        </div>

         <div class="col-md-4">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pengguna</h5>
                    <p class="card-text">Regis Pengguna</p>
                    <a href="{{ route('pengguna.index') }}" class="btn btn-light">Lihat Pengguna</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Barang</h5>
                    <p class="card-text display-7">{{ $totalBarang }}</p>
                    <a href="{{ route('barang.index') }}" class="btn btn-light">Lihat Barang</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
