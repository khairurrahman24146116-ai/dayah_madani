<div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-10 hidden lg:hidden"></div>
<aside id="sidebar" class="fixed left-0 top-16 w-64 h-[calc(100vh-4rem)] bg-white shadow-lg border-r border-gray-200 overflow-y-auto z-20 -translate-x-full lg:translate-x-0 transition-transform duration-300">
    <div class="p-4">
        <div class="text-center mb-6 pb-4 border-b border-gray-100">
            <div class="text-3xl mb-1">🏫</div>
            <p class="text-xs text-gray-500">LPI Madani Al-Aziziyah</p>
        </div>
        <nav class="space-y-1">
            @auth
                @php $role = Auth::user()->role; @endphp

                @if($role === 'admin')
                    <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider mt-2 mb-2 px-3">Umum</p>
                    <a href="{{ route('admin.dashboard') }}" onclick="toggleSidebar?.()" class="flex items-center space-x-3 px-3 py-3 lg:py-2.5 rounded-lg text-sm font-medium transition min-h-touch {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📊</span>
                        <span>Dashboard</span>
                    </a>

                    <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider mt-4 mb-2 px-3">Master Data</p>
                    <a href="{{ route('admin.tingkat.index') }}" onclick="toggleSidebar?.()" class="flex items-center space-x-3 px-3 py-3 lg:py-2.5 rounded-lg text-sm font-medium transition min-h-touch {{ request()->routeIs('admin.tingkat.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📚</span>
                        <span>Tingkat</span>
                    </a>
                    <a href="{{ route('admin.jurusan.index') }}" onclick="toggleSidebar?.()" class="flex items-center space-x-3 px-3 py-3 lg:py-2.5 rounded-lg text-sm font-medium transition min-h-touch {{ request()->routeIs('admin.jurusan.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">🎯</span>
                        <span>Jurusan</span>
                    </a>
                    <a href="{{ route('admin.kelas.index') }}" onclick="toggleSidebar?.()" class="flex items-center space-x-3 px-3 py-3 lg:py-2.5 rounded-lg text-sm font-medium transition min-h-touch {{ request()->routeIs('admin.kelas.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">🏛️</span>
                        <span>Kelas</span>
                    </a>
                    <a href="{{ route('admin.mapel.index') }}" onclick="toggleSidebar?.()" class="flex items-center space-x-3 px-3 py-3 lg:py-2.5 rounded-lg text-sm font-medium transition min-h-touch {{ request()->routeIs('admin.mapel.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📖</span>
                        <span>Mapel</span>
                    </a>
                    <a href="{{ route('admin.tahun-ajaran.index') }}" onclick="toggleSidebar?.()" class="flex items-center space-x-3 px-3 py-3 lg:py-2.5 rounded-lg text-sm font-medium transition min-h-touch {{ request()->routeIs('admin.tahun-ajaran.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📅</span>
                        <span>Tahun Ajaran</span>
                    </a>

                    <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider mt-4 mb-2 px-3">Manajemen</p>
                    <a href="{{ route('admin.guru.index') }}" onclick="toggleSidebar?.()" class="flex items-center space-x-3 px-3 py-3 lg:py-2.5 rounded-lg text-sm font-medium transition min-h-touch {{ request()->routeIs('admin.guru.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">👨‍🏫</span>
                        <span>Guru</span>
                    </a>
                    <a href="{{ route('admin.santri.index') }}" onclick="toggleSidebar?.()" class="flex items-center space-x-3 px-3 py-3 lg:py-2.5 rounded-lg text-sm font-medium transition min-h-touch {{ request()->routeIs('admin.santri.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">👦</span>
                        <span>Santri</span>
                    </a>

                    <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider mt-4 mb-2 px-3">Akademik</p>
                    <a href="{{ route('admin.krs.index') }}" onclick="toggleSidebar?.()" class="flex items-center space-x-3 px-3 py-3 lg:py-2.5 rounded-lg text-sm font-medium transition min-h-touch {{ request()->routeIs('admin.krs.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📋</span>
                        <span>KRS Management</span>
                    </a>

                @elseif($role === 'guru')
                    <a href="{{ route('guru.dashboard') }}" onclick="toggleSidebar?.()" class="flex items-center space-x-3 px-3 py-3 lg:py-2.5 rounded-lg text-sm font-medium transition min-h-touch {{ request()->routeIs('guru.dashboard') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📊</span>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('guru.jadwal') }}" onclick="toggleSidebar?.()" class="flex items-center space-x-3 px-3 py-3 lg:py-2.5 rounded-lg text-sm font-medium transition min-h-touch {{ request()->routeIs('guru.jadwal') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📅</span>
                        <span>Jadwal Mengajar</span>
                    </a>
                    <a href="{{ route('guru.nilai.index') }}" onclick="toggleSidebar?.()" class="flex items-center space-x-3 px-3 py-3 lg:py-2.5 rounded-lg text-sm font-medium transition min-h-touch {{ request()->routeIs('guru.nilai.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📝</span>
                        <span>Penilaian</span>
                    </a>

                @elseif($role === 'santri')
                    <a href="{{ route('santri.dashboard') }}" onclick="toggleSidebar?.()" class="flex items-center space-x-3 px-3 py-3 lg:py-2.5 rounded-lg text-sm font-medium transition min-h-touch {{ request()->routeIs('santri.dashboard') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📊</span>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('santri.krs.index') }}" onclick="toggleSidebar?.()" class="flex items-center space-x-3 px-3 py-3 lg:py-2.5 rounded-lg text-sm font-medium transition min-h-touch {{ request()->routeIs('santri.krs.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📋</span>
                        <span>KRS Saya</span>
                    </a>
                    <a href="{{ route('santri.jadwal') }}" onclick="toggleSidebar?.()" class="flex items-center space-x-3 px-3 py-3 lg:py-2.5 rounded-lg text-sm font-medium transition min-h-touch {{ request()->routeIs('santri.jadwal') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📅</span>
                        <span>Jadwal Saya</span>
                    </a>
                    <a href="{{ route('santri.nilai') }}" onclick="toggleSidebar?.()" class="flex items-center space-x-3 px-3 py-3 lg:py-2.5 rounded-lg text-sm font-medium transition min-h-touch {{ request()->routeIs('santri.nilai') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📝</span>
                        <span>Nilai Saya</span>
                    </a>
                    <a href="{{ route('santri.profil') }}" onclick="toggleSidebar?.()" class="flex items-center space-x-3 px-3 py-3 lg:py-2.5 rounded-lg text-sm font-medium transition min-h-touch {{ request()->routeIs('santri.profil') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">👤</span>
                        <span>Profil</span>
                    </a>
                @endif
            @endauth
        </nav>
    </div>
</aside>
