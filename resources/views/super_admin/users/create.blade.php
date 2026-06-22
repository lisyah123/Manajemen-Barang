@extends('layouts.super_admin')

@section('title', 'Tambah User Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    
    <div class="flex items-center mb-8 gap-4">
        <a href="{{ route('users.index') }}" class="p-2.5 bg-white hover:bg-slate-50 text-slate-500 hover:text-blue-600 rounded-xl transition-colors border border-slate-200 shadow-sm hover:shadow">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Tambah User</h1>
            <p class="text-sm text-slate-500 mt-1">Buat kredensial login untuk anggota tim baru.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-10">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf 
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div>
                    <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap <span class="text-rose-500">*</span></label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name') }}" 
                        placeholder="Masukkan nama lengkap"
                        class="block w-full rounded-xl bg-slate-50 px-4 py-3 text-slate-800 border @error('name') border-rose-500 ring-1 ring-rose-500 @else border-slate-200 hover:border-blue-300 @enderror placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300" 
                        required
                        autofocus
                    >
                    @error('name') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Alamat Email <span class="text-rose-500">*</span></label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email') }}" 
                        placeholder="email@perusahaan.com"
                        class="block w-full rounded-xl bg-slate-50 px-4 py-3 text-slate-800 border @error('email') border-rose-500 ring-1 ring-rose-500 @else border-slate-200 hover:border-blue-300 @enderror placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300" 
                        required
                    >
                    @error('email') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Password <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            placeholder="Minimal 8 karakter"
                            class="block w-full rounded-xl bg-slate-50 pl-4 pr-12 py-3 text-slate-800 border @error('password') border-rose-500 ring-1 ring-rose-500 @else border-slate-200 hover:border-blue-300 @enderror placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300" 
                            required 
                            minlength="8"
                        >
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-blue-600 transition-colors focus:outline-none">
                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>
                    @error('password') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="role" class="block text-sm font-bold text-slate-700 mb-2">Pilih Hak Akses (Role) <span class="text-rose-500">*</span></label>
                    <select 
                        name="role" 
                        id="role" 
                        class="block w-full rounded-xl bg-slate-50 px-4 py-3 text-slate-800 border @error('role') border-rose-500 ring-1 ring-rose-500 @else border-slate-200 hover:border-blue-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300" 
                        required
                    >
                        <option value="" disabled {{ old('role') ? '' : 'selected' }}>-- Pilih Role Akses --</option>
                        <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin Gudang</option>
                        <option value="pengguna" {{ old('role') == 'pengguna' ? 'selected' : '' }}>Staff / Pengguna Biasa</option>
                    </select>
                    @error('role') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-10 flex items-center justify-end gap-3 border-t border-slate-100 pt-6">
                <a href="{{ route('users.index') }}" class="px-5 py-2.5 text-sm font-semibold text-slate-500 hover:text-slate-700 bg-transparent hover:bg-slate-100 rounded-xl transition-all duration-200">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                    </svg>
                    Simpan User Baru
                </button>
            </div>
            
        </form>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            // Ganti ke Ikon Mata Dicoret
            eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />`;
        } else {
            passwordInput.type = 'password';
            // Ganti kembali ke Ikon Mata Terbuka
            eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />`;
        }
    }
</script>
@endsection