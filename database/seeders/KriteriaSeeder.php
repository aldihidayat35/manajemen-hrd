<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kriteria;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kriteria = [
            [
                'kode' => 'C1',
                'nama_kriteria' => 'Nilai Mahasiswa',
                'bobot' => 5,
                'jenis' => 'benefit',
                'keterangan' => 'IPK atau nilai rata-rata mahasiswa (semakin tinggi semakin baik)'
            ],
            [
                'kode' => 'C2',
                'nama_kriteria' => 'Keunikan',
                'bobot' => 9,
                'jenis' => 'benefit',
                'keterangan' => 'Tingkat keunikan dan inovasi topik (semakin unik semakin baik)'
            ],
            [
                'kode' => 'C3',
                'nama_kriteria' => 'Minat & Bakat',
                'bobot' => 8,
                'jenis' => 'benefit',
                'keterangan' => 'Kesesuaian dengan minat dan bakat mahasiswa (semakin sesuai semakin baik)'
            ],
            [
                'kode' => 'C4',
                'nama_kriteria' => 'Waktu Pengerjaan',
                'bobot' => 5,
                'jenis' => 'cost',
                'keterangan' => 'Estimasi waktu pengerjaan dalam bulan (semakin cepat semakin baik)'
            ],
            [
                'kode' => 'C5',
                'nama_kriteria' => 'Referensi Terbaru',
                'bobot' => 7,
                'jenis' => 'benefit',
                'keterangan' => 'Ketersediaan referensi dan penelitian terbaru (semakin banyak semakin baik)'
            ],
            [
                'kode' => 'C6',
                'nama_kriteria' => 'Ketersediaan Dosen',
                'bobot' => 7,
                'jenis' => 'benefit',
                'keterangan' => 'Ketersediaan dan kesediaan dosen pembimbing (semakin tersedia semakin baik)'
            ],
        ];

        foreach ($kriteria as $k) {
            Kriteria::create($k);
        }
    }
}
