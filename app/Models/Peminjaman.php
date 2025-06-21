<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $fillable = [
        'barang_id',
        'nama_peminjam',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'keterangan',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
public function pengguna()
{
    return $this->belongsTo(Pengguna::class, 'user_id');
}

public function pengembalian()
{
    return $this->hasOne(Pengembalian::class);
    return $this->hasOne(Pengembalian::class, 'peminjaman_id');
}




}

