<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('otps', function (Blueprint $table) {
            $table->id();
            $table->string('nomor', 15);
            $table->string('otp', 6);
            $table->integer('waktu');
            $table->string('device_token')->nullable();
            $table->timestamps();
            
            $table->index('nomor');
        });
    }

    public function down()
    {
        Schema::dropIfExists('otps');
    }
};