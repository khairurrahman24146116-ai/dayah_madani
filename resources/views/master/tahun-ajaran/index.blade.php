@extends('layouts.app')

@section('title', 'Data Tahun Ajaran')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="px-4 sm:px-6 py-4 bg-emerald-600 header-wrap">
        <h1 class="text-lg sm:text-xl font-bold text-white">Data Tahun Ajaran</h1>
        <a href="{{ route('admin.tahun-ajaran.create') }}" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition whitespace-nowrap">+ Tambah Tahun Ajaran</a>
    </div>
    <div class="p-4 sm:p-6">
        <div class="table-responsive">
            <table class="w-full table-auto border-collapse table-card">
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
                        <td class="px-4 py-3 text-sm text-gray-700" data-label="No">{{ $data->firstItem() + $i }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700" data-label="Kode">{{ $ta->kode }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700" data-label="Nama">{{ $ta->nama }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700" data-label="Semester">{{ ucfirst($ta->semester) }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700" data-label="Tgl Mulai">{{ \Carbon\Carbon::parse($ta->tanggal_mulai)->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700" data-label="Tgl Selesai">{{ \Carbon\Carbon::parse($ta->tanggal_selesai)->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-sm text-center" data-label="Status">
                            @if($ta->status)
                                <span class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-xs font-medium">Aktif</span>
                            @else
                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-medium">Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-center" data-label="Aksi">
                            <div class="btn-group-mobile">
                                <a href="{{ route('admin.tahun-ajaran.edit', $ta->id) }}" class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition inline-block">Edit</a>
                                <form action="{{ route('admin.tahun-ajaran.destroy', $ta->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-4 py-6 text-center text-gray-500 empty-card">Belum ada data tahun ajaran.</td>
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
