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
        Schema::create('opd', function (Blueprint $table) {
            $table->string('id', 150)->primary();
            $table->longText('name');
            $table->string('assistant_id', 10);
            $table->timestamps();

            $table->foreign('assistant_id')->references('id')->on('asisten');
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('opd');
    }
};