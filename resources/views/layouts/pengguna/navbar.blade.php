<header class="h-16 bg-white shadow-sm flex items-center justify-between px-6 z-10">
    <h2 class="text-xl font-semibold text-gray-800">
        @yield('title')
    </h2>

    <div class="flex items-center space-x-4">
        <div class="text-right">
            <p class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</p>
        </div>
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-100 font-semibold py-2 px-4 rounded-lg transition text-sm">
                Logout
            </button>
        </form>
    </div>
</header>