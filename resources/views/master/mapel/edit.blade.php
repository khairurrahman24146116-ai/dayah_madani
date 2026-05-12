@extends('layouts.app')

@section('title', 'Edit Mata Pelajaran')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="px-6 py-4 bg-emerald-600">
        <h1 class="text-xl font-bold text-white">Edit Mata Pelajaran</h1>
    </div>
    <div class="p-6">
        <form action="{{ route('admin.mapel.update', $mapel->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="kode" class="block text-sm font-medium text-gray-700 mb-1">Kode</label>
                <input type="text" name="kode" id="kode" value="{{ old('kode', $mapel->kode) }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                @error('kode')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $mapel->nama) }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                @error('nama')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="tingkat_id" class="block text-sm font-medium text-gray-700 mb-1">Tingkat</label>
                <select name="tingkat_id" id="tingkat_id" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                    <option value="">-- Pilih Tingkat --</option>
                    @foreach($tingkats as $tingkat)
                        <option value="{{ $tingkat->id }}" {{ old('tingkat_id', $mapel->tingkat_id) == $tingkat->id ? 'selected' : '' }}>{{ $tingkat->nama }}</option>
                    @endforeach
                </select>
                @error('tingkat_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="kategori" id="kategori" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="salafi" {{ old('kategori', $mapel->kategori) == 'salafi' ? 'selected' : '' }}>Salafi</option>
                    <option value="umum" {{ old('kategori', $mapel->kategori) == 'umum' ? 'selected' : '' }}>Umum</option>
                    <option value="pondok" {{ old('kategori', $mapel->kategori) == 'pondok' ? 'selected' : '' }}>Pondok</option>
                </select>
                @error('kategori')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">{{ old('deskripsi', $mapel->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center space-x-3">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition">Simpan</button>
                <a href="{{ route('admin.mapel.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg text-sm font-medium transition">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
