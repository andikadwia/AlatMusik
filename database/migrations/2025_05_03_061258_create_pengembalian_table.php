<?php

// database/migrations/[timestamp]_create_pengembalian_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('id_pemesanan');
            $table->dateTime('tanggal_pengembalian');
            $table->enum('kondisi', [
                'sangat_baik',
                'baik',
                'rusak',
                'hilang'
            ]);
            $table->text('catatan')->nullable();
            $table->integer('denda');
            $table->timestamp('dibuat_pada')->useCurrent();
        });

        // Tambahkan foreign key constraint
        Schema::table('pengembalian', function (Blueprint $table) {
            $table->foreign('id_pemesanan')
                  ->references('id')
                  ->on('pemesanan');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengembalian');
    }
};