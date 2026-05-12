<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $data = TahunAjaran::orderBy('tanggal_mulai', 'desc')->paginate(10);
        return view('master.tahun-ajaran.index', compact('data'));
    }

    public function create()
    {
        return view('master.tahun-ajaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:tahun_ajarans,kode',
            'nama' => 'required',
            'semester' => 'required|in:ganjil,genap',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ]);

        $data = $request->only(['kode', 'nama', 'semester', 'tanggal_mulai', 'tanggal_selesai', 'status']);

        if (!empty($data['status'])) {
            TahunAjaran::where('status', true)->update(['status' => false]);
        }

        TahunAjaran::create($data);

        return redirect()->route('admin.tahun-ajaran.index')
            ->with('success', 'Tahun ajaran berhasil ditambahkan.');
    }

    public function edit(TahunAjaran $tahunAjaran)
    {
        return view('master.tahun-ajaran.edit', compact('tahunAjaran'));
    }

    public function update(Request $request, TahunAjaran $tahunAjaran)
    {
        $request->validate([
            'kode' => 'required|unique:tahun_ajarans,kode,' . $tahunAjaran->id,
            'nama' => 'required',
            'semester' => 'required|in:ganjil,genap',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ]);

        $data = $request->only(['kode', 'nama', 'semester', 'tanggal_mulai', 'tanggal_selesai', 'status']);

        if (!empty($data['status'])) {
            TahunAjaran::where('status', true)
                ->where('id', '!=', $tahunAjaran->id)
                ->update(['status' => false]);
        }

        $tahunAjaran->update($data);

        return redirect()->route('admin.tahun-ajaran.index')
            ->with('success', 'Tahun ajaran berhasil diperbarui.');
    }

    public function destroy(TahunAjaran $tahunAjaran)
    {
        if ($tahunAjaran->krs()->exists()) {
            return redirect()->route('admin.tahun-ajaran.index')
                ->with('error', 'Tahun ajaran tidak dapat dihapus karena masih memiliki data KRS.');
        }

        if ($tahunAjaran->jadwal()->exists()) {
            return redirect()->route('admin.tahun-ajaran.index')
                ->with('error', 'Tahun ajaran tidak dapat dihapus karena masih memiliki data jadwal.');
        }

        if ($tahunAjaran->nilai()->exists()) {
            return redirect()->route('admin.tahun-ajaran.index')
                ->with('error', 'Tahun ajaran tidak dapat dihapus karena masih memiliki data nilai.');
        }

        $tahunAjaran->delete();

        return redirect()->route('admin.tahun-ajaran.index')
            ->with('success', 'Tahun ajaran berhasil dihapus.');
    }
}
