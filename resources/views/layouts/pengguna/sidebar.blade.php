<aside class="w-64 bg-blue-950 border-r border-blue-900 flex flex-col z-20 h-screen transition-all duration-300 shadow-xl">
    
    <!-- Header Sidebar -->
    <div class="h-16 flex items-center px-6 border-b border-white/5 bg-blue-950">
        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-blue-600/20 text-blue-400 border border-blue-500/30">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>
        <span class="ml-3 text-lg font-black text-white tracking-wide">
            Portal<span class="text-blue-400">Staff</span>
        </span>
    </div>

    <!-- Navigasi -->
    <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
        
        <!-- Beranda -->
        <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2.5 rounded-xl font-medium transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-blue-200 hover:bg-white/10 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }} transition-colors">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            Beranda
        </a>

        <div class="pt-6 pb-2 px-3 text-[11px] font-bold text-blue-400/70 uppercase tracking-widest">
            Layanan Gudang
        </div>

        <!-- Katalog Barang -->
        <a href="{{ route('pengguna.items.index') }}" class="flex items-center px-3 py-2.5 rounded-xl font-medium transition-all duration-200 group {{ request()->routeIs('pengguna.items.index') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-blue-200 hover:bg-white/10 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3 {{ request()->routeIs('pengguna.items.index') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }} transition-colors">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 0120.25 15.75V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
            </svg>
            Katalog Barang
        </a>

        <!-- Riwayat Permintaan -->
        <a href="{{ route('pengguna.items.history') }}" class="flex items-center px-3 py-2.5 rounded-xl font-medium transition-all duration-200 group {{ request()->routeIs('pengguna.items.history') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-blue-200 hover:bg-white/10 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3 {{ request()->routeIs('pengguna.items.history') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }} transition-colors">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Riwayat Permintaan
        </a>
    </nav>

    <!-- Footer Profile -->
    <div class="p-4 border-t border-white/5 bg-blue-950/80">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-blue-800 flex items-center justify-center border border-blue-700 shadow-inner">
                <span class="text-sm font-bold text-blue-100">ST</span>
            </div>
            <div>
                <p class="text-sm font-bold text-white">Staff / Pengguna</p>
                <p class="text-[10px] font-bold text-blue-400 uppercase tracking-wider">Akses Terbatas</p>
            </div>
        </div>
    </div>
</aside>