<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengguna = Peminjaman::distinct('nama_peminjam')->count('nama_peminjam'); // total unik peminjam
        $totalBarang = Barang::count();
        $totalPeminjaman = Peminjaman::count();

        $peminjamanTerbaru = Peminjaman::with('barang')->latest()->take(5)->get();
        $barangTerbaru = Barang::latest()->take(3)->get();

        // Untuk Chart
        $labels = [];
        $data = [];

        $peminjamanData = Peminjaman::selectRaw('DATE(tanggal_pinjam) as tanggal, COUNT(*) as jumlah')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        foreach ($peminjamanData as $item) {
            $labels[] = \Carbon\Carbon::parse($item->tanggal)->format('d M');
            $data[] = $item->jumlah;
        }

        return view('dashboard', compact(
            'totalPengguna',
            'totalBarang',
            'totalPeminjaman',
            'peminjamanTerbaru',
            'barangTerbaru',
            'labels',
            'data'
        ));
    }
}

