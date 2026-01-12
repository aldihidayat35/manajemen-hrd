<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';

    protected $fillable = [
        'nikKry',
        'namaKaryawan',
        'nikKtp',
        'unit',
        'gol',
        'profesi',
        'statusPegawai',
        'tempatLahir',
        'tglLahir',
        'jenisKelamin',
    ];

    protected $casts = [
        'tglLahir' => 'date',
    ];
}
