<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifikasiPembayaran extends Model
{
    protected $table = 'verifikasi_pembayaran';
    
    protected $fillable = [
        'id_pemesanan',
        'bukti_pembayaran',
        'bukti_jaminan',
        'status_verifikasi',
        'tanggal_pembayaran'
    ];
    public $timestamps = false;


    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }
}