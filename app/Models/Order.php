<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'pemesanan';
    protected $primaryKey = 'id';
    public $timestamps = false; // Since you have custom timestamp columns

    protected $fillable = [
        'id_pengguna',
        'tanggal_pemesanan',
        'total_harga',
        'status',
        'catatan',
        'status_peminjaman'
    ];

    protected $dates = [
        'tanggal_pemesanan',
        'dibuat_pada',
        'diperbarui_pada'
    ];

    protected $casts = [
        'status' => 'string',
        'status_peminjaman' => 'string'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }

    public function items()
    {
        return $this->hasMany(ItemPemesanan::class, 'id_pemesanan');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'id_pemesanan');
    }

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }

    public function pelanggan()
    {
        return $this->hasOne(Pelanggan::class, 'id_pengguna');
    }

    public function pemesanan()
    {
        return $this->belongsTo(Order::class, 'id_pemesanan');
    }
}