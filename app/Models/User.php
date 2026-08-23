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

    protected static function booted()
    {
        static::deleting(function ($user) {
            if ($user->username === 'admin' || $user->id === 1) {
                // Mencegah penghapusan akun Super Admin utama
                return false;
            }
        });

        static::updating(function ($user) {
            if (($user->getOriginal('username') === 'admin' || $user->getOriginal('id') === 1) && $user->role !== self::ROLE_ADMIN) {
                // Memastikan akun Super Admin utama selalu memiliki role admin (tidak bisa diganggu gugat)
                $user->role = self::ROLE_ADMIN;
            }
        });
    }

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'id_pengguna');
    }

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isUser()
    {
        return $this->role === self::ROLE_USER;
    }

    public function isSuperAdmin()
    {
        return $this->isAdmin() && ($this->username === 'admin' || $this->id === 1);
    }
}