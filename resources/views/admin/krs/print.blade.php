@php $hideNavbar = true; $hideSidebar = true; @endphp
@extends('layouts.app')
@section('title', 'Cetak KRS')
@section('content')
<div class="print-area max-w-4xl mx-auto bg-white p-8">
    <div class="text-center mb-8 border-b-2 border-emerald-800 pb-4">
        <h1 class="text-2xl font-bold text-emerald-800">LPI Madani Al-Aziziyah</h1>
        <p class="text-sm text-gray-600">Kartu Rencana Studi (KRS)</p>
    </div>

    <div class="mb-6">
        <table class="w-full text-sm">
            <tr><td class="font-semibold w-32">Nama Santri</td><td>: {{ $krs->santri->nama_lengkap ?? '-' }}</td></tr>
            <tr><td class="font-semibold">NIS</td><td>: {{ $krs->santri->nis ?? '-' }}</td></tr>
            <tr><td class="font-semibold">Kelas</td><td>: {{ $krs->kelas->nama ?? '-' }}</td></tr>
            <tr><td class="font-semibold">Tingkat</td><td>: {{ $krs->kelas->tingkat->nama ?? '-' }}</td></tr>
            <tr><td class="font-semibold">Tahun Ajaran</td><td>: {{ $krs->tahunAjaran->nama ?? '-' }}</td></tr>
            <tr><td class="font-semibold">Status</td><td>: {{ ucfirst($krs->status) }}</td></tr>
            @if($krs->catatan)
            <tr><td class="font-semibold">Catatan</td><td>: {{ $krs->catatan }}</td></tr>
            @endif
        </table>
    </div>

    <h2 class="text-md font-bold text-emerald-700 mb-2 border-b border-emerald-200 pb-1">Mata Pelajaran</h2>
    <table class="w-full border-collapse text-sm">
        <thead>
            <tr class="bg-emerald-700 text-white">
                <th class="border border-gray-300 px-3 py-2 text-left">No</th>
                <th class="border border-gray-300 px-3 py-2 text-left">Kode</th>
                <th class="border border-gray-300 px-3 py-2 text-left">Nama Mapel</th>
                <th class="border border-gray-300 px-3 py-2 text-left">Kategori</th>
            </tr>
        </thead>
        <tbody>
            @forelse($krs->krsDetails as $j => $detail)
            <tr>
                <td class="border border-gray-300 px-3 py-2">{{ $j + 1 }}</td>
                <td class="border border-gray-300 px-3 py-2">{{ $detail->mapel->kode ?? '-' }}</td>
                <td class="border border-gray-300 px-3 py-2">{{ $detail->mapel->nama ?? '-' }}</td>
                <td class="border border-gray-300 px-3 py-2">{{ $detail->mapel->kategori ?? '-' }}</td>
            </tr>
            @empty
            <tr><td colspan="4" class="border border-gray-300 px-3 py-4 text-center text-gray-500">Belum ada mata pelajaran.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-8 grid grid-cols-2 gap-16">
        <div><p class="text-sm font-semibold border-t border-gray-400 pt-1 text-center mt-16">Santri</p></div>
        <div><p class="text-sm font-semibold border-t border-gray-400 pt-1 text-center mt-16">Wali Kelas</p></div>
    </div>

    <div class="mt-4 text-right text-sm text-gray-600 border-t pt-4">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</div>
<div class="text-center mt-4 no-print">
    <button onclick="window.print()" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition">Cetak / Simpan PDF</button>
    <a href="{{ route('admin.krs.show', $krs->id) }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg text-sm font-medium transition ml-2">Kembali</a>
</div>
@push('styles')
<style>
@media print { body { background: white !important; } .print-area { box-shadow: none !important; padding: 0 !important; } }
</style>
@endpush
@endsection