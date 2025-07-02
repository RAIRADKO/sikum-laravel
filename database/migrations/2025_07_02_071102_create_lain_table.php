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
        Schema::create('lains', function (Blueprint $table) {
            $table->id();
            $table->integer('no_urut');
            $table->string('kode_lain')->unique();
            $table->foreignId('id_opd')->constrained('opds', 'id_opd')->onDelete('cascade');
            $table->date('tgl_pengajuan');
            $table->text('perihal');
            $table->string('pemohon');
            $table->date('tgl_terima')->nullable();

            // Tracking Proses (bisa disesuaikan)
            $table->timestamp('tahap1')->nullable()->comment('Pengajuan dari OPD');
            $table->text('ket1')->nullable();

            $table->text('catatan')->nullable();
            $table->enum('status', ['Proses', 'Selesai', 'Ditolak', 'Dibatalkan'])->default('Proses');
            $table->year('tahun');
            $table->string('no_lain')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lains');
    }
};