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
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom telepon dengan NOT NULL
            if (!Schema::hasColumn('users', 'telepon')) {
                $table->string('telepon', 15) // Maksimal 15 karakter
                      ->after('email') // Letakkan setelah kolom email
                      ->nullable(false); // NOT NULL
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('telepon');
        });
    }
};