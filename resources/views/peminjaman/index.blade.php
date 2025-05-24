@extends('layouts.app')

@section('title', 'Daftar Peminjaman Barang')

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
                <th>Jumlah</th>
                <th>Tanggal Pinjam</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjamans as $peminjaman)
                <tr>
                    <td>{{ $peminjamans->firstItem() + $loop->index }}</td>
                    <td>{{ $peminjaman->barang->nama_barang }}</td>
                    <td>{{ $peminjaman->nama_peminjam }}</td>
                    <td>{{ $peminjaman->jumlah }}</td>
                    <td>{{ $peminjaman->tanggal_pinjam }}</td>
                    <td>{{ $peminjaman->keterangan }}</td>
                    <td>
                        @if ($peminjaman->status === 'dipinjam')
                            <span class="badge bg-success">Dipinjam</span>
                        @elseif ($peminjaman->status === 'tidak dipinjam')
                            <span class="badge bg-danger">Tidak Dipinjam</span>
                        @else
                            <span class="badge bg-secondary">{{ $peminjaman->status }}</span>
                        @endif
                    </td>
                    <td>
                        @if ($peminjaman->status === 'none')
                            <form action="{{ route('peminjaman.setuju', $peminjaman->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">Setuju</button>
                            </form>

                            <form action="{{ route('peminjaman.tolak', $peminjaman->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                            </form>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

  <div class="d-flex justify-content-center mt-4">
    {{ $peminjamans->links('pagination::bootstrap-5') }}
</div>

@endsection
