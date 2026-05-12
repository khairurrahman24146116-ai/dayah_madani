<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LPI Madani Al-Aziziyah')</title>
    @vite('resources/css/app.css')
    @stack('styles')
    <style>
        @media print { body { visibility: hidden; } .print-area { visibility: visible; position: absolute; left: 0; top: 0; width: 100%; } .print-area * { visibility: visible; } .no-print { display: none !important; } }
        @media (max-width: 1023px) { #sidebar-overlay.active { display: block !important; } #sidebar.active { transform: translateX(0); } }

        .table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .table-responsive table { min-width: 600px; }

        @media (max-width: 767px) {
            .table-card thead { display: none; }
            .table-card tbody tr { display: block; margin-bottom: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 0.75rem; background: #fff; }
            .table-card tbody tr td { display: flex; justify-content: space-between; align-items: center; padding: 0.4rem 0; border: none; text-align: right; gap: 0.5rem; }
            .table-card tbody tr td::before { content: attr(data-label); font-weight: 600; color: #374151; text-align: left; flex-shrink: 0; }
            .table-card tbody tr td.empty-card { display: none; }
            .table-card tbody tr:last-child { margin-bottom: 0; }
            .btn-group-mobile { display: flex; flex-wrap: wrap; gap: 0.5rem; justify-content: flex-end; }
        }

        .mobile-stack { display: flex; flex-direction: column; gap: 0.5rem; }
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
        document.addEventListener('DOMContentLoaded', function () {
            var toggle = document.getElementById('sidebar-toggle');
            var sidebar = document.getElementById('sidebar');
            var overlay = document.getElementById('sidebar-overlay');
            if (toggle && sidebar) {
                toggle.addEventListener('click', function () {
                    sidebar.classList.toggle('active');
                    if (overlay) overlay.classList.toggle('active');
                });
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
