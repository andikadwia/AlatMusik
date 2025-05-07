<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResetFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('telepon')->unique()->nullable();
            $table->string('reset_password_otp')->nullable();
            $table->timestamp('reset_password_otp_expires_at')->nullable();
            $table->string('reset_password_token', 100)->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('reset_password_otp');
            $table->dropColumn('reset_password_otp_expires_at');
            $table->dropColumn('reset_password_token');
        });
    }
}
