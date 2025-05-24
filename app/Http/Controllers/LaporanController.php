<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PeminjamanExport;
use App\Models\Barang;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Filter berdasarkan tanggal dan status
        $peminjamans = Peminjaman::with('barang')
            ->when($request->filled('tanggal_mulai'), function ($query) use ($request) {
                $query->where('tanggal_pinjam', '>=', $request->tanggal_mulai);
            })
            ->when($request->filled('tanggal_akhir'), function ($query) use ($request) {
                $query->where('tanggal_pinjam', '<=', $request->tanggal_akhir);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->get();

        return view('laporan.index', compact('peminjamans'));
    }

    public function exportPDF(Request $request)
    {
        $peminjamans = Peminjaman::with('barang')
            ->when($request->filled('tanggal_mulai'), function ($query) use ($request) {
                $query->where('tanggal_pinjam', '>=', $request->tanggal_mulai);
            })
            ->when($request->filled('tanggal_akhir'), function ($query) use ($request) {
                $query->where('tanggal_pinjam', '<=', $request->tanggal_akhir);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->get();

        $barangs = Barang::with('kategori')->get(); // ⬅️ Tambahkan ini

        $pdf = FacadePdf::loadView('laporan.pdf', compact('peminjamans', 'barangs'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-peminjaman-dan-barang.pdf');
    }


    public function exportExcel(Request $request)
    {
        $peminjamans = Peminjaman::with('barang')
            ->when($request->filled('tanggal_mulai'), function ($query) use ($request) {
                $query->where('tanggal_pinjam', '>=', $request->tanggal_mulai);
            })
            ->when($request->filled('tanggal_akhir'), function ($query) use ($request) {
                $query->where('tanggal_pinjam', '<=', $request->tanggal_akhir);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->get();

        return Excel::download(new PeminjamanExport($peminjamans), 'laporan-peminjaman.xlsx');
    }

    public function laporanBarang(Request $request)
    {
        $query = Barang::with('kategori');

        // Filter jika ingin pakai tanggal (optional, berdasarkan created_at misalnya)
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('created_at', [$request->tanggal_mulai, $request->tanggal_akhir]);
        }

        $barangs = $query->get();

        return view('laporan.barang', compact('barangs'));
    }
}
