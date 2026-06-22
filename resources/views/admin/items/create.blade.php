@extends('layouts.admin')

@section('title', 'Tambah Barang Baru')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <div class="flex items-center mb-4 gap-4">
        <a href="{{ route('items.index') }}" class="p-2.5 bg-white hover:bg-slate-50 text-slate-500 hover:text-blue-600 rounded-xl transition-colors border border-slate-200 shadow-sm hover:shadow">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Tambah Barang</h1>
            <p class="text-sm text-slate-500 mt-1">Masukkan detail spesifikasi dan stok awal barang baru.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-10">
        
        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf 
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-8">
                
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Nama Barang <span class="text-rose-500">*</span></label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name') }}" 
                        placeholder="Ketik nama barang dengan jelas"
                        class="block w-full rounded-xl bg-slate-50 px-4 py-3 text-slate-800 border @error('name') border-rose-500 ring-1 ring-rose-500 @else border-slate-200 hover:border-blue-300 @enderror placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300" 
                        required 
                        autofocus
                    >
                    @error('name') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="image" class="block text-sm font-bold text-slate-700 mb-2">Foto Barang (Opsional)</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl hover:border-blue-400 hover:bg-blue-50/50 transition-colors group">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-slate-400 group-hover:text-blue-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-slate-600 justify-center">
                                <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 px-1">
                                    <span>Unggah file foto</span>
                                    <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                                </label>
                            </div>
                            <p class="text-xs text-slate-500">Format: JPG, JPEG, PNG hingga 2MB.</p>
                        </div>
                    </div>
                    @error('image') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-bold text-slate-700 mb-2">Pilih Kategori <span class="text-rose-500">*</span></label>
                    <select 
                        name="category_id" 
                        id="category_id" 
                        class="block w-full rounded-xl bg-slate-50 px-4 py-3 text-slate-800 border @error('category_id') border-rose-500 ring-1 ring-rose-500 @else border-slate-200 hover:border-blue-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300" 
                        required
                    >
                        <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>-- Pilih Kategori --</option>
                        
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="stock" class="block text-sm font-bold text-slate-700 mb-2">Stok Awal Fisik <span class="text-rose-500">*</span></label>
                    <input 
                        type="number" 
                        name="stock" 
                        id="stock" 
                        min="0" 
                        value="{{ old('stock', 0) }}" 
                        class="block w-full rounded-xl bg-slate-50 px-4 py-3 text-slate-800 border @error('stock') border-rose-500 ring-1 ring-rose-500 @else border-slate-200 hover:border-blue-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300" 
                        required
                    >
                    @error('stock') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-bold text-slate-700 mb-2">Deskripsi Spesifikasi</label>
                    <textarea 
                        name="description" 
                        id="description" 
                        rows="4" 
                        placeholder="Tambahkan keterangan ukuran, merek, atau detail lainnya..."
                        class="block w-full rounded-xl bg-slate-50 px-4 py-3 text-slate-800 border @error('description') border-rose-500 ring-1 ring-rose-500 @else border-slate-200 hover:border-blue-300 @enderror placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300"
                    >{{ old('description') }}</textarea>
                    @error('description') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-10 flex items-center justify-end gap-3 border-t border-slate-100 pt-6">
                <a href="{{ route('items.index') }}" class="px-5 py-2.5 text-sm font-semibold text-slate-500 hover:text-slate-700 bg-transparent hover:bg-slate-100 rounded-xl transition-all duration-200">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Simpan Barang
                </button>
            </div>
            
        </form>
    </div>
</div>
@endsection