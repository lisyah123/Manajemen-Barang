@extends('layouts.super_admin')

@section('title', 'Edit Kategori Barang')

@section('content')
<div class="max-w-4xl mx-auto">
    
    <div class="flex items-center mb-8 gap-4">
        <a href="{{ route('categories.index') }}" class="p-2.5 bg-white hover:bg-slate-50 text-slate-500 hover:text-blue-600 rounded-xl transition-colors border border-slate-200 shadow-sm hover:shadow">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Edit Kategori</h1>
            <p class="text-sm text-slate-500 mt-1">Lakukan perubahan pada data kategori <span class="font-bold text-blue-600">{{ $category->name }}</span>.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-10">
        
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf 
            @method('PUT') 
            <div class="space-y-6">
                
                <div>
                    <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Nama Kategori <span class="text-rose-500">*</span></label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name', $category->name) }}" 
                        class="block w-full rounded-xl bg-slate-50 px-4 py-3 text-slate-800 border @error('name') border-rose-500 ring-1 ring-rose-500 @else border-slate-200 hover:border-blue-300 @enderror placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300"
                        required
                    >
                    @error('name')
                        <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-bold text-slate-700 mb-2">Deskripsi (Opsional)</label>
                    <textarea 
                        name="description" 
                        id="description" 
                        rows="4" 
                        class="block w-full rounded-xl bg-slate-50 px-4 py-3 text-slate-800 border @error('description') border-rose-500 ring-1 ring-rose-500 @else border-slate-200 hover:border-blue-300 @enderror placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300"
                    >{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-10 flex items-center justify-end gap-3 border-t border-slate-100 pt-6">
                <a href="{{ route('categories.index') }}" class="px-5 py-2.5 text-sm font-semibold text-slate-500 hover:text-slate-700 bg-transparent hover:bg-slate-100 rounded-xl transition-all duration-200">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                    Perbarui Kategori
                </button>
            </div>
            
        </form>
    </div>
</div>
@endsection