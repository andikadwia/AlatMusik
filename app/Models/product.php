<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'deskripsi',
        'stok',
        'harga',
        'kategori',
        'path_gambar',
    ];

        // Mengambil array path gambar
    public function getImagesAttribute()
    {
        return $this->path_gambar ? explode('|', $this->path_gambar) : [];
    }

    // Menyimpan array path gambar
    public function setImagesAttribute($images)
    {
        $this->attributes['path_gambar'] = implode('|', $images);
    }
}

