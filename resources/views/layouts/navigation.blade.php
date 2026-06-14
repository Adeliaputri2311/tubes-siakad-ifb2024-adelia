<div class="flex flex-col h-screen sticky top-0 bg-white border-r border-slate-100 w-64 p-5 shrink-0 justify-between">
    
    <div class="flex flex-col space-y-7">
        <div class="flex items-center space-x-3 px-3">
            <div class="h-9 w-9 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200">
                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <span class="font-bold text-xl text-slate-800 tracking-tight">SIAKAD</span>
        </div>

        <div class="flex flex-col space-y-1.5">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-3 mb-1">Main Menu</p>
            
            <a href="{{ route('dashboard') }}" 
               class="flex items-center space-x-3 px-4 py-3.5 rounded-xl text-sm font-medium transition duration-150 group {{ request()->routeIs('dashboard', 'admin.dashboard', 'mahasiswa.dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20 font-semibold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                <span class="text-lg transition {{ request()->routeIs('dashboard', 'admin.dashboard', 'mahasiswa.dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-slate-600' }}">📊</span>
                <span>{{ __('Dashboard') }}</span>
            </a>

            @if (Auth::user()->isAdmin())
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-3 pt-5 mb-1">Master Data</p>
                
                <a href="{{ route('admin.dosen.index') }}" 
                   class="flex items-center space-x-3 px-4 py-3.5 rounded-xl text-sm font-medium transition duration-150 group {{ request()->routeIs('admin.dosen.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20 font-semibold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                    <span class="text-lg transition {{ request()->routeIs('admin.dosen.*') ? 'text-white' : 'text-slate-400 group-hover:text-slate-600' }}">👨‍🏫</span>
                    <span>{{ __('Kelola Dosen') }}</span>
                </a>

                <a href="{{ route('admin.mahasiswa.index') }}" 
                   class="flex items-center space-x-3 px-4 py-3.5 rounded-xl text-sm font-medium transition duration-150 group {{ request()->routeIs('admin.mahasiswa.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20 font-semibold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                    <span class="text-lg transition {{ request()->routeIs('admin.mahasiswa.*') ? 'text-white' : 'text-slate-400 group-hover:text-slate-600' }}">🎓</span>
                    <span>{{ __('Kelola Mahasiswa') }}</span>
                </a>

                <a href="{{ route('admin.matakuliah.index') }}" 
                   class="flex items-center space-x-3 px-4 py-3.5 rounded-xl text-sm font-medium transition duration-150 group {{ request()->routeIs('admin.matakuliah.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20 font-semibold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                    <span class="text-lg transition {{ request()->routeIs('admin.matakuliah.*') ? 'text-white' : 'text-slate-400 group-hover:text-slate-600' }}">📚</span>
                    <span>{{ __('Kelola Matakuliah') }}</span>
                </a>

                <a href="{{ route('admin.jadwal.index') }}" 
                   class="flex items-center space-x-3 px-4 py-3.5 rounded-xl text-sm font-medium transition duration-150 group {{ request()->routeIs('admin.jadwal.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20 font-semibold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                    <span class="text-lg transition {{ request()->routeIs('admin.jadwal.*') ? 'text-white' : 'text-slate-400 group-hover:text-slate-600' }}">📅</span>
                    <span>{{ __('Kelola Jadwal') }}</span>
                </a>
            @endif

            @if (Auth::user()->isMahasiswa())
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-3 pt-5 mb-1">Akademik</p>
                
                <a href="{{ route('mahasiswa.krs.index') }}" 
                   class="flex items-center space-x-3 px-4 py-3.5 rounded-xl text-sm font-medium transition duration-150 group {{ request()->routeIs('mahasiswa.krs.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20 font-semibold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                    <span class="text-lg transition {{ request()->routeIs('mahasiswa.krs.*') ? 'text-white' : 'text-slate-400 group-hover:text-slate-600' }}">📝</span>
                    <span>{{ __('Pengisian KRS') }}</span>
                </a>
            @endif
        </div>
    </div>

    <div class="flex flex-col space-y-4 pt-4 border-t border-slate-100">
        <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 p-2 rounded-xl hover:bg-slate-50 transition duration-150">
            <div class="h-9 w-9 bg-slate-100 text-slate-600 rounded-xl font-bold flex items-center justify-center text-sm uppercase border border-slate-200">
                {{ substr(Auth::user()->name, 0, 2) }}
            </div>
            <div class="flex flex-col min-w-0 flex-1">
                <span class="text-sm font-semibold text-slate-800 truncate">{{ Auth::user()->name }}</span>
                <span class="text-[11px] text-slate-400 font-medium truncate uppercase tracking-wider">{{ Auth::user()->role }}</span>
            </div>
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center space-x-3 px-4 py-3.5 rounded-xl text-sm font-medium text-red-500 hover:bg-red-50 hover:text-red-600 transition duration-150 group">
                <span class="text-lg text-red-400 group-hover:text-red-500">⚙️</span>
                <span>{{ __('Log Out') }}</span>
            </button>
        </form>
    </div>

</div>