<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use App\Models\Pengembalian;
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
        $request->validate([
            'jumlah_dikembalikan' => 'required|integer|min:1',
            'kondisi_barang' => 'required|string',
            'catatan' => 'nullable|string'
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now(),
            'jumlah_dikembalikan' => $request->jumlah_dikembalikan,
            'kondisi_barang' => $request->kondisi_barang,
            'catatan' => $request->catatan
        ]);

        $barang = $peminjaman->barang;
        $barang->jumlah += $request->jumlah_dikembalikan;
        $barang->save();

        return redirect()->route('pengembalian.index')->with('success', 'Barang berhasil dikembalikan.');
    }

    // Method API dari Flutter

public function storeApi(Request $request)
{
    $request->validate([
        'id' => 'required|integer|exists:peminjaman,id',
        'kondisi_barang' => 'required|string',
        'catatan' => 'nullable|string',
        'tanggal_pengembalian' => 'required|date'
    ]);

    $peminjaman = Peminjaman::findOrFail($request->id);

    // Tambah ke tabel pengembalian
    Pengembalian::create([
        'peminjaman_id' => $peminjaman->id,
        'tanggal_pengembalian' => $request->tanggal_pengembalian,
        'kondisi_barang' => $request->kondisi_barang,
        'catatan' => $request->catatan
    ]);

    // Update status peminjaman dan stok barang
    $peminjaman->update([
        'status' => 'dikembalikan',
        'tanggal_kembali' => $request->tanggal_pengembalian,
    ]);

    $barang = $peminjaman->barang;
    $barang->jumlah += $peminjaman->jumlah;
    $barang->save();

    return response()->json(['message' => 'Barang berhasil dikembalikan'], 200);
}

    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return view('pengembalian.edit', compact('peminjaman'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'jumlah_dikembalikan' => 'nullable|integer|min:1',
            'kondisi_barang' => 'nullable|string',
            'catatan' => 'nullable|string'
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update([
            'status' => $request->status,
            'jumlah_dikembalikan' => $request->jumlah_dikembalikan ?? $peminjaman->jumlah_dikembalikan,
            'kondisi_barang' => $request->kondisi_barang ?? $peminjaman->kondisi_barang,
            'catatan' => $request->catatan ?? $peminjaman->catatan
        ]);

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian diperbarui.');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $barang = $peminjaman->barang;
        $barang->jumlah -= $peminjaman->jumlah_dikembalikan;
        $barang->save();

        $peminjaman->delete();

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian dihapus.');
    }

    public function setuju($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'selesai';
        $peminjaman->save();

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian disetujui.');
    }

    public function tolak($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'ditolak';

        $barang = $peminjaman->barang;
        $barang->jumlah -= $peminjaman->jumlah_dikembalikan;
        $barang->save();

        $peminjaman->save();

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian ditolak.');
    }
}
