@extends('layouts.app')
@section('title', 'Dashboard Guru')
@section('content')
<div class="mb-6 sm:mb-8">
    <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Dashboard Guru</h1>
    <p class="text-gray-500 text-sm mt-1">Selamat datang, {{ $guru->nama_lengkap ?? Auth::user()->name }}</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 border border-gray-100 flex items-center space-x-3 sm:space-x-4">
        <div class="w-10 h-10 sm:w-14 sm:h-14 bg-emerald-100 rounded-xl flex items-center justify-center text-xl sm:text-2xl">🏛️</div>
        <div>
            <p class="text-gray-500 text-xs sm:text-sm">Kelas Ajar</p>
            <p class="text-xl sm:text-3xl font-bold text-gray-800">{{ $jumlahKelas ?? 0 }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 border border-gray-100 flex items-center space-x-3 sm:space-x-4">
        <div class="w-10 h-10 sm:w-14 sm:h-14 bg-blue-100 rounded-xl flex items-center justify-center text-xl sm:text-2xl">👦</div>
        <div>
            <p class="text-gray-500 text-xs sm:text-sm">Jumlah Santri</p>
            <p class="text-xl sm:text-3xl font-bold text-gray-800">{{ $jumlahSantri ?? 0 }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 border border-gray-100 flex items-center space-x-3 sm:space-x-4">
        <div class="w-10 h-10 sm:w-14 sm:h-14 bg-amber-100 rounded-xl flex items-center justify-center text-xl sm:text-2xl">📖</div>
        <div>
            <p class="text-gray-500 text-xs sm:text-sm">Total Mapel</p>
            <p class="text-xl sm:text-3xl font-bold text-gray-800">{{ $jadwal->flatten()->unique('mapel_id')->count() ?? 0 }}</p>
        </div>
    </div>
</div>

@foreach($jadwal as $hari => $jadwalHari)
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
    <div class="px-4 sm:px-6 py-4 border-b border-gray-100">
        <h2 class="text-lg font-semibold text-gray-800">Jadwal {{ $hari }}</h2>
    </div>
    <div class="table-responsive">
        <table class="w-full table-card">
            <thead>
                <tr class="bg-gray-50 text-left text-sm font-semibold text-gray-600">
                    <th class="px-6 py-3">Mapel</th>
                    <th class="px-6 py-3">Kelas</th>
                    <th class="px-6 py-3">Jam</th>
                    <th class="px-6 py-3">Ruangan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse($jadwalHari as $j)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-3 font-medium text-gray-800" data-label="Mapel">{{ $j->mapel->nama ?? '-' }}</td>
                    <td class="px-6 py-3 text-gray-600" data-label="Kelas">{{ $j->kelas->nama ?? '-' }}</td>
                    <td class="px-6 py-3 text-gray-600" data-label="Jam">{{ $j->jam_mulai ?? '-' }} - {{ $j->jam_selesai ?? '-' }}</td>
                    <td class="px-6 py-3 text-gray-600" data-label="Ruangan">{{ $j->ruangan ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-400 empty-card">Tidak ada jadwal</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endforeach
@endsection
