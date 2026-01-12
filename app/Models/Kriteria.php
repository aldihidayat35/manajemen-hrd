<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriteria';

    protected $fillable = [
        'kode',
        'nama_kriteria',
        'bobot',
        'jenis',
        'keterangan',
    ];

    /**
     * Relasi ke penilaian topik
     */
    public function penilaianTopik()
    {
        return $this->hasMany(PenilaianTopik::class);
    }

    /**
     * Check if kriteria is benefit type
     */
    public function isBenefit(): bool
    {
        return $this->jenis === 'benefit';
    }

    /**
     * Check if kriteria is cost type
     */
    public function isCost(): bool
    {
        return $this->jenis === 'cost';
    }
}
