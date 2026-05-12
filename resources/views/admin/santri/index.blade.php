@extends('layouts.app')

@section('title', 'Data Santri')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="px-4 sm:px-6 py-4 bg-emerald-600 header-wrap">
        <h1 class="text-lg sm:text-xl font-bold text-white">Data Santri</h1>
        <a href="{{ route('admin.santri.create') }}" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition whitespace-nowrap">+ Tambah Santri</a>
    </div>
    <div class="p-4 sm:p-6">
        <form method="GET" class="filter-wrap mb-4">
            <label class="text-sm font-medium text-gray-700">Filter Tingkat:</label>
            <select name="tingkat_id" onchange="this.form.submit()" class="border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 w-full sm:w-auto">
                <option value="">Semua Tingkat</option>
                @foreach($tingkats as $tingkat)
                    <option value="{{ $tingkat->id }}" {{ request('tingkat_id') == $tingkat->id ? 'selected' : '' }}>{{ $tingkat->nama }}</option>
                @endforeach
            </select>
        </form>
        <div class="table-responsive">
            <table class="w-full table-auto border-collapse table-card">
                <thead>
                    <tr class="bg-emerald-600 text-white">
                        <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">NIS</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Nama</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Tingkat</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Jenis Kelamin</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold">Status</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($santris as $i => $santri)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-700" data-label="No">{{ $santris->firstItem() + $i }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700" data-label="NIS">{{ $santri->nis }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700" data-label="Nama">{{ $santri->nama_lengkap }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700" data-label="Tingkat">{{ $santri->tingkat->nama ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700" data-label="JK">{{ $santri->jenis_kelamin }}</td>
                        <td class="px-4 py-3 text-sm text-center" data-label="Status">
                            @if($santri->status == 'aktif')
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">Aktif</span>
                            @elseif($santri->status == 'lulus')
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">Lulus</span>
                            @elseif($santri->status == 'keluar')
                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-medium">Keluar</span>
                            @else
                                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs font-medium">{{ $santri->status ?? 'Aktif' }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-center" data-label="Aksi">
                            <div class="btn-group-mobile">
                                <a href="{{ route('admin.santri.edit', $santri->id) }}" class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition inline-block">Edit</a>
                                <form action="{{ route('admin.santri.destroy', $santri->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data santri ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500 empty-card">Belum ada data santri.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4 overflow-x-auto">
            {{ $santris->links() }}
        </div>
    </div>
</div>
@endsection
