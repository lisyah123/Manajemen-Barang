@extends('layouts.admin')

@section('title', 'Catat Transaksi Baru')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <div class="flex items-center gap-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <a href="{{ route('transactions.index') }}" class="p-2.5 bg-slate-50 hover:bg-slate-100 text-slate-500 hover:text-blue-600 rounded-xl transition-colors border border-slate-200 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Form Transaksi</h1>
            <p class="text-sm text-slate-500 mt-1">Catat aktivitas barang masuk atau keluar. Stok akan diperbarui secara otomatis.</p>
        </div>
    </div>

    @if(session('error'))
        <div class="rounded-xl bg-rose-50 border border-rose-200 p-4 flex items-start shadow-sm">
            <div class="flex-shrink-0 bg-rose-100 p-1.5 rounded-full mt-0.5">
                <svg class="h-4 w-4 text-rose-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-bold text-rose-800">Transaksi Gagal</h3>
                <p class="mt-1 text-sm font-medium text-rose-600">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-10">
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf 
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-8">
                
                <div>
                    <label for="date" class="block text-sm font-bold text-slate-700 mb-2">Tanggal Transaksi <span class="text-rose-500">*</span></label>
                    <input 
                        type="date" 
                        name="date" 
                        id="date" 
                        value="{{ old('date', date('Y-m-d')) }}" 
                        class="block w-full rounded-xl bg-slate-50 px-4 py-3 text-slate-800 border @error('date') border-rose-500 ring-1 ring-rose-500 @else border-slate-200 hover:border-blue-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300" 
                        required
                    >
                    @error('date') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="type" class="block text-sm font-bold text-slate-700 mb-2">Jenis Transaksi <span class="text-rose-500">*</span></label>
                    <select 
                        name="type" 
                        id="type" 
                        class="block w-full rounded-xl bg-slate-50 px-4 py-3 text-slate-800 border @error('type') border-rose-500 ring-1 ring-rose-500 @else border-slate-200 hover:border-blue-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300 font-medium" 
                        required
                    >
                        <option value="" disabled {{ old('type') ? '' : 'selected' }}>-- Pilih Jenis --</option>
                        <option value="masuk" {{ old('type') == 'masuk' ? 'selected' : '' }} class="text-emerald-600 font-bold">Masuk (Penambahan Stok)</option>
                        <option value="keluar" {{ old('type') == 'keluar' ? 'selected' : '' }} class="text-rose-600 font-bold">Keluar (Pengurangan Stok)</option>
                    </select>
                    @error('type') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="item_id" class="block text-sm font-bold text-slate-700 mb-2">Pilih Barang <span class="text-rose-500">*</span></label>
                    <select 
                        name="item_id" 
                        id="item_id" 
                        class="block w-full rounded-xl bg-slate-50 px-4 py-3 text-slate-800 border @error('item_id') border-rose-500 ring-1 ring-rose-500 @else border-slate-200 hover:border-blue-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300" 
                        required
                    >
                        <option value="" disabled {{ old('item_id') ? '' : 'selected' }}>-- Cari dan Pilih Barang --</option>
                        
                        @foreach($items as $item)
                            <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->name }} (Sisa Stok Fisik: {{ $item->stock }})
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-2 text-xs text-slate-500">*Hanya barang yang sudah terdaftar di master data yang bisa dipilih.</p>
                    @error('item_id') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="quantity" class="block text-sm font-bold text-slate-700 mb-2">Jumlah <span class="text-rose-500">*</span></label>
                    <input 
                        type="number" 
                        name="quantity" 
                        id="quantity" 
                        min="1" 
                        value="{{ old('quantity') }}" 
                        placeholder="Contoh: 10" 
                        class="block w-full rounded-xl bg-slate-50 px-4 py-3 text-slate-800 border @error('quantity') border-rose-500 ring-1 ring-rose-500 @else border-slate-200 hover:border-blue-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300 font-black text-lg" 
                        required
                    >
                    @error('quantity') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-bold text-slate-700 mb-2">Keterangan / Catatan Tambahan</label>
                    <textarea 
                        name="description" 
                        id="description" 
                        rows="3" 
                        placeholder="Contoh: Pembelian dari Supplier A, Barang retur, dll." 
                        class="block w-full rounded-xl bg-slate-50 px-4 py-3 text-slate-800 border @error('description') border-rose-500 ring-1 ring-rose-500 @else border-slate-200 hover:border-blue-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300"
                    >{{ old('description') }}</textarea>
                    @error('description') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-10 flex items-center justify-end gap-3 border-t border-slate-100 pt-6">
                <a href="{{ route('transactions.index') }}" class="px-5 py-2.5 text-sm font-semibold text-slate-500 hover:text-slate-700 bg-transparent hover:bg-slate-100 rounded-xl transition-all duration-200">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Proses Transaksi
                </button>
            </div>
            
        </form>
    </div>
</div>
@endsection