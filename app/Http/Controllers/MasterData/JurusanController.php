<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $data = Jurusan::paginate(10);
        return view('master.jurusan.index', compact('data'));
    }

    public function create()
    {
        return view('master.jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:jurusans,kode',
            'nama' => 'required',
        ]);

        Jurusan::create($request->only(['kode', 'nama', 'deskripsi']));

        return redirect()->route('admin.jurusan.index')
            ->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function edit(Jurusan $jurusan)
    {
        return view('master.jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'kode' => 'required|unique:jurusans,kode,' . $jurusan->id,
            'nama' => 'required',
        ]);

        $jurusan->update($request->only(['kode', 'nama', 'deskripsi']));

        return redirect()->route('admin.jurusan.index')
            ->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy(Jurusan $jurusan)
    {
        if ($jurusan->kelas()->exists()) {
            return redirect()->route('admin.jurusan.index')
                ->with('error', 'Jurusan tidak dapat dihapus karena masih memiliki data kelas.');
        }

        $jurusan->delete();

        return redirect()->route('admin.jurusan.index')
            ->with('success', 'Jurusan berhasil dihapus.');
    }
}
