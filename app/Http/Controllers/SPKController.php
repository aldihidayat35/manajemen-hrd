<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\AlternatifTopik;
use App\Models\PenilaianTopik;
use Yajra\DataTables\Facades\DataTables;

class SPKController extends Controller
{
    /**
     * Display SPK dashboard
     */
    public function index()
    {
        $totalKriteria = Kriteria::count();
        $totalTopik = AlternatifTopik::count();
        $topikTersedia = AlternatifTopik::where('status', 'tersedia')->count();

        return view('spk.index', compact('totalKriteria', 'totalTopik', 'topikTersedia'));
    }

    /**
     * Halaman perhitungan SAW
     */
    public function perhitungan()
    {
        $kriteria = Kriteria::orderBy('kode')->get();
        $alternatif = AlternatifTopik::with('penilaianTopik')->get();

        // Hitung menggunakan metode SAW
        $hasil = $this->hitungSAW();

        return view('spk.perhitungan', compact('kriteria', 'alternatif', 'hasil'));
    }

    /**
     * Metode SAW (Simple Additive Weighting)
     */
    private function hitungSAW()
    {
        $kriteria = Kriteria::all();
        $alternatif = AlternatifTopik::with('penilaianTopik')->get();

        if ($kriteria->isEmpty() || $alternatif->isEmpty()) {
            return [];
        }

        $hasil = [];
        $matriksNormalisasi = [];

        // Step 1: Buat matriks keputusan dan cari nilai max/min per kriteria
        $nilaiMaxMin = [];
        foreach ($kriteria as $k) {
            $nilaiKriteria = [];
            foreach ($alternatif as $alt) {
                $nilai = $alt->getNilaiKriteria($k->id);
                $nilaiKriteria[] = $nilai;
            }

            if ($k->isBenefit()) {
                $nilaiMaxMin[$k->id] = ['max' => max($nilaiKriteria), 'type' => 'benefit'];
            } else {
                $nilaiMaxMin[$k->id] = ['min' => min($nilaiKriteria), 'type' => 'cost'];
            }
        }

        // Step 2: Normalisasi matriks
        foreach ($alternatif as $alt) {
            $matriksNormalisasi[$alt->id] = [];

            foreach ($kriteria as $k) {
                $nilai = $alt->getNilaiKriteria($k->id);

                if ($k->isBenefit()) {
                    // Benefit: Rij = Xij / Max(Xij)
                    $nilaiNormalisasi = $nilaiMaxMin[$k->id]['max'] > 0
                        ? $nilai / $nilaiMaxMin[$k->id]['max']
                        : 0;
                } else {
                    // Cost: Rij = Min(Xij) / Xij
                    $nilaiNormalisasi = $nilai > 0
                        ? $nilaiMaxMin[$k->id]['min'] / $nilai
                        : 0;
                }

                $matriksNormalisasi[$alt->id][$k->id] = $nilaiNormalisasi;
            }
        }

        // Step 3: Hitung nilai preferensi (Vi)
        $totalBobot = $kriteria->sum('bobot');

        foreach ($alternatif as $alt) {
            $nilaiPreferensi = 0;
            $detailPerhitungan = [];

            foreach ($kriteria as $k) {
                $bobotNormalisasi = $totalBobot > 0 ? $k->bobot / $totalBobot : 0;
                $nilaiTerbobot = $matriksNormalisasi[$alt->id][$k->id] * $bobotNormalisasi;
                $nilaiPreferensi += $nilaiTerbobot;

                $detailPerhitungan[$k->kode] = [
                    'nama_kriteria' => $k->nama_kriteria,
                    'nilai_asli' => $alt->getNilaiKriteria($k->id),
                    'nilai_normalisasi' => round($matriksNormalisasi[$alt->id][$k->id], 4),
                    'bobot' => $k->bobot,
                    'bobot_normalisasi' => round($bobotNormalisasi, 4),
                    'nilai_terbobot' => round($nilaiTerbobot, 4),
                ];
            }

            $hasil[] = [
                'alternatif' => $alt,
                'nilai_preferensi' => round($nilaiPreferensi, 4),
                'detail' => $detailPerhitungan,
            ];
        }

        // Sort hasil berdasarkan nilai preferensi (descending)
        usort($hasil, function($a, $b) {
            return $b['nilai_preferensi'] <=> $a['nilai_preferensi'];
        });

        // Tambahkan ranking
        foreach ($hasil as $index => &$item) {
            $item['ranking'] = $index + 1;
        }

        return $hasil;
    }

    /**
     * Get hasil perhitungan untuk DataTables
     */
    public function getHasilPerhitungan()
    {
        $hasil = $this->hitungSAW();

        return DataTables::of(collect($hasil))
            ->addIndexColumn()
            ->addColumn('kode_topik', function($row) {
                return $row['alternatif']->kode_topik;
            })
            ->addColumn('judul_topik', function($row) {
                return $row['alternatif']->judul_topik;
            })
            ->addColumn('dosen_pembimbing', function($row) {
                return $row['alternatif']->dosen_pembimbing ?? '-';
            })
            ->addColumn('nilai_preferensi', function($row) {
                return number_format($row['nilai_preferensi'], 4);
            })
            ->addColumn('ranking_badge', function($row) {
                $badgeClass = '';
                if ($row['ranking'] == 1) $badgeClass = 'badge-light-success';
                elseif ($row['ranking'] == 2) $badgeClass = 'badge-light-primary';
                elseif ($row['ranking'] == 3) $badgeClass = 'badge-light-info';
                else $badgeClass = 'badge-light-secondary';

                return '<span class="badge ' . $badgeClass . ' fs-7">Rank #' . $row['ranking'] . '</span>';
            })
            ->addColumn('action', function($row) {
                return '<button class="btn btn-sm btn-primary" onclick="showDetail(' . $row['alternatif']->id . ')">
                            <i class="ki-duotone ki-eye fs-5"></i> Detail
                        </button>';
            })
            ->rawColumns(['ranking_badge', 'action'])
            ->make(true);
    }

    /**
     * Get detail perhitungan untuk alternatif tertentu
     */
    public function getDetailPerhitungan($id)
    {
        $hasil = $this->hitungSAW();

        foreach ($hasil as $item) {
            if ($item['alternatif']->id == $id) {
                return response()->json([
                    'success' => true,
                    'data' => $item
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ], 404);
    }
}
