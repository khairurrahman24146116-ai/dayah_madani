@extends('layouts.app')
@section('title', 'Dashboard Guru')
@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-800">Dashboard Guru</h1>
    <p class="text-gray-500 text-sm mt-1">Selamat datang, {{ $guru->nama_lengkap ?? Auth::user()->name }}</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center space-x-4">
        <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center text-2xl">🏛️</div>
        <div>
            <p class="text-gray-500 text-sm">Kelas Ajar</p>
            <p class="text-3xl font-bold text-gray-800">{{ $jumlahKelas ?? 0 }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center space-x-4">
        <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-2xl">👦</div>
        <div>
            <p class="text-gray-500 text-sm">Jumlah Santri</p>
            <p class="text-3xl font-bold text-gray-800">{{ $jumlahSantri ?? 0 }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center space-x-4">
        <div class="w-14 h-14 bg-amber-100 rounded-xl flex items-center justify-center text-2xl">📖</div>
        <div>
            <p class="text-gray-500 text-sm">Total Mapel</p>
            <p class="text-3xl font-bold text-gray-800">{{ $jadwal->flatten()->unique('mapel_id')->count() ?? 0 }}</p>
        </div>
    </div>
</div>

@foreach($jadwal as $hari => $jadwalHari)
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-gray-100">
        <h2 class="text-lg font-semibold text-gray-800">Jadwal {{ $hari }}</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
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
                    <td class="px-6 py-3 font-medium text-gray-800">{{ $j->mapel->nama ?? '-' }}</td>
                    <td class="px-6 py-3 text-gray-600">{{ $j->kelas->nama ?? '-' }}</td>
                    <td class="px-6 py-3 text-gray-600">{{ $j->jam_mulai ?? '-' }} - {{ $j->jam_selesai ?? '-' }}</td>
                    <td class="px-6 py-3 text-gray-600">{{ $j->ruangan ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-400">Tidak ada jadwal</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endforeach
@endsection
