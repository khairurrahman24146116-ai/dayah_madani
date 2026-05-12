<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Santri;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $guru = Auth::user()->guru;

        $kelasMapel = Jadwal::with('kelas.tingkat', 'mapel')
            ->where('guru_id', $guru->id)
            ->get()
            ->unique(function ($item) {
                return $item->kelas_id . '-' . $item->mapel_id;
            });

        return view('guru.nilai.index', compact('kelasMapel'));
    }

    public function create($kelasId, $mapelId)
    {
        $guru = Auth::user()->guru;

        $kelas = Kelas::findOrFail($kelasId);
        $mapel = Mapel::findOrFail($mapelId);
        $tahunAjaranAktif = TahunAjaran::where('status', true)->first();

        $santris = Santri::whereHas('krs', function ($q) use ($kelasId, $tahunAjaranAktif) {
            $q->where('kelas_id', $kelasId)
                ->where('status', 'disetujui')
                ->when($tahunAjaranAktif, fn($q2) => $q2->where('tahun_ajaran_id', $tahunAjaranAktif->id));
        })->with(['nilai' => function ($q) use ($mapelId, $kelasId, $tahunAjaranAktif) {
            $q->where('mapel_id', $mapelId)
                ->where('kelas_id', $kelasId)
                ->when($tahunAjaranAktif, fn($q2) => $q2->where('tahun_ajaran_id', $tahunAjaranAktif->id));
        }])->get();

        return view('guru.nilai.create', compact('santris', 'kelas', 'mapel', 'kelasId', 'mapelId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'nilai' => 'required|array',
            'nilai.*.santri_id' => 'required|exists:santris,id',
            'nilai.*.nilai_tugas' => 'nullable|numeric|min:0|max:100',
            'nilai.*.nilai_uts' => 'nullable|numeric|min:0|max:100',
            'nilai.*.nilai_uas' => 'nullable|numeric|min:0|max:100',
        ]);

        $guru = Auth::user()->guru;
        $tahunAjaranAktif = TahunAjaran::where('status', true)->first();

        foreach ($request->nilai as $item) {
            $nilaiTugas = $item['nilai_tugas'] ?? null;
            $nilaiUts = $item['nilai_uts'] ?? null;
            $nilaiUas = $item['nilai_uas'] ?? null;

            $nilaiAkhir = null;
            if (!is_null($nilaiTugas) && !is_null($nilaiUts) && !is_null($nilaiUas)) {
                $nilaiAkhir = round(($nilaiTugas + $nilaiUts + $nilaiUas) / 3, 2);
            }

            Nilai::updateOrCreate(
                [
                    'santri_id' => $item['santri_id'],
                    'mapel_id' => $request->mapel_id,
                    'kelas_id' => $request->kelas_id,
                    'tahun_ajaran_id' => $tahunAjaranAktif?->id,
                ],
                [
                    'guru_id' => $guru->id,
                    'nilai_tugas' => $nilaiTugas,
                    'nilai_uts' => $nilaiUts,
                    'nilai_uas' => $nilaiUas,
                    'nilai_akhir' => $nilaiAkhir,
                ]
            );
        }

        return redirect()->route('guru.nilai.index')
            ->with('success', 'Nilai berhasil disimpan.');
    }

    public function update(Request $request, Nilai $nilai)
    {
        $request->validate([
            'nilai_tugas' => 'nullable|numeric|min:0|max:100',
            'nilai_uts' => 'nullable|numeric|min:0|max:100',
            'nilai_uas' => 'nullable|numeric|min:0|max:100',
        ]);

        $nilaiTugas = $request->nilai_tugas;
        $nilaiUts = $request->nilai_uts;
        $nilaiUas = $request->nilai_uas;

        $nilaiAkhir = null;
        if (!is_null($nilaiTugas) && !is_null($nilaiUts) && !is_null($nilaiUas)) {
            $nilaiAkhir = round(($nilaiTugas + $nilaiUts + $nilaiUas) / 3, 2);
        }

        $nilai->update([
            'nilai_tugas' => $nilaiTugas,
            'nilai_uts' => $nilaiUts,
            'nilai_uas' => $nilaiUas,
            'nilai_akhir' => $nilaiAkhir,
        ]);

        return redirect()->back()->with('success', 'Nilai berhasil diperbarui.');
    }

    public function print($kelasId, $mapelId)
    {
        $guru = Auth::user()->guru;
        $kelas = Kelas::findOrFail($kelasId);
        $mapel = Mapel::findOrFail($mapelId);
        $tahunAjaranAktif = TahunAjaran::where('status', true)->first();

        $santris = Santri::whereHas('krs', function ($q) use ($kelasId, $tahunAjaranAktif) {
            $q->where('kelas_id', $kelasId)
                ->where('status', 'disetujui')
                ->when($tahunAjaranAktif, fn($q2) => $q2->where('tahun_ajaran_id', $tahunAjaranAktif->id));
        })->with(['nilai' => function ($q) use ($mapelId, $kelasId, $tahunAjaranAktif) {
            $q->where('mapel_id', $mapelId)
                ->where('kelas_id', $kelasId)
                ->when($tahunAjaranAktif, fn($q2) => $q2->where('tahun_ajaran_id', $tahunAjaranAktif->id));
        }])->get();

        return view('guru.nilai.print', compact('santris', 'kelas', 'mapel', 'guru', 'tahunAjaranAktif'));
    }
}
