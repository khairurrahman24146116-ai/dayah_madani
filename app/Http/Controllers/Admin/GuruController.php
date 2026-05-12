<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::with('user')->paginate(10);
        return view('admin.guru.index', compact('gurus'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|max:255|unique:gurus,nip',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string|max:20',
            'foto' => 'nullable|string|max:255',
            'bidang_keahlian' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request) {
            $email = Str::slug($request->nama_lengkap) . '@madani.sch.id';

            $user = User::create([
                'name' => $request->nama_lengkap,
                'email' => $email,
                'password' => bcrypt('password'),
                'role' => 'guru',
                'nis_or_nip' => $request->nip,
            ]);

            Guru::create([
                'user_id' => $user->id,
                'nip' => $request->nip,
                'nama_lengkap' => $request->nama_lengkap,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'foto' => $request->foto,
                'bidang_keahlian' => $request->bidang_keahlian,
            ]);
        });

        return redirect()->route('admin.guru.index')
            ->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit(Guru $guru)
    {
        $guru->load('user');
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nip' => 'required|string|max:255|unique:gurus,nip,' . $guru->id,
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string|max:20',
            'foto' => 'nullable|string|max:255',
            'bidang_keahlian' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $guru->user_id,
        ]);

        DB::transaction(function () use ($request, $guru) {
            $guru->user->update([
                'name' => $request->nama_lengkap,
                'email' => $request->email ?? $guru->user->email,
            ]);

            $guru->update([
                'nip' => $request->nip,
                'nama_lengkap' => $request->nama_lengkap,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'foto' => $request->foto,
                'bidang_keahlian' => $request->bidang_keahlian,
            ]);
        });

        return redirect()->route('admin.guru.index')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Guru $guru)
    {
        DB::transaction(function () use ($guru) {
            $guru->user()->delete();
            $guru->delete();
        });

        return redirect()->route('admin.guru.index')
            ->with('success', 'Data guru berhasil dihapus.');
    }
}
