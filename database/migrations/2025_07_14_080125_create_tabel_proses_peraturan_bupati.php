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
        Schema::create('proses_peraturan_bupati', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->unsignedBigInteger('regent_regulation_id')->nullable();
            $table->longText('title')->nullable();
            $table->string('opd_id', 150)->nullable();
            $table->string('assistant_id', 10)->nullable();
            $table->date('entry_date')->nullable();
            $table->string('signatures_count', 1000)->nullable();
            $table->date('head_submission_date')->nullable();
            $table->date('assistant_submission_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->mediumText('notes')->nullable();
            $table->string('contact_person_wa', 20)->nullable();
            $table->timestamps();

            $table->foreign('id')->references('process_code')->on('peraturan_bupati')->onDelete('cascade');
            $table->foreign('regent_regulation_id')->references('id')->on('peraturan_bupati')->onDelete('set null');
            $table->foreign('opd_id')->references('id')->on('opd');
            $table->foreign('assistant_id')->references('id')->on('asisten');
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('proses_peraturan_bupati');
    }
};