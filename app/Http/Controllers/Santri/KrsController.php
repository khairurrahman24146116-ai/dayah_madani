<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Krs;
use App\Models\KrsDetail;
use App\Models\Mapel;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KrsController extends Controller
{
    public function index()
    {
        $santri = Auth::user()->santri;

        $krsList = Krs::with('kelas.tingkat', 'tahunAjaran', 'krsDetails.mapel')
            ->where('santri_id', $santri->id)
            ->latest()
            ->get();

        $tahunAjaranAktif = TahunAjaran::where('status', true)->first();
        $bisaBuatKRS = !$krsList->contains(function ($krs) use ($tahunAjaranAktif) {
            return $krs->tahun_ajaran_id === $tahunAjaranAktif?->id && in_array($krs->status, ['pending', 'disetujui']);
        });

        return view('santri.krs.index', compact('krsList', 'bisaBuatKRS'));
    }

    public function create()
    {
        $santri = Auth::user()->santri;

        $tahunAjaranAktif = TahunAjaran::where('status', true)->first();

        $kelasList = Kelas::with('tingkat', 'jurusan')
            ->where('tingkat_id', $santri->tingkat_id)
            ->get();

        $mapelList = Mapel::where('tingkat_id', $santri->tingkat_id)->get();

        return view('santri.krs.create', compact('tahunAjaranAktif', 'kelasList', 'mapelList'));
    }

    public function store(Request $request)
    {
        $santri = Auth::user()->santri;

        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_ids' => 'required|array',
            'mapel_ids.*' => 'exists:mapels,id',
        ]);

        $tahunAjaranAktif = TahunAjaran::where('status', true)->first();

        DB::transaction(function () use ($request, $santri, $tahunAjaranAktif) {
            $krs = Krs::create([
                'santri_id' => $santri->id,
                'kelas_id' => $request->kelas_id,
                'tahun_ajaran_id' => $tahunAjaranAktif?->id,
                'status' => 'pending',
            ]);

            foreach ($request->mapel_ids as $mapelId) {
                KrsDetail::create([
                    'krs_id' => $krs->id,
                    'mapel_id' => $mapelId,
                ]);
            }
        });

        return redirect()->route('santri.krs.index')
            ->with('success', 'KRS berhasil diajukan.');
    }

    public function print(Krs $krs)
    {
        $santri = Auth::user()->santri;
        if ($krs->santri_id !== $santri->id) {
            abort(403);
        }
        $krs->load('kelas.tingkat', 'tahunAjaran', 'krsDetails.mapel');
        return view('santri.krs.print', compact('santri', 'krs'));
    }
}
