<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PeminjamanExport;
use App\Exports\PengembalianExport;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class LaporanController extends Controller
{
    // 🔷 Laporan Peminjaman
    public function index(Request $request)
    {
        $peminjamans = Peminjaman::with('barang')
            ->where('status', 'Dipinjam',)
            ->when($request->filled('tanggal_mulai'), fn($q) => $q->where('tanggal_pinjam', '>=', $request->tanggal_mulai))
            ->when($request->filled('tanggal_akhir'), fn($q) => $q->where('tanggal_pinjam', '<=', $request->tanggal_akhir))
            ->get();

        return view('laporan.index', compact('peminjamans'));
    }

    public function exportPeminjamanPDF(Request $request)
    {
        $peminjamans = Peminjaman::with('barang')
            ->where('status', 'Dipinjam')
            ->when($request->filled('tanggal_mulai'), fn($q) => $q->where('tanggal_pinjam', '>=', $request->tanggal_mulai))
            ->when($request->filled('tanggal_akhir'), fn($q) => $q->where('tanggal_pinjam', '<=', $request->tanggal_akhir))
            ->get();

        $pdf = FacadePdf::loadView('laporan.pdf', compact('peminjamans'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-peminjaman.pdf');
    }

    public function exportPeminjamanExcel(Request $request)
    {
        $peminjamans = Peminjaman::with('barang')
            ->where('status', 'Dipinjam')
            ->when($request->filled('tanggal_mulai'), fn($q) => $q->where('tanggal_pinjam', '>=', $request->tanggal_mulai))
            ->when($request->filled('tanggal_akhir'), fn($q) => $q->where('tanggal_pinjam', '<=', $request->tanggal_akhir))
            ->get();

        return Excel::download(new PeminjamanExport($peminjamans), 'laporan-peminjaman.xlsx');
    }

    // 🔷 Laporan Pengembalian
    public function pengembalian(Request $request)
    {
        $pengembalians = Peminjaman::with('barang')
            ->where('status', 'Dikembalikan')
            ->when($request->filled('tanggal_mulai'), fn($q) => $q->where('tanggal_kembali', '>=', $request->tanggal_mulai))
            ->when($request->filled('tanggal_akhir'), fn($q) => $q->where('tanggal_kembali', '<=', $request->tanggal_akhir))
            ->get();

        return view('laporan.pengembalian', compact('pengembalians'));
    }

    public function exportPengembalianPDF(Request $request)
    {
        $pengembalians = Peminjaman::with('barang')
            ->where('status', 'Dikembalikan')
            ->when($request->filled('tanggal_mulai'), fn($q) => $q->where('tanggal_kembali', '>=', $request->tanggal_mulai))
            ->when($request->filled('tanggal_akhir'), fn($q) => $q->where('tanggal_kembali', '<=', $request->tanggal_akhir))
            ->get();

        $pdf = FacadePdf::loadView('laporan.pdf', compact('pengembalians'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-pengembalian.pdf');
    }

    public function exportPengembalianExcel(Request $request)
    {
        $pengembalians = Peminjaman::with('barang')
            ->where('status', 'Dikembalikan')
            ->when($request->filled('tanggal_mulai'), fn($q) => $q->where('tanggal_kembali', '>=', $request->tanggal_mulai))
            ->when($request->filled('tanggal_akhir'), fn($q) => $q->where('tanggal_kembali', '<=', $request->tanggal_akhir))
            ->get();

        return Excel::download(new PengembalianExport($pengembalians), 'laporan.pengembalian.xlsx');
    }

    // 🔷 Laporan Barang
    public function laporanBarang(Request $request)
    {
        $barangs = Barang::with('kategori')
            ->when($request->filled('tanggal_mulai') && $request->filled('tanggal_akhir'), function ($q) use ($request) {
                $q->whereBetween('created_at', [$request->tanggal_mulai, $request->tanggal_akhir]);
            })
            ->get();

        return view('laporan.barang', compact('barangs'));
    }

    public function exportBarangPDF(Request $request)
    {
        $barangs = Barang::with('kategori')
            ->when($request->filled('tanggal_mulai') && $request->filled('tanggal_akhir'), function ($q) use ($request) {
                $q->whereBetween('created_at', [$request->tanggal_mulai, $request->tanggal_akhir]);
            })
            ->get();

        $pdf = FacadePdf::loadView('laporan.pdf', compact('barangs'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-barang.pdf');
    }


public function exportBarangExcel(Request $request)
{
    $barangs = Barang::with('kategori')
        ->when($request->filled('tanggal_mulai') && $request->filled('tanggal_akhir'), function ($q) use ($request) {
            $q->whereBetween('created_at', [$request->tanggal_mulai, $request->tanggal_akhir]);
        })
        ->get();

    return Excel::download(new BarangExport($barangs), 'laporan-barang.xlsx');
}
}


