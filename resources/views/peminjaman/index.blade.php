@extends('layouts.app')

@push('styles')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endpush

@section('title', 'Daftar Peminjaman Barang')

@section('content')
    <div class="container animate__animated animate__fadeIn">
        <h2 class="mb-4"><i class="fas fa-handshake me-2"></i>Daftar Peminjaman Barang</h2>

        @if (session('success'))
            <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Barang</th>
                        <th>Nama Peminjam</th>
                        <th>Jumlah</th>
                        <th>Tanggal Pinjam</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjamans as $peminjaman)
                        <tr>
                            <td>{{ $peminjamans->firstItem() + $loop->index }}</td>
                            <td>{{ optional($peminjaman->barang)->nama_barang ?? 'Barang tidak ditemukan' }}</td>
                            <td>{{ $peminjaman->nama_peminjam }}</td>
                            <td>{{ $peminjaman->jumlah }}</td>
                            <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}</td>
                            <td>{{ $peminjaman->keterangan }}</td>
                            <td>
                                @if ($peminjaman->status === 'dipinjam')
                                    <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Dipinjam</span>
                                @elseif ($peminjaman->status === 'tidak dipinjam')
                                    <span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i>Tidak Dipinjam</span>
                                @else
                                    <span class="badge bg-secondary">{{ $peminjaman->status }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($peminjaman->status === 'pending')
                                    <form action="{{ route('peminjaman.setuju', $peminjaman->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-outline-success btn-sm me-1">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('peminjaman.tolak', $peminjaman->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $peminjamans->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
