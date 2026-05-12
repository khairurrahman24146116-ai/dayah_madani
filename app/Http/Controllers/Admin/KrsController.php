<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    public function index(Request $request)
    {
        $krsList = Krs::with('santri', 'kelas', 'tahunAjaran')
            ->when($request->status, fn($q, $v) => $q->where('status', $v))
            ->latest()
            ->paginate(10);

        return view('admin.krs.index', compact('krsList'));
    }

    public function show(Krs $krs)
    {
        $krs->load('santri.user', 'kelas.tingkat', 'tahunAjaran', 'krsDetails.mapel', 'krsDetails.guru');
        return view('admin.krs.show', compact('krs'));
    }

    public function approve(Request $request, Krs $krs)
    {
        $krs->update([
            'status' => 'disetujui',
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('admin.krs.index')
            ->with('success', 'KRS berhasil disetujui.');
    }

    public function reject(Request $request, Krs $krs)
    {
        $request->validate(['catatan' => 'required|string']);

        $krs->update([
            'status' => 'ditolak',
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('admin.krs.index')
            ->with('success', 'KRS berhasil ditolak.');
    }

    public function print(Krs $krs)
    {
        $krs->load('santri.user', 'kelas.tingkat', 'tahunAjaran', 'krsDetails.mapel');
        return view('admin.krs.print', compact('krs'));
    }
}
