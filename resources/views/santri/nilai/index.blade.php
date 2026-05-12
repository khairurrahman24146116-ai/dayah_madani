@extends('layouts.app')

@section('title', 'Nilai Saya')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="px-4 sm:px-6 py-4 bg-emerald-600 header-wrap">
        <h1 class="text-lg sm:text-xl font-bold text-white">Nilai Saya</h1>
        <a href="{{ route('santri.nilai.print') }}" class="bg-white text-emerald-700 hover:bg-emerald-50 px-4 py-2 rounded-lg text-sm font-medium transition whitespace-nowrap">Cetak PDF</a>
    </div>
    <div class="p-4 sm:p-6">
        @forelse($nilais as $group => $items)
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-emerald-700 mb-2 border-b border-emerald-200 pb-1">{{ $group }}</h2>
                <div class="table-responsive">
                    <table class="w-full table-auto border-collapse table-card">
                        <thead>
                            <tr class="bg-emerald-600 text-white">
                                <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold">Mapel</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold">Nilai Tugas</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold">Nilai UTS</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold">Nilai UAS</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold">Nilai Akhir</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold">Predikat</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($items as $i => $nilai)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-sm text-gray-700" data-label="No">{{ $i + 1 }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700" data-label="Mapel">{{ $nilai->mapel->nama ?? $nilai->nama_mapel ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm text-center text-gray-700" data-label="N. Tugas">{{ $nilai->nilai_tugas ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm text-center text-gray-700" data-label="N. UTS">{{ $nilai->nilai_uts ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm text-center text-gray-700" data-label="N. UAS">{{ $nilai->nilai_uas ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm text-center font-semibold text-gray-800" data-label="N. Akhir">
                                    @php
                                        $akhir = (($nilai->nilai_tugas ?? 0) + ($nilai->nilai_uts ?? 0) + ($nilai->nilai_uas ?? 0)) / 3;
                                    @endphp
                                    {{ number_format($akhir, 0) }}
                                </td>
                                <td class="px-4 py-3 text-sm text-center" data-label="Predikat">
                                    @php
                                        $akhir = (($nilai->nilai_tugas ?? 0) + ($nilai->nilai_uts ?? 0) + ($nilai->nilai_uas ?? 0)) / 3;
                                        if ($akhir >= 85) $pred = 'A';
                                        elseif ($akhir >= 75) $pred = 'B';
                                        elseif ($akhir >= 60) $pred = 'C';
                                        elseif ($akhir >= 50) $pred = 'D';
                                        else $pred = 'E';
                                    @endphp
                                    <span class="px-2 py-0.5 rounded text-xs font-semibold
                                        @if($pred == 'A') bg-green-100 text-green-800
                                        @elseif($pred == 'B') bg-blue-100 text-blue-800
                                        @elseif($pred == 'C') bg-yellow-100 text-yellow-800
                                        @elseif($pred == 'D') bg-orange-100 text-orange-800
                                        @else bg-red-100 text-red-800 @endif
                                    ">{{ $pred }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500 py-8">
                <p class="text-lg">Belum ada data nilai.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
