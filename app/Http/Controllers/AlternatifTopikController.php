<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlternatifTopik;
use App\Models\Kriteria;
use App\Models\PenilaianTopik;
use Yajra\DataTables\Facades\DataTables;

class AlternatifTopikController extends Controller
{
    public function index()
    {
        return view('spk.alternatif.index');
    }

    public function getData()
    {
        $alternatif = AlternatifTopik::select(['id', 'kode_topik', 'judul_topik', 'dosen_pembimbing', 'status', 'created_at']);

        return DataTables::of($alternatif)
            ->addIndexColumn()
            ->addColumn('status_badge', function ($row) {
                $badges = [
                    'tersedia' => 'badge-light-success',
                    'diambil' => 'badge-light-warning',
                    'selesai' => 'badge-light-secondary',
                ];
                $class = $badges[$row->status] ?? 'badge-light-secondary';
                return '<span class="badge ' . $class . '">' . ucfirst($row->status) . '</span>';
            })
            ->addColumn('action', function ($row) {
                return '
                    <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" onclick="editAlternatif(' . $row->id . ')">
                        <i class="ki-duotone ki-pencil fs-2"></i>
                    </button>
                    <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" onclick="inputNilai(' . $row->id . ')">
                        <i class="ki-duotone ki-notepad fs-2"></i>
                    </button>
                    <button class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" onclick="deleteAlternatif(' . $row->id . ')">
                        <i class="ki-duotone ki-trash fs-2"></i>
                    </button>
                ';
            })
            ->rawColumns(['status_badge', 'action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_topik' => 'required|unique:alternatif_topik,kode_topik',
            'judul_topik' => 'required|max:255',
            'deskripsi' => 'nullable',
            'dosen_pembimbing' => 'nullable|max:100',
            'status' => 'required|in:tersedia,diambil,selesai',
        ]);

        AlternatifTopik::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Topik berhasil ditambahkan'
        ]);
    }

    public function show($id)
    {
        $alternatif = AlternatifTopik::with('penilaianTopik.kriteria')->findOrFail($id);
        return response()->json($alternatif);
    }

    public function update(Request $request, $id)
    {
        $alternatif = AlternatifTopik::findOrFail($id);

        $request->validate([
            'kode_topik' => 'required|unique:alternatif_topik,kode_topik,' . $id,
            'judul_topik' => 'required|max:255',
            'deskripsi' => 'nullable',
            'dosen_pembimbing' => 'nullable|max:100',
            'status' => 'required|in:tersedia,diambil,selesai',
        ]);

        $alternatif->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Topik berhasil diupdate'
        ]);
    }

    public function destroy($id)
    {
        $alternatif = AlternatifTopik::findOrFail($id);
        $alternatif->delete();

        return response()->json([
            'success' => true,
            'message' => 'Topik berhasil dihapus'
        ]);
    }

    public function storeNilai(Request $request, $id)
    {
        $alternatif = AlternatifTopik::findOrFail($id);
        $kriteria = Kriteria::all();

        foreach ($kriteria as $k) {
            $nilai = $request->input('nilai_' . $k->id, 0);

            PenilaianTopik::updateOrCreate(
                [
                    'alternatif_topik_id' => $id,
                    'kriteria_id' => $k->id,
                ],
                [
                    'nilai' => $nilai
                ]
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Penilaian berhasil disimpan'
        ]);
    }

    public function getNilai($id)
    {
        $alternatif = AlternatifTopik::with('penilaianTopik')->findOrFail($id);
        $kriteria = Kriteria::all();

        $nilai = [];
        foreach ($kriteria as $k) {
            $penilaian = $alternatif->penilaianTopik->where('kriteria_id', $k->id)->first();
            $nilai[$k->id] = $penilaian ? $penilaian->nilai : 0;
        }

        return response()->json([
            'success' => true,
            'alternatif' => $alternatif,
            'kriteria' => $kriteria,
            'nilai' => $nilai
        ]);
    }
}
