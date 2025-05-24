<?php

namespace App\Http\Controllers;


use App\Exports\PeminjamanExport;
use App\Models\Barang;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use App\Exports\BarangExport;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{

    public function index(Request $request)
    {
        $query = Barang::with('kategori');

        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        $barangs = $query->get();

        return view('barang.index', compact('barangs'));
    }

    public function total()
    {
        $totalBarang = Barang::sum('jumlah');

        return view('dashboard', compact('totalBarang'));
    }


    public function create()
    {
        $kategoriBarangs = KategoriBarang::all();
        return view('barang.create', compact('kategoriBarangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_barang_id' => 'required|exists:kategori_barangs,id',
            'nama_barang' => 'required|string|max:150',
            'jumlah' => 'required|integer|min:1',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('gambar-barang', 'public');
        }

        Barang::create($data);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }


    public function edit(Barang $barang)
    {
        $kategoriBarangs = KategoriBarang::all();
        return view('barang.edit', compact('barang', 'kategoriBarangs'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'kategori_barang_id' => 'required|exists:kategori_barangs,id',
            'nama_barang' => 'required|string|max:150',
            'jumlah' => 'required|integer|min:1',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($barang->gambar && Storage::disk('public')->exists($barang->gambar)) {
                Storage::disk('public')->delete($barang->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('gambar-barang', 'public');
        }

        $barang->update($data);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }


    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }

   public function exportPDF(Request $request)
{
    $barangs = Barang::with('kategori')
    ->when($request->filled('kategori_barang_id'), function ($query) use ($request) {
        $query->where('kategori_barang_id', $request->kategori_barang_id);
    })
    ->when($request->filled('nama_barang'), function ($query) use ($request) {
        $query->where('nama_barang', 'like', '%'.$request->nama_barang.'%');
    })
    ->get();

$pdf = FacadePdf::loadView('laporan.pdf', compact('barangs'))->setPaper('a4', 'landscape');
return $pdf->download('laporan-barang.pdf');

}

public function exportExcel(Request $request)
{
    $barangs = Barang::with('kategori')
        ->when($request->filled('kategori_barang_id'), function ($query) use ($request) {
            $query->where('kategori_barang_id', $request->kategori_barang_id);
        })
        ->when($request->filled('nama_barang'), function ($query) use ($request) {
            $query->where('nama_barang', 'like', '%'.$request->nama_barang.'%');
        })
        ->get();

    return Excel::download(new BarangExport($barangs), 'laporan-barang.xlsx');
}

}
