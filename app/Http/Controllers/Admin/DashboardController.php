<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Krs;
use App\Models\Mapel;
use App\Models\Santri;
use App\Models\Guru;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSantri = Santri::count();
        $totalGuru = Guru::count();
        $totalKelas = Kelas::count();
        $totalMapel = Mapel::count();
        $krsPending = Krs::where('status', 'pending')->count();

        return view('dashboard.admin', compact(
            'totalSantri',
            'totalGuru',
            'totalKelas',
            'totalMapel',
            'krsPending'
        ));
    }
}
