<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPemesanan extends Model
{
    protected $table = 'item_pemesanan';

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }

    public function produk()
    {
        return $this->belongsTo(Product::class, 'id_produk');
    }
}