<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-10 hidden lg:hidden"></div>
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
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📊</span>
                        <span>Dashboard</span>
                    </a>

                    <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider mt-4 mb-2 px-3">Master Data</p>
                    <a href="{{ route('admin.tingkat.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.tingkat.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📚</span>
                        <span>Tingkat</span>
                    </a>
                    <a href="{{ route('admin.jurusan.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.jurusan.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">🎯</span>
                        <span>Jurusan</span>
                    </a>
                    <a href="{{ route('admin.kelas.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.kelas.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">🏛️</span>
                        <span>Kelas</span>
                    </a>
                    <a href="{{ route('admin.mapel.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.mapel.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📖</span>
                        <span>Mapel</span>
                    </a>
                    <a href="{{ route('admin.tahun-ajaran.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.tahun-ajaran.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📅</span>
                        <span>Tahun Ajaran</span>
                    </a>

                    <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider mt-4 mb-2 px-3">Manajemen</p>
                    <a href="{{ route('admin.guru.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.guru.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">👨‍🏫</span>
                        <span>Guru</span>
                    </a>
                    <a href="{{ route('admin.santri.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.santri.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">👦</span>
                        <span>Santri</span>
                    </a>

                    <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider mt-4 mb-2 px-3">Akademik</p>
                    <a href="{{ route('admin.krs.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.krs.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📋</span>
                        <span>KRS Management</span>
                    </a>

                @elseif($role === 'guru')
                    <a href="{{ route('guru.dashboard') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('guru.dashboard') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📊</span>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('guru.jadwal') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('guru.jadwal') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📅</span>
                        <span>Jadwal Mengajar</span>
                    </a>
                    <a href="{{ route('guru.nilai.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('guru.nilai.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📝</span>
                        <span>Penilaian</span>
                    </a>

                @elseif($role === 'santri')
                    <a href="{{ route('santri.dashboard') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('santri.dashboard') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📊</span>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('santri.krs.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('santri.krs.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📋</span>
                        <span>KRS Saya</span>
                    </a>
                    <a href="{{ route('santri.jadwal') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('santri.jadwal') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📅</span>
                        <span>Jadwal Saya</span>
                    </a>
                    <a href="{{ route('santri.nilai') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('santri.nilai') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">📝</span>
                        <span>Nilai Saya</span>
                    </a>
                    <a href="{{ route('santri.profil') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('santri.profil') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <span class="text-lg">👤</span>
                        <span>Profil</span>
                    </a>
                @endif
            @endauth
        </nav>
    </div>
</aside>
