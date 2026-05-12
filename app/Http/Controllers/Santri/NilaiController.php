<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $santri = Auth::user()->santri;

        $nilais = Nilai::with('mapel', 'kelas', 'tahunAjaran')
            ->where('santri_id', $santri->id)
            ->get()
            ->groupBy(fn($item) => $item->tahunAjaran?->nama . ' - ' . $item->tahunAjaran?->semester);

        return view('santri.nilai.index', compact('nilais'));
    }

    public function print()
    {
        $santri = Auth::user()->santri;

        $nilais = Nilai::with('mapel', 'kelas', 'tahunAjaran')
            ->where('santri_id', $santri->id)
            ->get()
            ->groupBy(fn($item) => $item->tahunAjaran?->nama . ' - ' . $item->tahunAjaran?->semester);

        return view('santri.nilai.print', compact('santri', 'nilais'));
    }
}
