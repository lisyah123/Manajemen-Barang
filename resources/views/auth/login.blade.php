<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-200">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Inventaris</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full relative overflow-hidden bg-slate-200 font-sans text-slate-800 antialiased">

    <!-- Latar Belakang Estetik yang Lebih Redup & Adem -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-3/4 h-3/4 bg-slate-400/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8 relative z-10">
        
        <!-- Form Card Container (Efek Kaca Lembut) -->
        <div class="sm:mx-auto sm:w-full sm:max-w-md bg-white/60 backdrop-blur-2xl p-10 rounded-3xl shadow-xl border border-white/40">
            
            <!-- Logo & Judul -->
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <div class="flex justify-center">
                    <div class="p-3 bg-white/50 rounded-2xl border border-white/60 shadow-sm backdrop-blur-sm">
                        <!-- Logo Biru -->
                        <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=blue&shade=600" alt="Logo Inventaris" class="h-10 w-auto drop-shadow-sm" />
                    </div>
                </div>
                <h2 class="mt-6 text-center text-2xl font-black tracking-tight text-slate-800">Sistem Inventaris</h2>
                <p class="mt-2 text-center text-sm font-medium text-slate-600">Silakan masuk menggunakan kredensial Anda</p>
            </div>

            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-sm">
                
                <!-- Pesan Error -->
                @if ($errors->any())
                    <div class="mb-6 rounded-xl bg-rose-100/80 p-4 border border-rose-200 shadow-sm flex items-start backdrop-blur-sm">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-rose-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-bold text-rose-800">Gagal Login!</h3>
                            <p class="mt-1 text-sm text-rose-600 font-medium">{{ $errors->first() }}</p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <!-- Input Email -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700">Alamat Email</label>
                        <div class="mt-2">
                            <input 
                                id="email" 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                autocomplete="email" 
                                autofocus
                                class="block w-full rounded-xl bg-white/80 px-4 py-3 text-slate-800 border @error('email') border-rose-400 ring-1 ring-rose-400 @else border-slate-300 hover:border-blue-400 @enderror placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300 sm:text-sm shadow-sm" 
                                placeholder="admin@perusahaan.com" 
                            />
                        </div>
                    </div>

                    <!-- Input Password -->
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-bold text-slate-700">Password</label>
                            <a href="#" class="text-sm font-bold text-blue-600 hover:text-blue-700 transition-colors">Lupa sandi?</a>
                        </div>
                        
                        <div class="mt-2 relative group">
                            <input 
                                id="password" 
                                type="password" 
                                name="password" 
                                required 
                                autocomplete="current-password" 
                                class="block w-full rounded-xl bg-white/80 pl-4 pr-12 py-3 text-slate-800 border @error('password') border-rose-400 ring-1 ring-rose-400 @else border-slate-300 hover:border-blue-400 @enderror placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300 sm:text-sm shadow-sm" 
                                placeholder="••••••••" 
                            />
                            
                            <!-- Tombol Toggle Mata -->
                            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 px-4 flex items-center text-slate-400 hover:text-blue-600 focus:outline-none transition-colors">
                                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Tombol Login -->
                    <div class="pt-4">
                        <button type="submit" class="flex w-full justify-center items-center rounded-xl bg-blue-600 px-4 py-3 text-sm font-bold text-white shadow-md hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-600/30 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all duration-300 transform hover:-translate-y-0.5 group">
                            Masuk ke Sistem
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Script Logika Toggle Password -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const eyeIcon = document.querySelector('#eyeIcon');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            if (type === 'password') {
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />';
            } else {
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />';
            }
        });
    </script>
</body>
</html>