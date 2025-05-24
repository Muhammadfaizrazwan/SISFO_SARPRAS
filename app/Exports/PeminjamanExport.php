<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class PeminjamanExport implements FromCollection
{
    protected $peminjamans;

    public function __construct($peminjamans)
    {
        $this->peminjamans = $peminjamans;
    }

    public function collection()
    {
        return $this->peminjamans;
    }
}

