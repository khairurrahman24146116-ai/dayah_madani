<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Tingkat;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $data = Kelas::with(['tingkat', 'jurusan'])->paginate(10);
        return view('master.kelas.index', compact('data'));
    }

    public function create()
    {
        $tingkats = Tingkat::all();
        $jurusans = Jurusan::all();
        return view('master.kelas.create', compact('tingkats', 'jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tingkat_id' => 'required|exists:tingkats,id',
            'nama' => 'required',
            'kode' => 'required|unique:kelas,kode',
        ]);

        Kelas::create($request->only(['tingkat_id', 'jurusan_id', 'nama', 'kode']));

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function edit(Kelas $kelas)
    {
        $tingkats = Tingkat::all();
        $jurusans = Jurusan::all();
        return view('master.kelas.edit', compact('kelas', 'tingkats', 'jurusans'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'tingkat_id' => 'required|exists:tingkats,id',
            'nama' => 'required',
            'kode' => 'required|unique:kelas,kode,' . $kelas->id,
        ]);

        $kelas->update($request->only(['tingkat_id', 'jurusan_id', 'nama', 'kode']));

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kelas)
    {
        if ($kelas->krs()->exists()) {
            return redirect()->route('admin.kelas.index')
                ->with('error', 'Kelas tidak dapat dihapus karena masih memiliki data KRS.');
        }

        if ($kelas->jadwal()->exists()) {
            return redirect()->route('admin.kelas.index')
                ->with('error', 'Kelas tidak dapat dihapus karena masih memiliki data jadwal.');
        }

        if ($kelas->nilai()->exists()) {
            return redirect()->route('admin.kelas.index')
                ->with('error', 'Kelas tidak dapat dihapus karena masih memiliki data nilai.');
        }

        $kelas->delete();

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil dihapus.');
    }
}
