<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username', 20)->unique();
            $table->string('opd_id', 150);
            $table->string('whatsapp_number', 20);
            $table->string('password');
            $table->string('level');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('opd_id')->references('id')->on('opd');
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};