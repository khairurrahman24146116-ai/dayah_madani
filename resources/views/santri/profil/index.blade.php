@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 bg-emerald-600 text-center">
            <h1 class="text-xl font-bold text-white">Kartu Identitas Santri</h1>
        </div>
        <div class="p-6">
            <div class="flex justify-center mb-6">
                <div class="w-24 h-24 bg-emerald-100 rounded-full flex items-center justify-center text-4xl">
                    👤
                </div>
            </div>

            <div class="border-2 border-emerald-200 rounded-lg p-6 bg-gradient-to-br from-emerald-50 to-white">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-emerald-800">{{ $santri->nama_lengkap }}</h2>
                    <p class="text-sm text-gray-500">NIS: {{ $santri->nis }}</p>
                    @if($santri->nisn)
                        <p class="text-sm text-gray-500">NISN: {{ $santri->nisn }}</p>
                    @endif
                </div>

                <div class="border-t border-emerald-200 pt-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Tempat Lahir</p>
                            <p class="text-sm font-medium text-gray-800">{{ $santri->tempat_lahir ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Tanggal Lahir</p>
                            <p class="text-sm font-medium text-gray-800">{{ $santri->tanggal_lahir ? \Carbon\Carbon::parse($santri->tanggal_lahir)->format('d/m/Y') : '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Alamat</p>
                            <p class="text-sm font-medium text-gray-800">{{ $santri->alamat ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Jenis Kelamin</p>
                            <p class="text-sm font-medium text-gray-800">{{ $santri->jenis_kelamin == 'L' ? 'Laki-laki' : ($santri->jenis_kelamin == 'P' ? 'Perempuan' : '-') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Tingkat</p>
                            <p class="text-sm font-medium text-gray-800">{{ $santri->tingkat->nama ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Nama Wali</p>
                            <p class="text-sm font-medium text-gray-800">{{ $santri->nama_wali ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">No Telp Wali</p>
                            <p class="text-sm font-medium text-gray-800">{{ $santri->no_telp_wali ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 text-center">
                <p class="text-xs text-gray-400">LPI Madani Al-Aziziyah</p>
                <p class="text-xs text-gray-400">Terwujudnya Generasi Berakhlak Mulia, Berilmu, dan Beramal Shaleh</p>
            </div>
        </div>
    </div>
</div>
@endsection
