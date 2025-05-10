<?php

// database/migrations/[timestamp]_create_pemesanan_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('id_pengguna')->nullable();
            $table->dateTime('tanggal_pemesanan');
            $table->decimal('total_harga', 10, 2);
            $table->enum('status', ['menunggu', 'disetujui'])->default('menunggu');
            $table->text('catatan')->nullable();
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrent()->useCurrentOnUpdate();
            $table->enum('status_peminjaman', [
                'belum_dipinjam',
                'sedang_dipinjam',
                'sudah_dikembalikan'
            ])->default('belum_dipinjam');
        });

        // Tambahkan foreign key constraint
        Schema::table('pemesanan', function (Blueprint $table) {
            $table->foreign('id_pengguna')
                  ->references('id')
                  ->on('pengguna');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pemesanan');
    }
};