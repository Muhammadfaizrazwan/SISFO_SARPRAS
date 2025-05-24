<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangApiController extends Controller
{
    public function index()
    {
        try {
            $barangs = Barang::with('kategori')->get();

            return response()->json([
                'status' => 'success',
                'data' => $barangs
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function show($id)
    {
        $barang = Barang::with('kategori')->find($id);

        if (! $barang) {
            return response()->json([
                'status' => 'error',
                'message' => 'Barang tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $barang
        ]);
    }
}
