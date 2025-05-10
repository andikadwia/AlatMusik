<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_pengguna',
        'tanggal_pemesanan',
        'total_harga',
        'status',
        'catatan',
        'status_peminjaman'
    ];

    protected $casts = [
        'tanggal_pemesanan' => 'datetime',
        'total_harga' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pengguna');
    }

    public function items()
    {
        return $this->hasMany(ItemPemesanan::class, 'id_pemesanan');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'id_pemesanan');
    }
}