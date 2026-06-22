<header class="h-20 sticky top-0 bg-white/80 backdrop-blur-xl border-b border-slate-200 flex items-center justify-between px-8 z-30 transition-all duration-300">
    
    <div class="flex items-center gap-3">
        <h2 class="text-xl font-bold text-slate-800 tracking-tight">
            @yield('title')
        </h2>
    </div>

    <div class="flex items-center gap-6">
        
        <div class="flex items-center gap-4 border-r border-slate-200 pr-6">
            <div class="text-right hidden sm:block">
                <p class="text-sm font-bold text-slate-800">{{ Auth::user()->name }}</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-0.5">
                    @if(Auth::user()->role == 'super_admin') 
                        Super Admin 
                    @elseif(Auth::user()->role == 'admin') 
                        Admin Gudang 
                    @else 
                        Staff 
                    @endif
                </p>
            </div>
            
            <div class="h-10 w-10 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center text-blue-600 font-black shadow-sm text-lg">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
        </div>
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center gap-2 px-4 py-2.5 bg-rose-50 hover:bg-rose-500 text-rose-600 hover:text-white text-sm font-bold rounded-xl transition-all duration-300 group shadow-sm hover:shadow-md hover:shadow-rose-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 group-hover:-translate-x-1 transition-transform duration-300">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                </svg>
                Logout
            </button>
        </form>
        
    </div>
</header>