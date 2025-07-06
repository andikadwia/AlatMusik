<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';
    public $timestamps = true;
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'id_pengguna',
        'tanggal_pemesanan',
        'total_harga',
        'status',
        'tanggal_mulai',
        'tanggal_selesai',
        'nama_pemesan',
        'telepon_pemesan',
        'catatan_verifikasi',
        'dibuat_pada',
        'diperbarui_pada'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'id_pemesanan');
    }
    
    public function itemPemesanan()
    {
        return $this->hasMany(ItemPemesanan::class, 'id_pemesanan');
    }
    
    public function items()
    {
        return $this->hasMany(ItemPemesanan::class, 'id_pemesanan');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'id_pemesanan');
    }

    // Helper method to check if order is pending
    public function isPending()
    {
        return $this->status === 'menunggu';
    }

    // Helper method to check if order is approved
    public function isApproved()
    {
        return $this->status === 'disetujui';
    }

    // Helper method to check if order is rejected
    public function isRejected()
    {
        return $this->status === 'ditolak';
    }
public function verifikasiPembayaran()
{
    return $this->hasOne(VerifikasiPembayaran::class, 'id_pemesanan');
}
}