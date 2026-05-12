@php $hideNavbar = true; $hideSidebar = true; @endphp
@extends('layouts.app')
@section('title', 'Cetak Nilai')
@section('content')
<div class="print-area max-w-4xl mx-auto bg-white p-8">
    <div class="text-center mb-8 border-b-2 border-emerald-800 pb-4">
        <h1 class="text-2xl font-bold text-emerald-800">LPI Madani Al-Aziziyah</h1>
        <p class="text-sm text-gray-600">Laporan Nilai Santri</p>
    </div>

    <div class="mb-6">
        <table class="w-full text-sm">
            <tr><td class="font-semibold w-32">Nama</td><td>: {{ $santri->nama_lengkap ?? Auth::user()->name }}</td></tr>
            <tr><td class="font-semibold">NIS</td><td>: {{ $santri->nis ?? '-' }}</td></tr>
            <tr><td class="font-semibold">Tingkat</td><td>: {{ $santri->tingkat->nama ?? '-' }}</td></tr>
        </table>
    </div>

    @forelse($nilais as $group => $items)
        <div class="mb-6">
            <h2 class="text-md font-bold text-emerald-700 mb-2 border-b border-emerald-200 pb-1">{{ $group }}</h2>
            <table class="w-full border-collapse text-sm">
                <thead>
                    <tr class="bg-emerald-700 text-white">
                        <th class="border border-gray-300 px-3 py-2 text-left">No</th>
                        <th class="border border-gray-300 px-3 py-2 text-left">Mapel</th>
                        <th class="border border-gray-300 px-3 py-2 text-center">Tugas</th>
                        <th class="border border-gray-300 px-3 py-2 text-center">UTS</th>
                        <th class="border border-gray-300 px-3 py-2 text-center">UAS</th>
                        <th class="border border-gray-300 px-3 py-2 text-center">Akhir</th>
                        <th class="border border-gray-300 px-3 py-2 text-center">Predikat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $i => $nilai)
                    @php
                        $akhir = (($nilai->nilai_tugas ?? 0) + ($nilai->nilai_uts ?? 0) + ($nilai->nilai_uas ?? 0)) / 3;
                        if ($akhir >= 85) $pred = 'A'; elseif ($akhir >= 75) $pred = 'B'; elseif ($akhir >= 60) $pred = 'C'; elseif ($akhir >= 50) $pred = 'D'; else $pred = 'E';
                    @endphp
                    <tr>
                        <td class="border border-gray-300 px-3 py-2">{{ $i + 1 }}</td>
                        <td class="border border-gray-300 px-3 py-2">{{ $nilai->mapel->nama ?? '-' }}</td>
                        <td class="border border-gray-300 px-3 py-2 text-center">{{ $nilai->nilai_tugas ?? '-' }}</td>
                        <td class="border border-gray-300 px-3 py-2 text-center">{{ $nilai->nilai_uts ?? '-' }}</td>
                        <td class="border border-gray-300 px-3 py-2 text-center">{{ $nilai->nilai_uas ?? '-' }}</td>
                        <td class="border border-gray-300 px-3 py-2 text-center font-bold">{{ number_format($akhir, 0) }}</td>
                        <td class="border border-gray-300 px-3 py-2 text-center font-bold">{{ $pred }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @empty
        <p class="text-center text-gray-500 py-8">Belum ada data nilai.</p>
    @endforelse

    <div class="mt-8 text-right text-sm text-gray-600 border-t pt-4">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</div>
<div class="text-center mt-4 no-print">
    <button onclick="window.print()" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition">Cetak / Simpan PDF</button>
    <a href="{{ route('santri.nilai') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg text-sm font-medium transition ml-2">Kembali</a>
</div>
@push('styles')
<style>
@media print { body { background: white !important; } .print-area { box-shadow: none !important; padding: 0 !important; } table { page-break-inside: auto; } tr { page-break-inside: avoid; } }
</style>
@endpush
@endsection