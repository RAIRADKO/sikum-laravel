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
        Schema::create('keputusan', function (Blueprint $table) {
            $table->id();
            $table->string('process_code', 10)->unique()->nullable();
            $table->date('decree_date')->nullable();
            $table->longText('title')->nullable();
            $table->string('opd_id', 150)->nullable();
            $table->date('received_date')->nullable();
            $table->date('taken_date')->nullable();
            $table->longText('taken_by')->nullable();
            $table->longText('borrowed_by')->nullable();
            $table->date('borrowed_date')->nullable();
            $table->longText('borrowing_reason')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            
            $table->foreign('opd_id')->references('id')->on('opd');
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('keputusan');
    }
};