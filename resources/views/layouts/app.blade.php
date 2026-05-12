<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LPI Madani Al-Aziziyah')</title>
    @vite('resources/css/app.css')
    @stack('styles')
    <style>
        *, *::before, *::after { box-sizing: border-box; }

        @media print { body { visibility: hidden; } .print-area { visibility: visible; position: absolute; left: 0; top: 0; width: 100%; } .print-area * { visibility: visible; } .no-print { display: none !important; } }
        @media (max-width: 1023px) { #sidebar-overlay.active { display: block !important; } #sidebar.active { transform: translateX(0); } }

        .table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .table-responsive table { min-width: 600px; }

        @media (max-width: 767px) {
            .table-card thead { display: none; }
            .table-card tbody tr { display: block; margin-bottom: 1rem; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1rem; background: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
            .table-card tbody tr td { display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0; border: none; text-align: right; gap: 0.75rem; font-size: 0.875rem; min-height: 2.5rem; }
            .table-card tbody tr td::before { content: attr(data-label); font-weight: 600; color: #374151; text-align: left; flex-shrink: 0; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; }
            .table-card tbody tr td.empty-card { display: none; }
            .table-card tbody tr:last-child { margin-bottom: 0; }
            .table-card tbody tr td[data-label="Aksi"] { padding-top: 0.75rem; border-top: 1px dashed #e5e7eb !important; margin-top: 0.5rem; }
            .btn-group-mobile { display: flex; flex-wrap: wrap; gap: 0.5rem; justify-content: flex-end; }
        }

        .mobile-stack { display: flex; flex-direction: column; gap: 0.75rem; }
        .mobile-stack-sm { display: flex; flex-direction: column; gap: 0.25rem; }

        @media (min-width: 768px) {
            .mobile-stack { flex-direction: row; align-items: center; }
            .mobile-stack-sm { flex-direction: row; align-items: center; }
        }

        .filter-wrap { display: flex; flex-wrap: wrap; gap: 0.75rem; align-items: center; }

        .header-wrap { display: flex; flex-wrap: wrap; gap: 0.75rem; align-items: center; justify-content: space-between; }

        @media (max-width: 767px) {
            .stat-card { padding: 1rem !important; }
            .stat-card .stat-icon { width: 2.5rem !important; height: 2.5rem !important; font-size: 1.25rem !important; }
            .stat-card .stat-number { font-size: 1.5rem !important; }
        }

        .min-h-touch { min-height: 44px; }
        .min-w-touch { min-width: 44px; }
        .py-touch { padding-top: 0.625rem; padding-bottom: 0.625rem; }

        @media (max-width: 767px) {
            .card-mobile { border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
            .content-card { padding: 1rem; }
            .content-card > :not(:first-child) { margin-top: 0.75rem; }
        }
        @media (min-width: 768px) {
            .content-card { padding: 1.5rem; }
        }

        .page-enter { animation: pageIn 0.25s ease-out; }
        @keyframes pageIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        .info-grid { display: grid; grid-template-columns: 1fr; gap: 1rem; }
        @media (min-width: 640px) { .info-grid { grid-template-columns: 1fr 1fr; } }
        @media (min-width: 1024px) { .info-grid { grid-template-columns: 1fr 1fr; } }

        .btn { display: inline-flex; align-items: center; justify-content: center; min-height: 40px; font-weight: 500; border-radius: 0.5rem; transition: all 0.15s ease; }
        .btn:active { transform: scale(0.97); }

        input, select, textarea, button { font-size: 16px !important; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    @if(!isset($hideNavbar) || !$hideNavbar)
    <nav class="bg-emerald-800 text-white shadow-lg fixed w-full z-30 top-0">
        <div class="px-4 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                @if(!isset($hideSidebar) || !$hideSidebar)
                <button id="sidebar-toggle" class="lg:hidden text-white text-2xl mr-2 focus:outline-none" aria-label="Buka menu">&#9776;</button>
                @endif
                <span class="text-xl sm:text-2xl">🏫</span>
                <span class="font-bold text-lg tracking-wide hidden sm:inline">LPI Madani Al-Aziziyah</span>
            </div>
            <div class="flex items-center space-x-4">
                @auth
                    <span class="text-emerald-200 text-sm hidden sm:inline">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-1.5 rounded-lg text-sm font-medium transition">Keluar</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>
    @endif

    <div class="flex flex-1 pt-16">
        @if(!isset($hideSidebar) || !$hideSidebar)
            @include('layouts.sidebar')
        @endif

        <main class="flex-1 p-3 sm:p-4 lg:p-6 @if(!isset($hideSidebar) || !$hideSidebar) lg:ml-64 @endif">
            @if(session('success'))
                <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-800 p-4 mb-6 rounded-r-lg flex items-center justify-between shadow-sm">
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800 text-xl leading-none">&times;</button>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-800 p-4 mb-6 rounded-r-lg flex items-center justify-between shadow-sm">
                    <span>{{ session('error') }}</span>
                    <button onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-800 text-xl leading-none">&times;</button>
                </div>
            @endif
            @yield('content')
        </main>
    </div>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            var overlay = document.getElementById('sidebar-overlay');
            if (sidebar) { sidebar.classList.toggle('active'); }
            if (overlay) { overlay.classList.toggle('active'); }
        }
        document.addEventListener('DOMContentLoaded', function () {
            var toggle = document.getElementById('sidebar-toggle');
            var sidebar = document.getElementById('sidebar');
            var overlay = document.getElementById('sidebar-overlay');
            if (toggle && sidebar) {
                toggle.addEventListener('click', toggleSidebar);
                if (overlay) {
                    overlay.addEventListener('click', function () {
                        sidebar.classList.remove('active');
                        overlay.classList.remove('active');
                    });
                }
            }
        });
    </script>
    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>
