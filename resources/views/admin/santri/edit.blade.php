@extends('layouts.app')

@section('title', 'Edit Santri')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="px-4 sm:px-6 py-4 bg-emerald-600">
        <h1 class="text-lg sm:text-xl font-bold text-white">Edit Santri</h1>
    </div>
    <div class="p-4 sm:p-6">
        <form action="{{ route('admin.santri.update', $santri->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="nis" class="block text-sm font-medium text-gray-700 mb-1">NIS</label>
                    <input type="text" name="nis" id="nis" value="{{ old('nis', $santri->nis) }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                    @error('nis') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label for="nisn" class="block text-sm font-medium text-gray-700 mb-1">NISN (opsional)</label>
                    <input type="text" name="nisn" id="nisn" value="{{ old('nisn', $santri->nisn) }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    @error('nisn') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', $santri->nama_lengkap) }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                    @error('nama_lengkap') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', $santri->tempat_lahir) }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                    @error('tempat_lahir') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $santri->tanggal_lahir ? $santri->tanggal_lahir->format('Y-m-d') : '') }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                    @error('tanggal_lahir') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label for="no_telp" class="block text-sm font-medium text-gray-700 mb-1">No Telp</label>
                    <input type="text" name="no_telp" id="no_telp" value="{{ old('no_telp', $santri->no_telp) }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    @error('no_telp') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label for="tingkat_id" class="block text-sm font-medium text-gray-700 mb-1">Tingkat</label>
                    <select name="tingkat_id" id="tingkat_id" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                        <option value="">Pilih Tingkat</option>
                        @foreach($tingkats as $tingkat)
                            <option value="{{ $tingkat->id }}" {{ old('tingkat_id', $santri->tingkat_id) == $tingkat->id ? 'selected' : '' }}>{{ $tingkat->nama }}</option>
                        @endforeach
                    </select>
                    @error('tingkat_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label for="nama_wali" class="block text-sm font-medium text-gray-700 mb-1">Nama Wali</label>
                    <input type="text" name="nama_wali" id="nama_wali" value="{{ old('nama_wali', $santri->nama_wali) }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                    @error('nama_wali') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label for="no_telp_wali" class="block text-sm font-medium text-gray-700 mb-1">No Telp Wali</label>
                    <input type="text" name="no_telp_wali" id="no_telp_wali" value="{{ old('no_telp_wali', $santri->no_telp_wali) }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                    @error('no_telp_wali') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4 md:col-span-2">
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="3" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">{{ old('alamat', $santri->alamat) }}</textarea>
                    @error('alamat') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="aktif" {{ old('status', $santri->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="lulus" {{ old('status', $santri->status) == 'lulus' ? 'selected' : '' }}>Lulus</option>
                        <option value="keluar" {{ old('status', $santri->status) == 'keluar' ? 'selected' : '' }}>Keluar</option>
                    </select>
                    @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="mobile-stack mt-2">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition w-full sm:w-auto">Simpan</button>
                <a href="{{ route('admin.santri.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg text-sm font-medium transition text-center w-full sm:w-auto">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
