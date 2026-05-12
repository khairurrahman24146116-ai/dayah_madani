<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {
        $santri = Auth::user()->santri;

        $tahunAjaranAktif = TahunAjaran::where('status', true)->first();

        $krs = $santri->krs()
            ->where('status', 'disetujui')
            ->when($tahunAjaranAktif, fn($q) => $q->where('tahun_ajaran_id', $tahunAjaranAktif->id))
            ->first();

        $jadwals = collect();

        if ($krs) {
            $jadwals = Jadwal::with('mapel', 'guru.user')
                ->where('kelas_id', $krs->kelas_id)
                ->when($tahunAjaranAktif, fn($q) => $q->where('tahun_ajaran_id', $tahunAjaranAktif->id))
                ->orderBy('hari')
                ->orderBy('jam_mulai')
                ->get();
        }

        return view('santri.jadwal.index', compact('jadwals', 'tahunAjaranAktif'));
    }
}
