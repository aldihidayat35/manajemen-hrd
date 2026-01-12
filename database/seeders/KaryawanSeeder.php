<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karyawan;
use Carbon\Carbon;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $karyawan = [
            [
                'nikKry' => 'K001',
                'namaKaryawan' => 'John Doe',
                'nikKtp' => '1234567890123456',
                'unit' => 'IT Department',
                'gol' => 'III/A',
                'profesi' => 'Software Developer',
                'statusPegawai' => 'Tetap',
                'tempatLahir' => 'Jakarta',
                'tglLahir' => Carbon::parse('1990-01-01'),
                'jenisKelamin' => 'Laki-laki',
            ],
            [
                'nikKry' => 'K002',
                'namaKaryawan' => 'Jane Smith',
                'nikKtp' => '1234567890123457',
                'unit' => 'Human Resources',
                'gol' => 'III/B',
                'profesi' => 'HR Manager',
                'statusPegawai' => 'Tetap',
                'tempatLahir' => 'Bandung',
                'tglLahir' => Carbon::parse('1988-05-15'),
                'jenisKelamin' => 'Perempuan',
            ],
            [
                'nikKry' => 'K003',
                'namaKaryawan' => 'Bob Johnson',
                'nikKtp' => '1234567890123458',
                'unit' => 'Finance',
                'gol' => 'II/C',
                'profesi' => 'Accountant',
                'statusPegawai' => 'Kontrak',
                'tempatLahir' => 'Surabaya',
                'tglLahir' => Carbon::parse('1992-08-20'),
                'jenisKelamin' => 'Laki-laki',
            ],
            [
                'nikKry' => 'K004',
                'namaKaryawan' => 'Alice Williams',
                'nikKtp' => '1234567890123459',
                'unit' => 'Marketing',
                'gol' => 'III/A',
                'profesi' => 'Marketing Specialist',
                'statusPegawai' => 'Tetap',
                'tempatLahir' => 'Yogyakarta',
                'tglLahir' => Carbon::parse('1991-12-10'),
                'jenisKelamin' => 'Perempuan',
            ],
            [
                'nikKry' => 'K005',
                'namaKaryawan' => 'Charlie Brown',
                'nikKtp' => '1234567890123460',
                'unit' => 'Operations',
                'gol' => 'II/D',
                'profesi' => 'Operations Officer',
                'statusPegawai' => 'Magang',
                'tempatLahir' => 'Semarang',
                'tglLahir' => Carbon::parse('1995-03-25'),
                'jenisKelamin' => 'Laki-laki',
            ],
            [
                'nikKry' => 'K006',
                'namaKaryawan' => 'Diana Prince',
                'nikKtp' => '1234567890123461',
                'unit' => 'Legal',
                'gol' => 'IV/A',
                'profesi' => 'Legal Counsel',
                'statusPegawai' => 'Tetap',
                'tempatLahir' => 'Jakarta',
                'tglLahir' => Carbon::parse('1987-07-18'),
                'jenisKelamin' => 'Perempuan',
            ],
            [
                'nikKry' => 'K007',
                'namaKaryawan' => 'Edward Norton',
                'nikKtp' => '1234567890123462',
                'unit' => 'IT Department',
                'gol' => 'II/B',
                'profesi' => 'System Administrator',
                'statusPegawai' => 'Tetap',
                'tempatLahir' => 'Medan',
                'tglLahir' => Carbon::parse('1993-11-22'),
                'jenisKelamin' => 'Laki-laki',
            ],
            [
                'nikKry' => 'K008',
                'namaKaryawan' => 'Fiona Green',
                'nikKtp' => '1234567890123463',
                'unit' => 'Customer Service',
                'gol' => 'II/A',
                'profesi' => 'Customer Service Manager',
                'statusPegawai' => 'Tetap',
                'tempatLahir' => 'Bali',
                'tglLahir' => Carbon::parse('1989-04-14'),
                'jenisKelamin' => 'Perempuan',
            ],
            [
                'nikKry' => 'K009',
                'namaKaryawan' => 'George Harris',
                'nikKtp' => '1234567890123464',
                'unit' => 'Production',
                'gol' => 'III/C',
                'profesi' => 'Production Supervisor',
                'statusPegawai' => 'Tetap',
                'tempatLahir' => 'Makassar',
                'tglLahir' => Carbon::parse('1986-09-30'),
                'jenisKelamin' => 'Laki-laki',
            ],
            [
                'nikKry' => 'K010',
                'namaKaryawan' => 'Helen Clark',
                'nikKtp' => '1234567890123465',
                'unit' => 'Research & Development',
                'gol' => 'IV/B',
                'profesi' => 'Research Analyst',
                'statusPegawai' => 'Tetap',
                'tempatLahir' => 'Surabaya',
                'tglLahir' => Carbon::parse('1985-02-28'),
                'jenisKelamin' => 'Perempuan',
            ],
        ];

        foreach ($karyawan as $data) {
            Karyawan::create($data);
        }
    }
}
