<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataApp extends Model
{
    use HasFactory;

    protected $table = 'data_apps';

    protected $fillable = [
        'nama_app',
        'nama_instansi',
        'logo',
        'favicon',
        'copyright_text',
        'alamat',
        'no_telp',
    ];

    /**
     * Get single row instance (Singleton Pattern)
     */
    public static function getInstance()
    {
        return self::first() ?? self::create([
            'nama_app' => 'SIM RS',
            'nama_instansi' => 'Rumah Sakit Umum',
            'copyright_text' => '© 2026 SIM RS. All Rights Reserved.',
            'alamat' => 'Jl. Contoh No. 123, Jakarta',
            'no_telp' => '021-12345678',
        ]);
    }
}
