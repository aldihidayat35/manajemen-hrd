<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianTopik extends Model
{
    use HasFactory;

    protected $table = 'penilaian_topik';

    protected $fillable = [
        'alternatif_topik_id',
        'kriteria_id',
        'nilai',
    ];

    protected $casts = [
        'nilai' => 'decimal:2',
    ];

    /**
     * Relasi ke alternatif topik
     */
    public function alternatifTopik()
    {
        return $this->belongsTo(AlternatifTopik::class);
    }

    /**
     * Relasi ke kriteria
     */
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
