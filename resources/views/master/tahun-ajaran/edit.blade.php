@extends('layouts.app')

@section('title', 'Edit Tahun Ajaran')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="px-4 sm:px-6 py-4 bg-emerald-600">
        <h1 class="text-lg sm:text-xl font-bold text-white">Edit Tahun Ajaran</h1>
    </div>
    <div class="p-4 sm:p-6">
        <form action="{{ route('admin.tahun-ajaran.update', $tahunAjaran->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="kode" class="block text-sm font-medium text-gray-700 mb-1">Kode</label>
                <input type="text" name="kode" id="kode" value="{{ old('kode', $tahunAjaran->kode) }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                @error('kode')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $tahunAjaran->nama) }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                @error('nama')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="semester" class="block text-sm font-medium text-gray-700 mb-1">Semester</label>
                <select name="semester" id="semester" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                    <option value="">-- Pilih Semester --</option>
                    <option value="ganjil" {{ old('semester', $tahunAjaran->semester) == 'ganjil' ? 'selected' : '' }}>Ganjil</option>
                    <option value="genap" {{ old('semester', $tahunAjaran->semester) == 'genap' ? 'selected' : '' }}>Genap</option>
                </select>
                @error('semester')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai', $tahunAjaran->tanggal_mulai ? \Carbon\Carbon::parse($tahunAjaran->tanggal_mulai)->format('Y-m-d') : '') }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                @error('tanggal_mulai')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai', $tahunAjaran->tanggal_selesai ? \Carbon\Carbon::parse($tahunAjaran->tanggal_selesai)->format('Y-m-d') : '') }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                @error('tanggal_selesai')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="status" id="status" value="1" {{ old('status', $tahunAjaran->status) ? 'checked' : '' }} class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                    <span class="text-sm font-medium text-gray-700">Status Aktif</span>
                </label>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mobile-stack">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition w-full sm:w-auto">Simpan</button>
                <a href="{{ route('admin.tahun-ajaran.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg text-sm font-medium transition text-center w-full sm:w-auto">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
