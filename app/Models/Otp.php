<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;

    protected $table = 'otps';
    protected $fillable = ['nomor', 'otp', 'waktu', 'device_token'];
    public $timestamps = false;
}