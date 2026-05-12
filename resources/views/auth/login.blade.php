@php $hideNavbar = true; $hideSidebar = true; @endphp
@extends('layouts.app')

@section('title', 'Masuk - LPI Madani Al-Aziziyah')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-emerald-800 via-emerald-700 to-amber-800 px-4">
    <div class="w-full max-w-md mx-3 sm:mx-0">
        <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8">
            <div class="text-center mb-6 sm:mb-8">
                <div class="text-4xl sm:text-5xl mb-3">🏫</div>
                <h1 class="text-xl sm:text-2xl font-bold text-emerald-800">LPI Madani Al-Aziziyah</h1>
                <p class="text-gray-500 text-xs sm:text-sm mt-1">Masuk ke sistem informasi pesantren</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4 sm:mb-5">
                    <label for="nis_or_nip" class="block text-sm font-medium text-gray-700 mb-1">NIS / NIP</label>
                    <input id="nis_or_nip" type="text" name="nis_or_nip" value="{{ old('nis_or_nip') }}" required autofocus
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition text-sm sm:text-base @error('nis_or_nip') border-red-500 @enderror"
                        placeholder="Masukkan NIS atau NIP">
                    @error('nis_or_nip')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5 sm:mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition text-sm sm:text-base @error('password') border-red-500 @enderror"
                        placeholder="Masukkan kata sandi">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                @error('login')
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-3 rounded-r-lg mb-4 sm:mb-5 text-sm">
                        {{ $message }}
                    </div>
                @enderror

                <button type="submit"
                    class="w-full bg-emerald-700 hover:bg-emerald-800 text-white font-semibold py-2.5 px-4 rounded-lg transition duration-200 shadow-md hover:shadow-lg text-sm sm:text-base">
                    Masuk
                </button>
            </form>

            <div class="mt-5 sm:mt-6 text-center">
                <p class="text-xs text-gray-400">&copy; {{ date('Y') }} LPI Madani Al-Aziziyah</p>
            </div>
        </div>
    </div>
</div>
@endsection
