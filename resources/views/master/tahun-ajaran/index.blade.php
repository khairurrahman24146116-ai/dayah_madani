@extends('layouts.app')

@section('title', 'Data Tahun Ajaran')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="px-6 py-4 bg-emerald-600 flex justify-between items-center">
        <h1 class="text-xl font-bold text-white">Data Tahun Ajaran</h1>
        <a href="{{ route('admin.tahun-ajaran.create') }}" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">+ Tambah Tahun Ajaran</a>
    </div>
    <div class="p-6">
        @if(session('success'))
            <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-800 p-4 mb-6 rounded-r-lg flex items-center justify-between shadow-sm">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800 text-xl leading-none">&times;</button>
            </div>
        @endif
        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse bg-white shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-emerald-600 text-white">
                        <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Kode</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Nama</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Semester</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Tgl Mulai</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Tgl Selesai</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold">Status</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($data as $i => $ta)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $data->firstItem() + $i }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $ta->kode }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $ta->nama }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ ucfirst($ta->semester) }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ \Carbon\Carbon::parse($ta->tanggal_mulai)->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ \Carbon\Carbon::parse($ta->tanggal_selesai)->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-sm text-center">
                            @if($ta->status)
                                <span class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-xs font-medium">Aktif</span>
                            @else
                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-medium">Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-center">
                            <a href="{{ route('admin.tahun-ajaran.edit', $ta->id) }}" class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition inline-block">Edit</a>
                            <form action="{{ route('admin.tahun-ajaran.destroy', $ta->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-4 py-6 text-center text-gray-500">Belum ada data tahun ajaran.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $data->links() }}
        </div>
    </div>
</div>
@endsection
