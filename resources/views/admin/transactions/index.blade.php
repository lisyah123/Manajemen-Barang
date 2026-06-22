@extends('layouts.admin')

@section('title', 'Riwayat Transaksi Barang')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center bg-white p-6 rounded-2xl shadow-sm border border-slate-200 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Riwayat Transaksi</h1>
            <p class="text-sm text-slate-500 mt-1">Catatan pergerakan barang masuk dan keluar dari gudang.</p>
        </div>
        
        <a href="{{ route('transactions.create') }}" class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Catat Transaksi Baru
        </a>
    </div>

    @if(session('success'))
        <div class="rounded-xl bg-emerald-50 border border-emerald-200 p-4 flex items-center shadow-sm">
            <div class="flex-shrink-0 bg-emerald-100 p-1.5 rounded-full">
                <svg class="h-5 w-5 text-emerald-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-bold text-emerald-800">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200">
        <form action="{{ route('transactions.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
            
            <div class="w-full md:flex-1">
                <label for="search" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Cari Transaksi</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Cari nama barang atau keterangan..." class="block w-full pl-10 pr-4 py-2.5 text-sm text-slate-800 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all outline-none hover:border-blue-300">
                </div>
            </div>

            <div class="w-full md:w-64">
                <label for="type" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Jenis Transaksi</label>
                <select name="type" id="type" class="block w-full px-4 py-2.5 text-sm text-slate-800 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all outline-none hover:border-blue-300 cursor-pointer">
                    <option value="">Semua Jenis</option>
                    <option value="masuk" {{ request('type') == 'masuk' ? 'selected' : '' }}>Barang Masuk</option>
                    <option value="keluar" {{ request('type') == 'keluar' ? 'selected' : '' }}>Barang Keluar</option>
                </select>
            </div>

            <div class="flex items-center gap-2 w-full md:w-auto">
                <button type="submit" class="w-full md:w-auto px-6 py-2.5 bg-slate-800 hover:bg-slate-700 text-white text-sm font-bold rounded-xl shadow-md hover:shadow-lg transition-all flex items-center justify-center">
                    Cari
                </button>
                
                @if(request('search') || request('type'))
                    <a href="{{ route('transactions.index') }}" class="w-full md:w-auto px-4 py-2.5 bg-slate-100 hover:bg-rose-50 text-slate-500 hover:text-rose-600 border border-slate-200 hover:border-rose-200 text-sm font-bold rounded-xl transition-all flex items-center justify-center" title="Hapus Filter">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                @endif
            </div>

        </form>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-500 font-bold uppercase text-[11px] tracking-wider border-b border-slate-200">
                    <tr>
                        <th scope="col" class="px-6 py-4 w-16 text-center">No</th>
                        <th scope="col" class="px-6 py-4">Waktu Transaksi</th>
                        <th scope="col" class="px-6 py-4">Barang</th>
                        <th scope="col" class="px-6 py-4 text-center">Jenis</th>
                        <th scope="col" class="px-6 py-4 text-center">Jumlah</th>
                        <th scope="col" class="px-6 py-4">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    
                    @forelse($transactions as $index => $transaction)
                        <tr class="hover:bg-slate-50 transition-colors duration-200">
                            <td class="px-6 py-4 text-center text-slate-500 font-medium">{{ $index + 1 }}</td>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-slate-800 font-bold">{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</div>
                                <div class="text-xs text-slate-500 font-medium mt-0.5">{{ \Carbon\Carbon::parse($transaction->created_at)->format('H:i') }} WIB</div>
                            </td>
                            
                            <td class="px-6 py-4 font-bold text-blue-600">
                                {{ $transaction->item ? $transaction->item->name : 'Barang Dihapus' }}
                            </td>
                            
                            <td class="px-6 py-4 text-center">
                                @if($transaction->type === 'masuk')
                                    <span class="inline-flex items-center justify-center w-24 py-1.5 rounded-md text-[11px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-200 uppercase tracking-widest">
                                        Masuk
                                    </span>
                                @else
                                    <span class="inline-flex items-center justify-center w-24 py-1.5 rounded-md text-[11px] font-bold bg-rose-50 text-rose-600 border border-rose-200 uppercase tracking-widest">
                                        Keluar
                                    </span>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 text-center">
                                <span class="font-black text-lg {{ $transaction->type === 'masuk' ? 'text-emerald-500' : 'text-rose-500' }}">
                                    {{ $transaction->type === 'masuk' ? '+' : '-' }}{{ $transaction->quantity }}
                                </span>
                            </td>
                            
                            <td class="px-6 py-4 text-slate-500 text-xs leading-relaxed max-w-[200px] truncate">
                                {{ $transaction->description ?: '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-slate-500">
                                <div class="bg-slate-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-slate-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                @if(request('search') || request('type'))
                                    <p class="text-base font-bold text-slate-700">Transaksi tidak ditemukan.</p>
                                    <p class="text-sm mt-1">Silakan coba kata kunci atau jenis filter yang berbeda.</p>
                                @else
                                    <p class="text-base font-bold text-slate-700">Belum ada riwayat transaksi.</p>
                                    <p class="text-sm mt-1">Data akan muncul setelah Anda mencatat barang masuk atau keluar.</p>
                                @endif
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection