<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class PengembalianExport implements FromCollection
{
    protected $pengembalians;

    public function __construct($pengembalians)
    {
        $this->pengembalians = $pengembalians;
    }

    public function collection()
    {
        return $this->pengembalians;
    }
}

