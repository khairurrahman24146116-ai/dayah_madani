@extends('layouts.app')

@section('title', 'Manajemen KRS')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="px-6 py-4 bg-emerald-600">
        <h1 class="text-xl font-bold text-white">Manajemen KRS</h1>
    </div>
    <div class="p-6">
        <form method="GET" class="mb-4 flex items-center space-x-3">
            <label class="text-sm font-medium text-gray-700">Filter Status:</label>
            <select name="status" onchange="this.form.submit()" class="border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                <option value="">Semua</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </form>
        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-emerald-600 text-white">
                        <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Nama Santri</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">NIS</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Kelas</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Tahun Ajaran</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold">Status</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($krsList as $i => $krs)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $krsList->firstItem() + $i }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $krs->santri->nama_lengkap ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $krs->santri->nis ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $krs->kelas->nama ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $krs->tahunAjaran->nama ?? $krs->tahun_ajaran ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-center">
                            @if($krs->status == 'pending')
                                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-medium">Pending</span>
                            @elseif($krs->status == 'disetujui')
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">Disetujui</span>
                            @elseif($krs->status == 'ditolak')
                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-medium">Ditolak</span>
                            @else
                                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs font-medium">{{ $krs->status }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-center space-x-1">
                            <a href="{{ route('admin.krs.show', $krs->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition inline-block">Detail</a>
                            @if($krs->status == 'pending')
                                <form action="{{ route('admin.krs.approve', $krs->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition">Setuju</button>
                                </form>
                                <form action="{{ route('admin.krs.reject', $krs->id) }}" method="POST" class="inline" onsubmit="return confirm('Tolak KRS ini?')">
                                    @csrf
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition">Tolak</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">Belum ada data KRS.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $krsList->links() }}
        </div>
    </div>
</div>
@endsection
