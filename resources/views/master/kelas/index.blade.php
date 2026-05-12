@extends('layouts.app')

@section('title', 'Data Kelas')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="px-4 sm:px-6 py-4 bg-emerald-600 header-wrap">
        <h1 class="text-lg sm:text-xl font-bold text-white">Data Kelas</h1>
        <a href="{{ route('admin.kelas.create') }}" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition whitespace-nowrap">+ Tambah Kelas</a>
    </div>
    <div class="p-4 sm:p-6">
        <div class="table-responsive">
            <table class="w-full table-auto border-collapse table-card">
                <thead>
                    <tr class="bg-emerald-600 text-white">
                        <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Kode</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Nama</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Tingkat</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Jurusan</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($data as $i => $k)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-700" data-label="No">{{ $data->firstItem() + $i }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700" data-label="Kode">{{ $k->kode }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700" data-label="Nama">{{ $k->nama }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700" data-label="Tingkat">{{ $k->tingkat->nama ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700" data-label="Jurusan">{{ $k->jurusan->nama ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-center" data-label="Aksi">
                            <div class="btn-group-mobile">
                                <a href="{{ route('admin.kelas.edit', $k->id) }}" class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition inline-block">Edit</a>
                                <form action="{{ route('admin.kelas.destroy', $k->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500 empty-card">Belum ada data kelas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4 overflow-x-auto">
            {{ $data->links() }}
        </div>
    </div>
</div>
@endsection
