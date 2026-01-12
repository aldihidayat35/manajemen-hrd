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
        Schema::create('penilaian_topik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alternatif_topik_id')->constrained('alternatif_topik')->onDelete('cascade');
            $table->foreignId('kriteria_id')->constrained('kriteria')->onDelete('cascade');
            $table->decimal('nilai', 8, 2)->comment('Nilai kriteria (skala 1-100)');
            $table->timestamps();

            // Unique constraint: satu alternatif hanya punya satu nilai per kriteria
            $table->unique(['alternatif_topik_id', 'kriteria_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_topik');
    }
};
