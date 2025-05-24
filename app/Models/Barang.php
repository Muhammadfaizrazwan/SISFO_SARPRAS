<?php

// app/Models/Barang.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barangs';

    protected $fillable = [
        'kategori_barang_id',
        'nama_barang',
        'jumlah',
        'gambar',

    ];

    // Menambahkan kolom virtual ke response JSON
    protected $appends = ['nama_kategori'];

    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori_barang_id');
    }

    // Accessor untuk nama_kategori
    public function getNamaKategoriAttribute()
    {
        return $this->kategori ? $this->kategori->nama_kategori : null;
    }
}

