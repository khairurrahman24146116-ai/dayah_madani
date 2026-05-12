@extends('layouts.app')

@section('title', 'KRS Saya')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="px-4 sm:px-6 py-4 bg-emerald-600 header-wrap">
        <h1 class="text-lg sm:text-xl font-bold text-white">KRS Saya</h1>
        @if($bisaBuatKRS)
            <a href="{{ route('santri.krs.create') }}" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition whitespace-nowrap">+ Buat KRS Baru</a>
        @endif
    </div>
    <div class="p-4 sm:p-6">
        @forelse($krsList as $i => $krs)
        <div class="mb-6 border border-gray-200 rounded-lg overflow-hidden">
                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 header-wrap">
                    <div>
                        <span class="font-semibold text-gray-800">{{ $krs->kelas->nama ?? '-' }}</span>
                        <span class="text-sm text-gray-500 ml-3">{{ $krs->tahunAjaran->nama ?? $krs->tahun_ajaran ?? '-' }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                    @if($krs->status == 'pending')
                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-medium">Pending</span>
                    @elseif($krs->status == 'disetujui')
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">Disetujui</span>
                    @elseif($krs->status == 'ditolak')
                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-medium">Ditolak</span>
                    @else
                        <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs font-medium">{{ $krs->status }}</span>
                    @endif
                    <a href="{{ route('santri.krs.print', $krs->id) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1 rounded-lg text-xs font-medium transition">Cetak</a>
                </div>
            </div>
            <div class="p-4">
                <p class="text-sm text-gray-500 mb-2">Tanggal Buat: {{ $krs->created_at ? \Carbon\Carbon::parse($krs->created_at)->format('d/m/Y H:i') : '-' }}</p>
                @if($krs->catatan)
                    <p class="text-sm text-gray-600 mb-2">Catatan: {{ $krs->catatan }}</p>
                @endif
                <h3 class="text-sm font-semibold text-gray-700 mb-2">Mata Pelajaran:</h3>
                <div class="table-responsive">
                    <table class="w-full table-auto border-collapse table-card">
                        <thead>
                            <tr class="bg-emerald-600 text-white">
                                <th class="px-4 py-2 text-left text-xs font-semibold">No</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold">Kode</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold">Nama Mapel</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold">Kategori</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($krs->krsDetails as $j => $detail)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-2 text-sm text-gray-700" data-label="No">{{ $j + 1 }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700" data-label="Kode">{{ $detail->mapel->kode ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700" data-label="Mapel">{{ $detail->mapel->nama ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700" data-label="Kategori">{{ $detail->mapel->kategori ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-center text-gray-500 empty-card">Belum ada mata pelajaran.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center text-gray-500 py-8">
            <p class="text-lg mb-2">Belum ada data KRS.</p>
            @if($bisaBuatKRS)
                <a href="{{ route('santri.krs.create') }}" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition inline-block">+ Buat KRS Baru</a>
            @else
                <p class="text-sm text-gray-400">KRS sudah pernah dibuat atau tidak eligible.</p>
            @endif
        </div>
        @endforelse
    </div>
</div>
@endsection
