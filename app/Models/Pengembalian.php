<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalian';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_pemesanan',
        'tanggal_pengembalian',
        'kondisi',
        'catatan',
        'denda',
        'dibuat_pada' 
    ];

    protected $casts = [
        'tanggal_pengembalian' => 'datetime',
        'denda' => 'decimal:2',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Order::class, 'id_pemesanan');
    }
}