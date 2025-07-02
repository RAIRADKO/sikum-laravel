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
        Schema::create('sks', function (Blueprint $table) {
            $table->id();
            $table->integer('no_urut');
            $table->string('kode_sk')->unique();
            $table->foreignId('id_opd')->constrained('opds', 'id_opd')->onDelete('cascade');
            $table->date('tgl_pengajuan');
            $table->text('perihal');
            $table->string('pemohon');
            $table->date('tgl_terima')->nullable();

            // Tracking Proses
            $table->timestamp('tahap1')->nullable()->comment('Pengajuan dari OPD');
            $table->text('ket1')->nullable();
            $table->timestamp('tahap2')->nullable()->comment('Verifikasi Staff');
            $table->text('ket2')->nullable();
            $table->timestamp('tahap3')->nullable()->comment('Verifikasi Kasubag');
            $table->text('ket3')->nullable();
            $table->timestamp('tahap4')->nullable()->comment('Verifikasi Kabag');
            $table->text('ket4')->nullable();
            $table->timestamp('tahap5')->nullable()->comment('Paraf Asisten');
            $table->text('ket5')->nullable();
            $table->timestamp('tahap6')->nullable()->comment('TTE Sekda');
            $table->text('ket6')->nullable();

            $table->text('catatan')->nullable();
            $table->enum('status', ['Proses', 'Selesai', 'Ditolak', 'Dibatalkan'])->default('Proses');
            $table->year('tahun');
            $table->string('no_sk')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sks');
    }
};