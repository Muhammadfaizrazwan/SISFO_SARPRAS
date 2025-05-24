<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;

class PengembalianAPIController extends Controller
{
    public function index()
    {
        $pengembalians = Peminjaman::where('status', 'dipinjam')->with('barang')->get();
        return response()->json($pengembalians);
    }

    public function store(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'dipinjam') {
            return response()->json(['message' => 'Barang sudah dikembalikan atau belum disetujui.'], 400);
        }

        // Update status dan tanggal kembali
        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now()
        ]);

        // Tambahkan stok barang
        $barang = $peminjaman->barang;
        $barang->jumlah += $peminjaman->jumlah;
        $barang->save();

        return response()->json([
            'message' => 'Barang berhasil dikembalikan.',
            'data' => $peminjaman
        ], 200);
    }
}
