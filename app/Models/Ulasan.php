<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasan';

    protected $fillable = [
        'id_pemesanan',
        'id_pengguna',
        'id_produk',
        'rating',
        'komentar',
        'bisa_edit',
    ];

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diedit_pada';

    public function user() {
        return $this->belongsTo(User::class, 'id_pengguna');
    }

    public function produk() {
        return $this->belongsTo(Product::class, 'id_produk');
    }

    public function pemesanan() {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }
}
