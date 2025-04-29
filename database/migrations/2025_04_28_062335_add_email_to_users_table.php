<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Cek apakah kolom email sudah ada
        if (!Schema::hasColumn('users', 'email')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('email')->after('username');
            });
        }
        
        // Jika ingin memodifikasi kolom yang sudah ada
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->nullable(false)->change(); // Contoh: ubah menjadi not nullable
        });
    }

    public function down()
    {
        // Opsional: hanya jika ingin rollback
        Schema::table('users', function (Blueprint $table) {
            // Jangan drop column jika kolom diperlukan
            // $table->dropColumn('email');
        });
    }
};