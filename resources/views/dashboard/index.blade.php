@extends('layouts.' . Auth::user()->role)

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8 flex flex-col sm:flex-row items-center sm:items-start gap-6">
        
        <div class="flex-shrink-0">
            <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center border border-blue-100 shadow-inner">
                <span class="text-3xl font-black uppercase tracking-wider">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </span>
            </div>
        </div>

        <div class="text-center sm:text-left flex-1">
            <h2 class="text-2xl font-bold text-slate-800 mb-2">
                Selamat datang, {{ Auth::user()->name }}!
            </h2>
            <p class="text-slate-500 text-sm md:text-base mb-4 leading-relaxed max-w-2xl">
                Sistem Manajemen Inventaris Gudang siap digunakan. Anda masuk dengan hak akses sebagai 
                <span class="font-semibold text-blue-700 bg-blue-50 border border-blue-100 px-2 py-0.5 rounded-md ml-1 text-xs uppercase tracking-wide">
                    @if(Auth::user()->role == 'super_admin') Super Admin @endif
                    @if(Auth::user()->role == 'admin') Admin Gudang @endif
                    @if(Auth::user()->role == 'pengguna') Staff Biasa @endif
                </span>
            </p>
            
            <div class="inline-flex items-center text-sm font-medium text-slate-500 bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-200">
                <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </div>

    <div class="pt-4">
        <h3 class="text-lg font-bold text-slate-800 mb-4 px-1">Akses Cepat</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

            @if(Auth::user()->role === 'super_admin')
                <a href="{{ route('reports.index') }}" class="group bg-white hover:bg-slate-50 border border-slate-200 hover:border-blue-300 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-200 flex items-start gap-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-slate-800 font-bold mb-1 group-hover:text-blue-600 transition-colors">Laporan Barang</h4>
                        <p class="text-sm text-slate-500 leading-snug">Pantau ketersediaan stok seluruh barang di gudang.</p>
                    </div>
                </a>
                
                <a href="{{ route('reports.index2') }}" class="group bg-white hover:bg-slate-50 border border-slate-200 hover:border-blue-300 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-200 flex items-start gap-4">
                    <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-slate-800 font-bold mb-1 group-hover:text-indigo-600 transition-colors">Laporan Transaksi</h4>
                        <p class="text-sm text-slate-500 leading-snug">Tinjau arus barang masuk dan keluar beserta cetak PDF.</p>
                    </div>
                </a>
            @endif

            @if(Auth::user()->role === 'admin')
                <a href="{{ route('items.index') }}" class="group bg-white hover:bg-slate-50 border border-slate-200 hover:border-emerald-300 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-200 flex items-start gap-4">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-slate-800 font-bold mb-1 group-hover:text-emerald-600 transition-colors">Kelola Data Barang</h4>
                        <p class="text-sm text-slate-500 leading-snug">Tambah, edit, hapus, atau kelola foto katalog barang.</p>
                    </div>
                </a>
                
                <a href="{{ route('admin.requests.index') }}" class="group bg-white hover:bg-slate-50 border border-slate-200 hover:border-amber-300 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-200 flex items-start gap-4">
                    <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-slate-800 font-bold mb-1 group-hover:text-amber-600 transition-colors">Persetujuan Staff</h4>
                        <p class="text-sm text-slate-500 leading-snug">Tinjau dan proses pengajuan permintaan barang dari Staff.</p>
                    </div>
                </a>
            @endif

            @if(Auth::user()->role === 'pengguna')
                <a href="{{ route('pengguna.items.index') }}" class="group bg-white hover:bg-slate-50 border border-slate-200 hover:border-blue-300 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-200 flex items-start gap-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-slate-800 font-bold mb-1 group-hover:text-blue-600 transition-colors">Katalog Barang</h4>
                        <p class="text-sm text-slate-500 leading-snug">Lihat ketersediaan barang dan ajukan permohonan peminjaman.</p>
                    </div>
                </a>
                
                <a href="{{ route('pengguna.items.history') }}" class="group bg-white hover:bg-slate-50 border border-slate-200 hover:border-amber-300 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-200 flex items-start gap-4">
                    <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-slate-800 font-bold mb-1 group-hover:text-amber-600 transition-colors">Riwayat Pengajuan</h4>
                        <p class="text-sm text-slate-500 leading-snug">Pantau status persetujuan dari barang yang Anda minta.</p>
                    </div>
                </a>
            @endif

        </div>
    </div>
</div>
@endsection