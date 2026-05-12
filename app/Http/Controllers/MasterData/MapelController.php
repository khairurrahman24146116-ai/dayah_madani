<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use App\Models\Tingkat;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        $data = Mapel::with('tingkat')->paginate(10);
        return view('master.mapel.index', compact('data'));
    }

    public function create()
    {
        $tingkats = Tingkat::all();
        return view('master.mapel.create', compact('tingkats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tingkat_id' => 'required|exists:tingkats,id',
            'kode' => 'required',
            'nama' => 'required',
            'kategori' => 'required|in:salafi,umum,pondok',
        ]);

        Mapel::create($request->only(['tingkat_id', 'kode', 'nama', 'kategori', 'deskripsi']));

        return redirect()->route('admin.mapel.index')
            ->with('success', 'Mapel berhasil ditambahkan.');
    }

    public function edit(Mapel $mapel)
    {
        $tingkats = Tingkat::all();
        return view('master.mapel.edit', compact('mapel', 'tingkats'));
    }

    public function update(Request $request, Mapel $mapel)
    {
        $request->validate([
            'tingkat_id' => 'required|exists:tingkats,id',
            'kode' => 'required',
            'nama' => 'required',
            'kategori' => 'required|in:salafi,umum,pondok',
        ]);

        $mapel->update($request->only(['tingkat_id', 'kode', 'nama', 'kategori', 'deskripsi']));

        return redirect()->route('admin.mapel.index')
            ->with('success', 'Mapel berhasil diperbarui.');
    }

    public function destroy(Mapel $mapel)
    {
        if ($mapel->krsDetails()->exists()) {
            return redirect()->route('admin.mapel.index')
                ->with('error', 'Mapel tidak dapat dihapus karena masih memiliki data KRS.');
        }

        if ($mapel->jadwal()->exists()) {
            return redirect()->route('admin.mapel.index')
                ->with('error', 'Mapel tidak dapat dihapus karena masih memiliki data jadwal.');
        }

        if ($mapel->nilai()->exists()) {
            return redirect()->route('admin.mapel.index')
                ->with('error', 'Mapel tidak dapat dihapus karena masih memiliki data nilai.');
        }

        $mapel->delete();

        return redirect()->route('admin.mapel.index')
            ->with('success', 'Mapel berhasil dihapus.');
    }
}
