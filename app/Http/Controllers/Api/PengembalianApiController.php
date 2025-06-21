<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Barang;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PengembalianAPIController extends Controller
{
    // Ambil semua data pengembalian yang sedang berjalan
    public function index()
    {
        $pengembalians = Peminjaman::whereIn('status', ['dipinjam', 'dikembalikan', 'ditolak'])
            ->with('barang')
            ->get();

        return response()->json($pengembalians);
    }

    // Proses pengembalian barang via API
   public function store(Request $request, $id)
{
    $request->validate([
        'kondisi_barang' => 'nullable|string|max:255',
        'catatan' => 'nullable|string',
    ]);

    $peminjaman = Peminjaman::findOrFail($id);

    if ($peminjaman->status !== 'dipinjam') {
        return response()->json(['message' => 'Barang sudah dikembalikan atau belum disetujui.'], 400);
    }

    // Simpan ke tabel pengembalian
    Pengembalian::create([
        'peminjaman_id' => $peminjaman->id,
        'tanggal_pengembalian' => now(),
        'kondisi_barang' => $request->kondisi_barang,
        'catatan' => $request->catatan
    ]);

    // Update status dan stok
    $peminjaman->update([
        'status' => 'dikembalikan',
        'tanggal_kembali' => now(),
    ]);

    $barang = $peminjaman->barang;
    $barang->jumlah += $peminjaman->jumlah;
    $barang->save();

    return response()->json([
        'message' => 'Barang berhasil dikembalikan.',
        'data' => $peminjaman
    ], 200);
}

    // Menolak pengembalian barang via API
    public function tolak(Request $request)
    {
        $peminjaman = Peminjaman::findOrFail($request->id);

        if ($peminjaman->status !== 'dikembalikan') {
            return response()->json(['message' => 'Pengembalian belum diajukan.'], 400);
        }

        $peminjaman->status = 'ditolak';

        // Kurangi stok karena pengembalian fisik ditolak
        $barang = $peminjaman->barang;
        $barang->jumlah -= $peminjaman->jumlah;
        $barang->save();

        $peminjaman->save();

        return response()->json([
            'message' => 'Pengembalian ditolak.',
            'data' => $peminjaman
        ], 200);
    }
}
