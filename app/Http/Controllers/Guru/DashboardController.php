<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Santri;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $guru = Auth::user()->guru;

        $jumlahKelas = Kelas::whereHas('jadwal', function ($q) use ($guru) {
            $q->where('guru_id', $guru->id);
        })->count();

        $jumlahSantri = Santri::whereHas('krs.kelas.jadwal', function ($q) use ($guru) {
            $q->where('guru_id', $guru->id);
        })->count();

        $jadwal = Jadwal::with(['mapel', 'kelas', 'tahunAjaran'])
            ->where('guru_id', $guru->id)
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get()
            ->groupBy('hari');

        return view('dashboard.guru', compact('guru', 'jumlahKelas', 'jumlahSantri', 'jadwal'));
    }
}
