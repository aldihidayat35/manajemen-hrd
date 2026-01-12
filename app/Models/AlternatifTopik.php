<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternatifTopik extends Model
{
    use HasFactory;

    protected $table = 'alternatif_topik';

    protected $fillable = [
        'kode_topik',
        'judul_topik',
        'deskripsi',
        'dosen_pembimbing',
        'status',
    ];

    /**
     * Relasi ke penilaian topik
     */
    public function penilaianTopik()
    {
        return $this->hasMany(PenilaianTopik::class);
    }

    /**
     * Get nilai untuk kriteria tertentu
     */
    public function getNilaiKriteria($kriteriaId)
    {
        $penilaian = $this->penilaianTopik()->where('kriteria_id', $kriteriaId)->first();
        return $penilaian ? $penilaian->nilai : 0;
    }

    /**
     * Check if topik tersedia
     */
    public function isTersedia(): bool
    {
        return $this->status === 'tersedia';
    }
}
