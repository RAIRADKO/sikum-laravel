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
        Schema::create('peraturan_bupati', function (Blueprint $table) {
            $table->id();
            $table->string('process_code', 10)->unique()->nullable();
            $table->date('regulation_date')->nullable();
            $table->longText('title')->nullable();
            $table->string('opd_id', 150)->nullable();
            $table->string('series_id', 5)->nullable();
            $table->integer('series_number')->nullable();
            $table->date('enactment_date')->nullable();
            $table->date('received_date')->nullable();
            $table->date('taken_date')->nullable();
            $table->longText('taken_by')->nullable();
            $table->longText('borrowed_by')->nullable();
            $table->date('borrowed_date')->nullable();
            $table->longText('borrowing_reason')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('opd_id')->references('id')->on('opd');
            $table->foreign('series_id')->references('id')->on('seri');
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('peraturan_bupati');
    }
};