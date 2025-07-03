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
        Schema::create('seris', function (Blueprint $table) {
            // Berdasarkan struktur tabel 'seri' di DB lama,
            // 'kodeseri' adalah primary key dan bukan auto-increment.
            $table->string('kodeseri', 50)->primary();
            $table->text('keterangan');
            // Tidak perlu timestamps jika ingin sama persis dengan DB lama
            // $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seris');
    }
};