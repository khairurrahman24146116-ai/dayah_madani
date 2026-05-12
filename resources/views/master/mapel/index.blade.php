@extends('layouts.app')

@section('title', 'Data Mata Pelajaran')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="px-6 py-4 bg-emerald-600 flex justify-between items-center">
        <h1 class="text-xl font-bold text-white">Data Mata Pelajaran</h1>
        <a href="{{ route('admin.mapel.create') }}" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">+ Tambah Mapel</a>
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
                        <th class="px-4 py-3 text-left text-sm font-semibold">Tingkat</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Kategori</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($data as $i => $mapel)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $data->firstItem() + $i }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $mapel->kode }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $mapel->nama }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $mapel->tingkat->nama ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">
                            @if($mapel->kategori == 'salafi')
                                <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs">Salafi</span>
                            @elseif($mapel->kategori == 'umum')
                                <span class="bg-green-100 text-green-800 px-2 py-0.5 rounded text-xs">Umum</span>
                            @elseif($mapel->kategori == 'pondok')
                                <span class="bg-purple-100 text-purple-800 px-2 py-0.5 rounded text-xs">Pondok</span>
                            @else
                                <span class="bg-gray-100 text-gray-800 px-2 py-0.5 rounded text-xs">{{ $mapel->kategori }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-center">
                            <a href="{{ route('admin.mapel.edit', $mapel->id) }}" class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition inline-block">Edit</a>
                            <form action="{{ route('admin.mapel.destroy', $mapel->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">Belum ada data mata pelajaran.</td>
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
