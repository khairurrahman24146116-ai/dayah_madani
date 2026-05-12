@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('content')
<div class="mb-6 sm:mb-8">
    <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Dashboard Admin</h1>
    <p class="text-gray-500 text-sm mt-1">Selamat datang, {{ Auth::user()->name }}</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 border border-gray-100 flex items-center space-x-3 sm:space-x-4">
        <div class="w-10 h-10 sm:w-14 sm:h-14 bg-emerald-100 rounded-xl flex items-center justify-center text-xl sm:text-2xl">👦</div>
        <div>
            <p class="text-gray-500 text-xs sm:text-sm">Total Santri</p>
            <p class="text-xl sm:text-3xl font-bold text-gray-800">{{ $totalSantri ?? 0 }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 border border-gray-100 flex items-center space-x-3 sm:space-x-4">
        <div class="w-10 h-10 sm:w-14 sm:h-14 bg-blue-100 rounded-xl flex items-center justify-center text-xl sm:text-2xl">👨‍🏫</div>
        <div>
            <p class="text-gray-500 text-xs sm:text-sm">Total Guru</p>
            <p class="text-xl sm:text-3xl font-bold text-gray-800">{{ $totalGuru ?? 0 }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 border border-gray-100 flex items-center space-x-3 sm:space-x-4">
        <div class="w-10 h-10 sm:w-14 sm:h-14 bg-amber-100 rounded-xl flex items-center justify-center text-xl sm:text-2xl">🏛️</div>
        <div>
            <p class="text-gray-500 text-xs sm:text-sm">Total Kelas</p>
            <p class="text-xl sm:text-3xl font-bold text-gray-800">{{ $totalKelas ?? 0 }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 border border-gray-100 flex items-center space-x-3 sm:space-x-4">
        <div class="w-10 h-10 sm:w-14 sm:h-14 bg-purple-100 rounded-xl flex items-center justify-center text-xl sm:text-2xl">📖</div>
        <div>
            <p class="text-gray-500 text-xs sm:text-sm">Total Mapel</p>
            <p class="text-xl sm:text-3xl font-bold text-gray-800">{{ $totalMapel ?? 0 }}</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 border border-gray-100">
        <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-2">KRS Pending</h2>
        <p class="text-3xl sm:text-4xl font-bold text-amber-600">{{ $krsPending ?? 0 }}</p>
        <p class="text-sm text-gray-500 mt-1">Menunggu verifikasi</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 border border-gray-100">
        <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h2>
        <div class="grid grid-cols-2 gap-3">
            <a href="{{ route('admin.guru.create') }}" class="bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg p-3 text-sm font-medium text-center transition">+ Guru</a>
            <a href="{{ route('admin.santri.create') }}" class="bg-emerald-50 hover:bg-emerald-100 text-emerald-700 rounded-lg p-3 text-sm font-medium text-center transition">+ Santri</a>
            <a href="{{ route('admin.kelas.create') }}" class="bg-amber-50 hover:bg-amber-100 text-amber-700 rounded-lg p-3 text-sm font-medium text-center transition">+ Kelas</a>
            <a href="{{ route('admin.mapel.create') }}" class="bg-purple-50 hover:bg-purple-100 text-purple-700 rounded-lg p-3 text-sm font-medium text-center transition">+ Mapel</a>
        </div>
    </div>
</div>
@endsection
