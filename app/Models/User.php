<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Tambahkan konstanta role
    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';

    protected $table = 'pengguna';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'username',
        'telepon',
        'alamat',
        'email',
        'password',
        'role',
        'foto_profil',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => 'string',
    ];

    // Relasi dengan pemesanan
    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'id_pengguna');
    }

    // Method untuk mengecek role admin
    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    // Method untuk mengecek role user biasa
    public function isUser()
    {
        return $this->role === self::ROLE_USER;
    }
}