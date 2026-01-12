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
        Schema::create('data_apps', function (Blueprint $table) {
            $table->id();
            $table->string('nama_app', 100)->default('SIM RS');
            $table->string('nama_instansi', 200)->nullable();
            $table->string('logo')->nullable()->comment('Path to logo image');
            $table->string('favicon')->nullable()->comment('Path to favicon');
            $table->text('copyright_text')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_telp', 20)->nullable();
            $table->timestamps();
        });

        // Insert default data (single row logic)
        DB::table('data_apps')->insert([
            'nama_app' => 'SIM RS',
            'nama_instansi' => 'Rumah Sakit Umum',
            'logo' => null,
            'favicon' => null,
            'copyright_text' => '© 2026 SIM RS. All Rights Reserved.',
            'alamat' => 'Jl. Contoh No. 123, Jakarta',
            'no_telp' => '021-12345678',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_apps');
    }
};
