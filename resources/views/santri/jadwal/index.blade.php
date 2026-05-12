@extends('layouts.app')

@section('title', 'Jadwal Pelajaran Saya')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="px-6 py-4 bg-emerald-600">
        <h1 class="text-xl font-bold text-white">Jadwal Pelajaran Saya</h1>
    </div>
    <div class="p-6">
        @php
            $hariMap = ['Senin' => [], 'Selasa' => [], 'Rabu' => [], 'Kamis' => [], "Jum'at" => [], 'Sabtu' => [], 'Ahad' => []];
            foreach ($jadwals as $j) {
                $hari = $j->hari ?? '';
                $hariMap[$hari][] = $j;
            }
        @endphp

        @forelse($hariMap as $hari => $items)
            @if(count($items) > 0)
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-emerald-700 mb-2 border-b border-emerald-200 pb-1">{{ $hari }}</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border-collapse">
                            <thead>
                                <tr class="bg-emerald-600 text-white">
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Jam</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Mapel</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Guru</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Ruangan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($items as $jadwal)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        {{ $jadwal->jam_mulai ? \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') : '-' }} - {{ $jadwal->jam_selesai ? \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') : '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $jadwal->mapel->nama ?? $jadwal->nama_mapel ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $jadwal->guru->nama_lengkap ?? $jadwal->nama_guru ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $jadwal->ruangan ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @empty
            <div class="text-center text-gray-500 py-6">Belum ada jadwal pelajaran.</div>
        @endforelse

        @if(count($jadwals) > 0 && empty(array_filter($hariMap, fn($v) => count($v) > 0)))
            <div class="text-center text-gray-500 py-6">Belum ada jadwal pelajaran.</div>
        @endif
    </div>
</div>
@endsection
