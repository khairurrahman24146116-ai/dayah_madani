<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Nilai;
use App\Models\Krs;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $santri = Auth::user()->santri;

        $krs = Krs::with(['kelas', 'tahunAjaran', 'krsDetails.mapel'])
            ->where('santri_id', $santri->id)
            ->latest()
            ->first();

        $jadwal = Jadwal::with(['mapel', 'guru.user', 'tahunAjaran'])
            ->whereHas('kelas.krs', function ($q) use ($santri) {
                $q->where('santri_id', $santri->id);
            })
            ->whereHas('tahunAjaran', function ($q) {
                $q->where('status', true);
            })
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get()
            ->groupBy('hari');

        $nilai = Nilai::with(['mapel'])
            ->where('santri_id', $santri->id)
            ->get();

        return view('dashboard.santri', compact('santri', 'krs', 'jadwal', 'nilai'));
    }
}
