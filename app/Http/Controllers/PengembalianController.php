<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Peminjaman::where('status', 'dikembalikan')->with('barang')->get();
        return view('pengembalian.index', compact('pengembalians'));
    }

    public function create($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return view('pengembalian.create', compact('peminjaman'));
    }

    public function store(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now(),
            'jumlah_dikembalikan' => $request->jumlah_dikembalikan
        ]);

        $barang = $peminjaman->barang;
        $barang->jumlah += $request->jumlah_dikembalikan;
        $barang->save();

        return redirect()->route('pengembalian.index')->with('success', 'Barang berhasil dikembalikan.');
    }

    // Method baru untuk handle API dari Flutter
    public function storeApi(Request $request)
    {
        $peminjaman = Peminjaman::findOrFail($request->id);

        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now(),
            'jumlah_dikembalikan' => $request->jumlah_dikembalikan
        ]);

        $barang = $peminjaman->barang;
        $barang->jumlah += $request->jumlah_dikembalikan;
        $barang->save();

        return response()->json(['message' => 'Barang berhasil dikembalikan'], 200);
    }
}
