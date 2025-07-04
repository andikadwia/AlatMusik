<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPemesanan extends Model
{
    protected $table = 'item_pemesanan';

    public $timestamps = false;

protected $fillable = [
    'id_pemesanan',
    'id_produk',
    'jumlah',
    'hari_sewa',
    'harga_per_hari',
    'path_gambar'
];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }

    public function produk()
    {
        return $this->belongsTo(Product::class, 'id_produk');
    }
}
