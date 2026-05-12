<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Tingkat;
use Illuminate\Http\Request;

class TingkatController extends Controller
{
    public function index()
    {
        $data = Tingkat::paginate(10);
        return view('master.tingkat.index', compact('data'));
    }

    public function create()
    {
        return view('master.tingkat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:tingkats,kode',
            'nama' => 'required',
        ]);

        Tingkat::create($request->only(['kode', 'nama', 'deskripsi']));

        return redirect()->route('admin.tingkat.index')
            ->with('success', 'Tingkat berhasil ditambahkan.');
    }

    public function edit(Tingkat $tingkat)
    {
        return view('master.tingkat.edit', compact('tingkat'));
    }

    public function update(Request $request, Tingkat $tingkat)
    {
        $request->validate([
            'kode' => 'required|unique:tingkats,kode,' . $tingkat->id,
            'nama' => 'required',
        ]);

        $tingkat->update($request->only(['kode', 'nama', 'deskripsi']));

        return redirect()->route('admin.tingkat.index')
            ->with('success', 'Tingkat berhasil diperbarui.');
    }

    public function destroy(Tingkat $tingkat)
    {
        if ($tingkat->kelas()->exists()) {
            return redirect()->route('admin.tingkat.index')
                ->with('error', 'Tingkat tidak dapat dihapus karena masih memiliki data kelas.');
        }

        if ($tingkat->mapel()->exists()) {
            return redirect()->route('admin.tingkat.index')
                ->with('error', 'Tingkat tidak dapat dihapus karena masih memiliki data mapel.');
        }

        if ($tingkat->santri()->exists()) {
            return redirect()->route('admin.tingkat.index')
                ->with('error', 'Tingkat tidak dapat dihapus karena masih memiliki data santri.');
        }

        $tingkat->delete();

        return redirect()->route('admin.tingkat.index')
            ->with('success', 'Tingkat berhasil dihapus.');
    }
}
