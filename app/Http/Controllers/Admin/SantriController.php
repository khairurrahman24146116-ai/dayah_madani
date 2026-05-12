<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Santri;
use App\Models\Tingkat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SantriController extends Controller
{
    public function index(Request $request)
    {
        $santris = Santri::with('user', 'tingkat')
            ->when($request->tingkat_id, fn($q, $v) => $q->where('tingkat_id', $v))
            ->paginate(10);

        $tingkats = Tingkat::all();

        return view('admin.santri.index', compact('santris', 'tingkats'));
    }

    public function create()
    {
        $tingkats = Tingkat::all();
        return view('admin.santri.create', compact('tingkats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|string|max:255|unique:santris,nis',
            'nisn' => 'nullable|string|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string|max:20',
            'foto' => 'nullable|string|max:255',
            'tingkat_id' => 'required|exists:tingkats,id',
            'jenis_kelamin' => 'nullable|in:L,P',
            'nama_wali' => 'nullable|string|max:255',
            'no_telp_wali' => 'nullable|string|max:20',
            'status' => 'nullable|string|max:50',
        ]);

        DB::transaction(function () use ($request) {
            $email = Str::slug($request->nama_lengkap) . '@madani.sch.id';

            $user = User::create([
                'name' => $request->nama_lengkap,
                'email' => $email,
                'password' => bcrypt('password'),
                'role' => 'santri',
                'nis_or_nip' => $request->nis,
            ]);

            Santri::create([
                'user_id' => $user->id,
                'nis' => $request->nis,
                'nisn' => $request->nisn,
                'nama_lengkap' => $request->nama_lengkap,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'foto' => $request->foto,
                'tingkat_id' => $request->tingkat_id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nama_wali' => $request->nama_wali,
                'no_telp_wali' => $request->no_telp_wali,
                'status' => $request->status,
            ]);
        });

        return redirect()->route('admin.santri.index')
            ->with('success', 'Data santri berhasil ditambahkan.');
    }

    public function edit(Santri $santri)
    {
        $santri->load('user');
        $tingkats = Tingkat::all();
        return view('admin.santri.edit', compact('santri', 'tingkats'));
    }

    public function update(Request $request, Santri $santri)
    {
        $request->validate([
            'nis' => 'required|string|max:255|unique:santris,nis,' . $santri->id,
            'nisn' => 'nullable|string|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string|max:20',
            'foto' => 'nullable|string|max:255',
            'tingkat_id' => 'required|exists:tingkats,id',
            'jenis_kelamin' => 'nullable|in:L,P',
            'nama_wali' => 'nullable|string|max:255',
            'no_telp_wali' => 'nullable|string|max:20',
            'status' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255|unique:users,email,' . $santri->user_id,
        ]);

        DB::transaction(function () use ($request, $santri) {
            $santri->user->update([
                'name' => $request->nama_lengkap,
                'email' => $request->email ?? $santri->user->email,
            ]);

            $santri->update([
                'nis' => $request->nis,
                'nisn' => $request->nisn,
                'nama_lengkap' => $request->nama_lengkap,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'foto' => $request->foto,
                'tingkat_id' => $request->tingkat_id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nama_wali' => $request->nama_wali,
                'no_telp_wali' => $request->no_telp_wali,
                'status' => $request->status ?? $santri->status,
            ]);
        });

        return redirect()->route('admin.santri.index')
            ->with('success', 'Data santri berhasil diperbarui.');
    }

    public function destroy(Santri $santri)
    {
        DB::transaction(function () use ($santri) {
            $santri->user()->delete();
            $santri->delete();
        });

        return redirect()->route('admin.santri.index')
            ->with('success', 'Data santri berhasil dihapus.');
    }
}
