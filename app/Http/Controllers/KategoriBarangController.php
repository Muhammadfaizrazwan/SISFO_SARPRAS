<?php

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class KategoriBarangController extends Controller
{
    public function index()
    {
        $kategoriBarangs = KategoriBarang::all();
        return view('kategori.index', compact('kategoriBarangs'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
        ]);

        $kategori = KategoriBarang::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');

    }

    public function show($id)
    {
        $kategori = KategoriBarang::findOrFail($id);
        return response()->json($kategori);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
        ]);

        $kategori = KategoriBarang::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui');
       
    }

    public function destroy($id)
    {
        $kategori = KategoriBarang::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');

    }

    public function create()
    {
        return view('kategori.create');
    }

    public function edit($id)
    {
        $kategori = KategoriBarang::findOrFail($id);
        return view('kategori.editkategori', compact('kategori'));
    }
}
