<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';
    
    protected $fillable = [
        'id_pengguna',
        'tanggal_pemesanan',
        'total_harga',
        'bukti_pembayaran',
        'foto_jaminan',
        'jenis_jaminan',
        'status',
        'tanggal_pembayaran',
        'tanggal_mulai',
        'tanggal_selesai',
        'catatan',
        'catatan_verifikasi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
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
}