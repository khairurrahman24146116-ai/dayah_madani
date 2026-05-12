@extends('layouts.app')

@section('title', 'Detail KRS')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="px-6 py-4 bg-emerald-600">
        <h1 class="text-xl font-bold text-white">Detail KRS</h1>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 p-4 bg-gray-50 rounded-lg">
            <div>
                <p class="text-sm text-gray-500">Nama Santri</p>
                <p class="text-sm font-medium text-gray-800">{{ $krs->santri->nama_lengkap ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">NIS</p>
                <p class="text-sm font-medium text-gray-800">{{ $krs->santri->nis ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Kelas</p>
                <p class="text-sm font-medium text-gray-800">{{ $krs->kelas->nama ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Tahun Ajaran</p>
                <p class="text-sm font-medium text-gray-800">{{ $krs->tahunAjaran->nama ?? $krs->tahun_ajaran ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Status</p>
                <p>
                    @if($krs->status == 'pending')
                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-medium">Pending</span>
                    @elseif($krs->status == 'disetujui')
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">Disetujui</span>
                    @elseif($krs->status == 'ditolak')
                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-medium">Ditolak</span>
                    @else
                        <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs font-medium">{{ $krs->status }}</span>
                    @endif
                </p>
            </div>
        </div>

        <h2 class="text-lg font-semibold text-gray-800 mb-3">Mata Pelajaran yang Diambil</h2>
        <div class="overflow-x-auto mb-6">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-emerald-600 text-white">
                        <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Kode Mapel</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Nama Mapel</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Kategori</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($krs->krsDetails as $i => $mapel)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $i + 1 }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $mapel->kode ?? $mapel->mapel->kode ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $mapel->nama ?? $mapel->mapel->nama ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $mapel->kategori ?? $mapel->mapel->kategori ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">Belum ada mata pelajaran.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($krs->status == 'pending')
        <div class="border-t pt-4">
            <div class="flex items-center space-x-3">
                <form action="{{ route('admin.krs.approve', $krs->id) }}" method="POST" class="inline">
                    @csrf
                    <div class="mb-3">
                        <label for="catatan_setuju" class="block text-sm font-medium text-gray-700 mb-1">Catatan (opsional)</label>
                        <textarea name="catatan" id="catatan_setuju" rows="2" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Catatan persetujuan..."></textarea>
                    </div>
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg text-sm font-medium transition">Setujui KRS</button>
                </form>
                <form action="{{ route('admin.krs.reject', $krs->id) }}" method="POST" class="inline" onsubmit="return confirm('Tolak KRS ini?')">
                    @csrf
                    <div class="mb-3">
                        <label for="catatan_tolak" class="block text-sm font-medium text-gray-700 mb-1">Catatan (opsional)</label>
                        <textarea name="catatan" id="catatan_tolak" rows="2" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Alasan penolakan..."></textarea>
                    </div>
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg text-sm font-medium transition">Tolak KRS</button>
                </form>
            </div>
        </div>
        @endif

        <div class="mt-6 flex items-center space-x-3">
            <a href="{{ route('admin.krs.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg text-sm font-medium transition">Kembali</a>
            <a href="{{ route('admin.krs.print', $krs->id) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition">Cetak PDF</a>
        </div>
    </div>
</div>
@endsection
