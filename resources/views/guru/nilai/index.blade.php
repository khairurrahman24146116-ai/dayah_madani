@extends('layouts.app')

@section('title', 'Penilaian')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="px-6 py-4 bg-emerald-600">
        <h1 class="text-xl font-bold text-white">Penilaian</h1>
    </div>
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-emerald-600 text-white">
                        <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Kelas</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Mapel</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold">Jumlah Santri Dinilai</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($kelasMapel as $i => $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $i + 1 }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $item->kelas->nama ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $item->mapel->nama ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-center text-gray-700">-</td>
                        <td class="px-4 py-3 text-sm text-center">
                            <a href="{{ route('guru.nilai.create', [$item->kelas_id, $item->mapel_id]) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">Input Nilai</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada kelas atau mapel yang diampu.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
