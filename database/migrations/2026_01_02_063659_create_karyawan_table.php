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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('nikKry', 50);
            $table->string('namaKaryawan', 255);
            $table->string('nikKtp', 20);
            $table->string('unit', 100);
            $table->string('gol', 50)->nullable();
            $table->string('profesi', 100);
            $table->string('statusPegawai', 50);
            $table->string('tempatLahir', 100);
            $table->date('tglLahir');
            $table->date('tglMulaiKerja');
            $table->string('jenisKelamin', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
