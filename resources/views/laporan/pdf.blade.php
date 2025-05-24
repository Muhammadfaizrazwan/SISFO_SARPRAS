<!DOCTYPE html>
<html>
<head>
    <title>Laporan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>

    @isset($peminjamans)
    <h2>Laporan Peminjaman Barang</h2>
    <table>
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
    @endisset


    @isset($barangs)
    <h2>Laporan Data Barang</h2>
    <table>
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
                            <img src="{{ public_path('storage/' . $barang->gambar) }}" width="60">
                        @else
                            Tidak ada
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endisset

</body>
</html>
