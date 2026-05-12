@extends('layouts.app')

@section('title', 'Buat KRS Baru')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="px-4 sm:px-6 py-4 bg-emerald-600">
        <h1 class="text-lg sm:text-xl font-bold text-white">Buat KRS Baru</h1>
    </div>
    <div class="p-4 sm:p-6">
        <form action="{{ route('santri.krs.store') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="kelas_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Kelas</label>
                <select name="kelas_id" id="kelas_id" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                    <option value="">Pilih Kelas</option>
                    @foreach($kelasList as $kelas)
                        <option value="{{ $kelas->id }}" {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>{{ $kelas->nama }}</option>
                    @endforeach
                </select>
                @error('kelas_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-3">Pilih Mata Pelajaran</h2>
                @php
                    $kategoriMap = [];
                    foreach ($mapelList as $mapel) {
                        $kat = $mapel->kategori ?? 'Umum';
                        $kategoriMap[$kat][] = $mapel;
                    }
                @endphp
                @forelse($kategoriMap as $kategori => $mapels)
                    <div class="mb-4">
                        <h3 class="text-md font-semibold text-emerald-700 mb-2 border-b border-emerald-200 pb-1">{{ $kategori }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                            @foreach($mapels as $mapel)
                            <label class="flex items-center space-x-2 p-2 rounded-lg border border-gray-200 hover:bg-emerald-50 transition cursor-pointer">
                                <input type="checkbox" name="mapel_ids[]" value="{{ $mapel->id }}" {{ in_array($mapel->id, old('mapel_ids', [])) ? 'checked' : '' }} class="rounded text-emerald-600 focus:ring-emerald-500">
                                <span class="text-sm text-gray-700">{{ $mapel->nama }}</span>
                                @if($mapel->kode)
                                    <span class="text-xs text-gray-400">({{ $mapel->kode }})</span>
                                @endif
                            </label>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Tidak ada mata pelajaran tersedia.</p>
                @endforelse
                @error('mapel_ids') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mobile-stack">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition w-full sm:w-auto">Simpan KRS</button>
                <a href="{{ route('santri.krs.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg text-sm font-medium transition text-center w-full sm:w-auto">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
