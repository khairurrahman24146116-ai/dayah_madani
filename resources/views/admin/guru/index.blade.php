@extends('layouts.app')

@section('title', 'Data Guru')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="px-4 sm:px-6 py-4 bg-emerald-600 header-wrap">
        <h1 class="text-lg sm:text-xl font-bold text-white">Data Guru</h1>
        <a href="{{ route('admin.guru.create') }}" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition whitespace-nowrap">+ Tambah Guru</a>
    </div>
    <div class="p-4 sm:p-6">
        <div class="table-responsive">
            <table class="w-full table-auto border-collapse table-card">
                <thead>
                    <tr class="bg-emerald-600 text-white">
                        <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">NIP</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Nama</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Tempat Lahir</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">No Telp</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($gurus as $i => $guru)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-700" data-label="No">{{ $gurus->firstItem() + $i }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700" data-label="NIP">{{ $guru->nip }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700" data-label="Nama">{{ $guru->nama_lengkap }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700" data-label="Tempat Lahir">{{ $guru->tempat_lahir }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700" data-label="No Telp">{{ $guru->no_telp ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-center" data-label="Aksi">
                            <div class="btn-group-mobile">
                                <a href="{{ route('admin.guru.edit', $guru->id) }}" class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition inline-block">Edit</a>
                                <form action="{{ route('admin.guru.destroy', $guru->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data guru ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500 empty-card">Belum ada data guru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4 overflow-x-auto">
            {{ $gurus->links() }}
        </div>
    </div>
</div>
@endsection
