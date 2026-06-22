<aside class="w-64 bg-blue-950 border-r border-blue-900 flex flex-col z-20 h-screen transition-all duration-300 shadow-xl">
    
    <div class="h-16 flex items-center px-6 border-b border-white/5 bg-blue-950">
        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-blue-600/20 text-blue-400 border border-blue-500/30">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
            </svg>
        </div>
        <span class="ml-3 text-lg font-black text-white tracking-wide">
            Super<span class="text-blue-400">Admin</span>
        </span>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
        
        <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2.5 rounded-xl font-medium transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-blue-200 hover:bg-white/10 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }} transition-colors">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            Dashboard
        </a>

        <div class="pt-6 pb-2 px-3 text-[11px] font-bold text-blue-400/70 uppercase tracking-widest">
            Manajemen Inti
        </div>

        <a href="{{ route('users.index') }}" class="flex items-center px-3 py-2.5 rounded-xl font-medium transition-all duration-200 group {{ request()->routeIs('users.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-blue-200 hover:bg-white/10 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3 {{ request()->routeIs('users.*') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }} transition-colors">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
            </svg>
            Kelola User
        </a>

        <a href="{{ route('categories.index') }}" class="flex items-center px-3 py-2.5 rounded-xl font-medium transition-all duration-200 group {{ request()->routeIs('categories.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-blue-200 hover:bg-white/10 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3 {{ request()->routeIs('categories.*') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }} transition-colors">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
            </svg>
            Kategori Barang
        </a>

        <div class="pt-6 pb-2 px-3 text-[11px] font-bold text-blue-400/70 uppercase tracking-widest">
            Laporan (Read-Only)
        </div>

        <a href="{{ route('reports.index') }}" class="flex items-center px-3 py-2.5 rounded-xl font-medium transition-all duration-200 group {{ request()->routeIs('reports.index') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-blue-200 hover:bg-white/10 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3 {{ request()->routeIs('reports.index') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }} transition-colors">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
            </svg>
            Semua Data Barang
        </a>

        <a href="{{ route('reports.index2') }}" class="flex items-center px-3 py-2.5 rounded-xl font-medium transition-all duration-200 group {{ request()->routeIs('reports.index2') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-blue-200 hover:bg-white/10 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3 {{ request()->routeIs('reports.index2') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }} transition-colors">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
            Semua Transaksi
        </a>
    </nav>

    <div class="p-4 border-t border-white/5 bg-blue-950/80">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-blue-800 flex items-center justify-center border border-blue-700 shadow-inner">
                <span class="text-sm font-bold text-blue-100">SA</span>
            </div>
            <div>
                <p class="text-sm font-bold text-white">Super Admin</p>
                <p class="text-[10px] font-bold text-blue-400 uppercase tracking-wider">Akses Penuh</p>
            </div>
        </div>
    </div>
</aside>