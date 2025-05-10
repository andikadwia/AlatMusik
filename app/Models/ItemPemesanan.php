<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPemesanan extends Model
{
    protected $table = 'item_pemesanan';
    protected $primaryKey = 'id_item';

    public function produk()
    {
        return $this->belongsTo(Product::class, 'id_produk');
    }
}
