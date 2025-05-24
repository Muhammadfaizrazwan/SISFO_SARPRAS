<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Barang;

class PeminjamanApiController extends Controller
{
    public function index()
    {
        $data = Peminjaman::with('barang')->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'barang_id' => 'required|exists:barangs,id',
                'nama_peminjam' => 'required|string|max:150',
                'jumlah' => 'required|integer|min:1',
                'tanggal_pinjam' => 'required|date',
                'keterangan' => 'nullable|string|max:255',
            ]);

            $barang = Barang::find($validated['barang_id']);

            if ($validated['jumlah'] > $barang->jumlah) {
                return response()->json(['error' => 'Stok tidak cukup'], 400);
            }

            // Set status awal
            $validated['status'] = 'none';

            $barang->jumlah -= $validated['jumlah'];
            $barang->save();

            $peminjaman = Peminjaman::create($validated);
            return response()->json($peminjaman, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function show($id)
    {
        $peminjaman = Peminjaman::with('barang')->find($id);
        if (!$peminjaman) return response()->json(['error' => 'Not found'], 404);
        return response()->json($peminjaman);
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::find($id);
        if (!$peminjaman) return response()->json(['error' => 'Not found'], 404);

        $validated = $request->validate([
            'nama_peminjam' => 'required|string|max:150',
            'tanggal_kembali' => 'nullable|date',
            'status' => 'required|string|max:50',

        ]);

        $peminjaman->update($validated);
        return response()->json($peminjaman);
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::find($id);
        if (!$peminjaman) return response()->json(['error' => 'Not found'], 404);

        $barang = $peminjaman->barang;
        $barang->jumlah += $peminjaman->jumlah_dipinjam;
        $barang->save();

        $peminjaman->delete();
        return response()->json(['message' => 'Deleted']);
    }

    public function setuju($id)
{
    $peminjaman = Peminjaman::find($id);
    if (!$peminjaman) return response()->json(['error' => 'Not found'], 404);

    $peminjaman->status = 'dipinjam';
    $peminjaman->save();

    return response()->json(['message' => 'Disetujui', 'data' => $peminjaman]);
}

public function tolak($id)
{
    $peminjaman = Peminjaman::find($id);
    if (!$peminjaman) return response()->json(['error' => 'Not found'], 404);

    $peminjaman->status = 'tidak dipinjam';
    $peminjaman->save();

    return response()->json(['message' => 'Ditolak', 'data' => $peminjaman]);
}

}
