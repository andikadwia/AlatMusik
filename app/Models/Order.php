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
        'tanggal_mulai',
        'tanggal_selesai',
        'status_penyewaan',
        'dibuat_pada',
        'diperbarui_pada'
    ];

    protected $dates = [
        'tanggal_pemesanan',
        'tanggal_mulai',
        'tanggal_selesai',
        'dibuat_pada',
        'diperbarui_pada'
    ];

    protected $casts = [
        'status_penyewaan' => 'string',
        'total_harga' => 'decimal:2'
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
        return $this->hasOne(pengembalian::class, 'id_pemesanan');
    }

    public function verifikasiPembayaran()
    {
        return $this->hasOne(VerifikasiPembayaran::class, 'id_pemesanan');
    }

    public function pelanggan()
    {
        return $this->hasOne(Pelanggan::class, 'id_pengguna');
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'id_pemesanan');
    }
}