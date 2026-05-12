@extends('layouts.app')
@section('title', 'Dashboard Santri')
@section('content')
<div class="mb-6 sm:mb-8">
    <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Dashboard Santri</h1>
    <p class="text-gray-500 text-sm mt-1">Selamat datang, {{ $santri->nama_lengkap ?? Auth::user()->name }}</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6">
        <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">Informasi Santri</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-gray-500">NIS</p>
                <p class="font-semibold text-gray-800">{{ $santri->nis ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-500">Nama</p>
                <p class="font-semibold text-gray-800">{{ $santri->nama_lengkap ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-500">Tingkat</p>
                <p class="font-semibold text-gray-800">{{ $santri->tingkat->nama ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-500">Kelas</p>
                <p class="font-semibold text-gray-800">{{ $krs->kelas->nama ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-500">Status</p>
                <p class="font-semibold"><span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-full text-xs">{{ $santri->status ?? '-' }}</span></p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6">
        <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">Status KRS</h2>
        @php
            $statusKrs = $krs ? $krs->status : 'belum';
            $statusMap = [
                'belum' => ['text' => 'Belum Mengisi', 'class' => 'bg-gray-100 text-gray-600'],
                'pending' => ['text' => 'Menunggu Verifikasi', 'class' => 'bg-amber-100 text-amber-700'],
                'disetujui' => ['text' => 'Disetujui', 'class' => 'bg-emerald-100 text-emerald-700'],
                'ditolak' => ['text' => 'Ditolak', 'class' => 'bg-red-100 text-red-700'],
            ];
            $statusInfo = $statusMap[$statusKrs] ?? $statusMap['belum'];
        @endphp
        <div class="flex flex-col items-center justify-center py-6">
            <div class="text-4xl mb-3">
                @if($statusKrs === 'disetujui') &#x2705;
                @elseif($statusKrs === 'pending') &#x23F3;
                @elseif($statusKrs === 'ditolak') &#x274C;
                @else &#x1F4CB;
                @endif
            </div>
            <span class="px-3 py-1.5 rounded-full text-sm font-medium {{ $statusInfo['class'] }}">
                {{ $statusInfo['text'] }}
            </span>
        </div>
    </div>
</div>

@if($krs && $krs->status === 'disetujui')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-8">
    <div class="px-4 sm:px-6 py-4 border-b border-gray-100">
        <h2 class="text-base sm:text-lg font-semibold text-gray-800">Jadwal Pelajaran</h2>
    </div>
    <div class="p-4">
        @foreach($jadwal as $hari => $jadwalHari)
        <div class="mb-4">
            <h3 class="font-semibold text-gray-700 mb-2 text-sm">{{ $hari }}</h3>
            <div class="table-responsive">
                <table class="w-full text-sm table-card">
                    <thead>
                        <tr class="bg-gray-50 text-left text-xs font-semibold text-gray-600">
                            <th class="px-4 py-2">Mapel</th>
                            <th class="px-4 py-2">Guru</th>
                            <th class="px-4 py-2">Jam</th>
                            <th class="px-4 py-2">Ruangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($jadwalHari as $j)
                        <tr>
                            <td class="px-4 py-2 font-medium" data-label="Mapel">{{ $j->mapel->nama ?? '-' }}</td>
                            <td class="px-4 py-2" data-label="Guru">{{ $j->guru->nama_lengkap ?? $j->guru->user->name ?? '-' }}</td>
                            <td class="px-4 py-2" data-label="Jam">{{ $j->jam_mulai ?? '-' }} - {{ $j->jam_selesai ?? '-' }}</td>
                            <td class="px-4 py-2" data-label="Ruangan">{{ $j->ruangan ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="px-4 py-4 text-center text-gray-400 empty-card">Tidak ada jadwal</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-4 sm:px-6 py-4 border-b border-gray-100">
        <h2 class="text-base sm:text-lg font-semibold text-gray-800">Ringkasan Nilai</h2>
    </div>
    <div class="p-4 sm:p-6">
        @php $rataNilai = $nilai->avg('nilai_akhir'); @endphp
        @if($rataNilai)
        <div class="flex items-center space-x-4">
            <div class="w-20 h-20 rounded-full bg-emerald-100 flex items-center justify-center">
                <span class="text-2xl font-bold text-emerald-700">{{ number_format($rataNilai, 1) }}</span>
            </div>
            <div>
                <p class="text-gray-700 font-medium">Rata-rata Nilai</p>
                <p class="text-sm text-gray-500">Semua mata pelajaran</p>
            </div>
        </div>
        @else
        <p class="text-gray-400 text-center py-4">Belum ada data nilai</p>
        @endif
    </div>
</div>
@endsection
