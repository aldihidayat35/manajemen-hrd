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
        Schema::create('alternatif_topik', function (Blueprint $table) {
            $table->id();
            $table->string('kode_topik', 20)->unique();
            $table->string('judul_topik', 255);
            $table->text('deskripsi')->nullable();
            $table->string('dosen_pembimbing', 100)->nullable();
            $table->enum('status', ['tersedia', 'diambil', 'selesai'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alternatif_topik');
    }
};
