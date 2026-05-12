@php $hideNavbar = true; $hideSidebar = true; @endphp
@extends('layouts.app')

@section('title', 'LPI Madani Al-Aziziyah')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-emerald-900 via-emerald-800 to-amber-900 flex flex-col">
    <div class="flex-1 flex items-center justify-center px-4">
        <div class="text-center max-w-3xl">
            <div class="text-7xl mb-6">🏫</div>
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-4 leading-tight">
                LPI Madani <span class="text-amber-400">Al-Aziziyah</span>
            </h1>
            <div class="w-24 h-1 bg-amber-400 mx-auto mb-6 rounded-full"></div>
            <p class="text-lg md:text-xl text-emerald-100 mb-3 leading-relaxed max-w-2xl mx-auto">
                Lembaga Pendidikan Islam yang mencetak generasi unggul, berakhlak mulia, 
                dan berwawasan luas berdasarkan Al-Qur'an dan Sunnah.
            </p>
            <p class="text-emerald-300 text-sm md:text-base mb-10">
                "Dan tuntutlah ilmu, sesungguhnya ilmu adalah cahaya yang menerangi jalan kehidupan"
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('login') }}"
                    class="bg-amber-500 hover:bg-amber-600 text-white font-semibold px-8 py-3 rounded-xl text-lg shadow-lg hover:shadow-xl transition duration-200">
                    Masuk ke Sistem
                </a>
            </div>
        </div>
    </div>
    <footer class="py-6 text-center text-emerald-300 text-sm border-t border-emerald-700/40">
        <p>&copy; {{ date('Y') }} LPI Madani Al-Aziziyah. All Rights Reserved.</p>
    </footer>
</div>
@endsection
