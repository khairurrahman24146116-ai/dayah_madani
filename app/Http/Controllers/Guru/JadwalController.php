<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {
        $guru = Auth::user()->guru;

        $tahunAjaranAktif = TahunAjaran::where('status', true)->first();

        $jadwals = Jadwal::with('kelas', 'mapel', 'tahunAjaran')
            ->where('guru_id', $guru->id)
            ->when($tahunAjaranAktif, fn($q) => $q->where('tahun_ajaran_id', $tahunAjaranAktif->id))
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get();

        return view('guru.jadwal.index', compact('jadwals', 'tahunAjaranAktif'));
    }
}
