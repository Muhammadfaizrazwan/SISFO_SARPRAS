<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangExport implements FromCollection, WithHeadings
{
    protected $barangs;

    public function __construct($barangs)
    {
        $this->barangs = $barangs;
    }

    public function collection()
    {
        return $this->barangs->map(function ($barang) {
            return [
                'Kategori' => $barang->kategori->nama_kategori ?? '-',
                'Nama Barang' => $barang->nama_barang,
                'Jumlah' => $barang->jumlah,
            ];
        });
    }

    public function headings(): array
    {
        return ['Kategori', 'Nama Barang', 'Jumlah'];
    }

    
}

