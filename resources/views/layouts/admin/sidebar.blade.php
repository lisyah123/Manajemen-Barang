<aside class="w-64 bg-blue-950 border-r border-blue-900 flex flex-col z-20 h-screen transition-all duration-300 shadow-xl">
    
    <div class="h-16 flex items-center px-6 border-b border-white/5 bg-blue-950">
        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-blue-600/20 text-blue-400 border border-blue-500/30">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
            </svg>
        </div>
        <span class="ml-3 text-lg font-black text-white tracking-wide">
            Inventaris<span class="text-blue-400">.</span>
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
            Operasional Gudang
        </div>

        <a href="{{ route('items.index') }}" class="flex items-center px-3 py-2.5 rounded-xl font-medium transition-all duration-200 group {{ request()->routeIs('items.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-blue-200 hover:bg-white/10 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3 {{ request()->routeIs('items.*') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }} transition-colors">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
            </svg>
            Kelola Data Barang
        </a>

        <a href="{{ route('transactions.index') }}" class="flex items-center px-3 py-2.5 rounded-xl font-medium transition-all duration-200 group {{ request()->routeIs('transactions.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-blue-200 hover:bg-white/10 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3 {{ request()->routeIs('transactions.*') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }} transition-colors">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
            Riwayat Barang 
        </a>

        <a href="{{ route('admin.requests.index') }}" class="flex items-center px-3 py-2.5 rounded-xl font-medium transition-all duration-200 group {{ request()->routeIs('admin.requests.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-blue-200 hover:bg-white/10 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3 {{ request()->routeIs('admin.requests.*') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }} transition-colors">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
            </svg>
            Persetujuan Permintaan
        </a>

    </nav>

    <div class="p-4 border-t border-white/5 bg-blue-950/80">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-blue-800 flex items-center justify-center border border-blue-700 shadow-inner">
                <span class="text-sm font-bold text-blue-100">AG</span>
            </div>
            <div>
                <p class="text-sm font-bold text-white">Admin Gudang</p>
                <p class="text-[10px] font-bold text-blue-400 uppercase tracking-wider">Akses Operasional</p>
            </div>
        </div>
    </div>

</aside>