<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
   public function index()
{
    $peminjamans = Peminjaman::with('barang')
        ->whereIn('status', ['none', 'dipinjam'])
         ->paginate(5);


    return view('peminjaman.index', compact('peminjamans'));
}


    public function create()
    {
        $barangs = Barang::all();
        return view('peminjaman.create', compact('barangs'));
    }

    // Method untuk web request
    public function storeWeb(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'nama_peminjam' => 'required|string|max:150',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $barang = Barang::find($request->barang_id);

        // Cek stok barang
        if ($request->jumlah > $barang->jumlah) {
            return redirect()->back()->with('error', 'Jumlah barang yang dipinjam melebihi stok yang tersedia.');
        }

        // Kurangi stok barang
        $barang->jumlah -= $request->jumlah;
        $barang->save();

        $peminjaman = Peminjaman::create([
            'barang_id' => $request->barang_id,
            'nama_peminjam' => $request->nama_peminjam,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'keterangan' => $request->keterangan,
            'status' => 'pending' // Status default
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    // Method untuk API request
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'nama_peminjam' => 'required|string',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'keterangan' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $barang = Barang::find($request->barang_id);

        // Cek stok barang untuk API
        if ($request->jumlah > $barang->jumlah) {
            return response()->json([
                'message' => 'Jumlah barang yang dipinjam melebihi stok yang tersedia.'
            ], 400);
        }

        // Kurangi stok barang
        $barang->jumlah -= $request->jumlah;
        $barang->save();

        $peminjaman = Peminjaman::create($request->all());

        return response()->json($peminjaman, 201);
    }

    public function edit(Peminjaman $peminjaman)
    {
        $barangs = Barang::all();
        return view('peminjaman.edit', compact('peminjaman', 'barangs'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'nama_peminjam' => 'required|string|max:150',
            'tanggal_kembali' => 'nullable|date',
            'status' => 'required|string|max:50',
        ]);

        $peminjaman->update($request->all());
        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diperbarui.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        // Kembalikan stok barang saat penghapusan peminjaman
        $barang = $peminjaman->barang;
        $barang->jumlah += $peminjaman->jumlah;
        $barang->save();

        $peminjaman->delete();
        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dihapus.');
    }

    public function setuju($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'dipinjam';
        $peminjaman->save();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman disetujui.');
    }

    public function tolak($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'ditolak';

        // Kembalikan stok jika ditolak
        $barang = $peminjaman->barang;
        $barang->jumlah += $peminjaman->jumlah;
        $barang->save();

        $peminjaman->save();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman ditolak.');
    }
}
