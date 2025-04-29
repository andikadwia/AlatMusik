<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tambahkan ini
            $table->string('username')->unique(); // Kolom yang ingin ditambahkan
            $table->string('email')->unique();Schema::create('logs', function (Blueprint $table) {
    $table->id();
    $table->string('log_name');
    $table->text('description');
    $table->timestamps();
});
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
