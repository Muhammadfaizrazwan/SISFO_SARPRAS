<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalians';

    protected $fillable = [
       'peminjaman_id',
        'tanggal_pengembalian',
        'kondisi_barang',
        'catatan', // tambahkan ini
        // 'foto',
    ];
public function peminjaman()
{
    return $this->belongsTo(Peminjaman::class);
    return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
}
public function barang()
{
    return $this->belongsTo(Barang::class, 'barang_id');
}
}
