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
        Schema::create('was', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_opd')->constrained('opds', 'id_opd')->onDelete('cascade');
            $table->string('no_wa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('was');
    }
};