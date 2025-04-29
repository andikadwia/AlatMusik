<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambahkan pengecekan jika tabel belum ada
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('username')->unique();
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->string('alamat');
                $table->string('Telepon');
                $table->rememberToken();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        // Perbaiki untuk menghapus tabel users
        Schema::dropIfExists('users');
    }
};