@extends('layouts.admin')

@section('title', 'Edit Data Barang')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <div class="flex items-center mb-4 gap-4">
        <a href="{{ route('items.index') }}" class="p-2.5 bg-white hover:bg-slate-50 text-slate-500 hover:text-blue-600 rounded-xl transition-colors border border-slate-200 shadow-sm hover:shadow">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Edit Barang</h1>
            <p class="text-sm text-slate-500 mt-1">Lakukan penyesuaian pada data <span class="font-bold text-blue-600">{{ $item->name }}</span>.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-10">
        
        <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf 
            @method('PUT') 
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-8">
                
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Nama Barang <span class="text-rose-500">*</span></label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name', $item->name) }}" 
                        class="block w-full rounded-xl bg-slate-50 px-4 py-3 text-slate-800 border @error('name') border-rose-500 ring-1 ring-rose-500 @else border-slate-200 hover:border-blue-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300" 
                        required
                    >
                    @error('name') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="image" class="block text-sm font-bold text-slate-700 mb-2">Foto Barang (Opsional)</label>
                    
                    @if($item->image)
                        <div class="mb-4 flex items-center gap-4 p-4 rounded-xl border border-slate-200 bg-slate-50">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="Foto Saat Ini" class="h-16 w-16 object-cover rounded-lg shadow-sm border border-slate-300">
                            <div>
                                <p class="text-sm font-bold text-slate-700">Foto Saat Ini</p>
                                <p class="text-xs text-slate-500 mt-0.5">Unggah foto baru di bawah jika Anda ingin menggantinya.</p>
                            </div>
                        </div>
                    @endif

                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl hover:border-blue-400 hover:bg-blue-50/50 transition-colors group">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-slate-400 group-hover:text-blue-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-slate-600 justify-center">
                                <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 px-1">
                                    <span>Unggah foto pengganti</span>
                                    <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                                </label>
                            </div>
                            <p class="text-xs text-slate-500">Format: JPG, JPEG, PNG hingga 2MB.</p>
                        </div>
                    </div>
                    @error('image') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-bold text-slate-700 mb-2">Kategori <span class="text-rose-500">*</span></label>
                    <select 
                        name="category_id" 
                        id="category_id" 
                        class="block w-full rounded-xl bg-slate-50 px-4 py-3 text-slate-800 border @error('category_id') border-rose-500 ring-1 ring-rose-500 @else border-slate-200 hover:border-blue-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300" 
                        required
                    >
                        <option value="" disabled>-- Pilih Kategori --</option>
                        
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="stock" class="block text-sm font-bold text-slate-700 mb-2">Penyesuaian Stok <span class="text-rose-500">*</span></label>
                    <input 
                        type="number" 
                        name="stock" 
                        id="stock" 
                        min="0" 
                        value="{{ old('stock', $item->stock) }}" 
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
                        class="block w-full rounded-xl bg-slate-50 px-4 py-3 text-slate-800 border @error('description') border-rose-500 ring-1 ring-rose-500 @else border-slate-200 hover:border-blue-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300"
                    >{{ old('description', $item->description) }}</textarea>
                    @error('description') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-10 flex items-center justify-end gap-3 border-t border-slate-100 pt-6">
                <a href="{{ route('items.index') }}" class="px-5 py-2.5 text-sm font-semibold text-slate-500 hover:text-slate-700 bg-transparent hover:bg-slate-100 rounded-xl transition-all duration-200">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                    Perbarui Barang
                </button>
            </div>
            
        </form>
    </div>
</div>
@endsection