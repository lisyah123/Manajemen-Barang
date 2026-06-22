@extends('layouts.pengguna')

@section('title', 'Katalog Barang')

@section('content')
<div class="max-w-7xl mx-auto space-y-6 relative">
    
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 relative z-10">
        <h1 class="text-2xl font-bold text-slate-800">Katalog Ketersediaan Barang</h1>
        <p class="text-sm text-slate-500 mt-1">Lihat informasi dan ajukan permintaan pengambilan barang ke Admin Gudang.</p>
    </div>

    @if(session('success'))
        <div class="rounded-xl bg-emerald-50 border border-emerald-200 p-4 flex items-center shadow-sm relative z-10">
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

    @if(session('error'))
        <div class="rounded-xl bg-rose-50 border border-rose-200 p-4 flex items-start shadow-sm relative z-10">
            <div class="flex-shrink-0 bg-rose-100 p-1.5 rounded-full mt-0.5">
                <svg class="h-4 w-4 text-rose-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-bold text-rose-800">Gagal Memproses</h3>
                <p class="mt-1 text-sm font-medium text-rose-600">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200 relative z-10">
        <form action="{{ route('pengguna.items.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
            
            <div class="w-full md:flex-1">
                <label for="search" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Cari Barang</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Ketik nama barang..." class="block w-full pl-10 pr-4 py-2.5 text-sm text-slate-800 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all outline-none">
                </div>
            </div>

            <div class="w-full md:w-64">
                <label for="category" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Filter Kategori</label>
                <select name="category" id="category" class="block w-full px-4 py-2.5 text-sm text-slate-800 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all outline-none cursor-pointer">
                    <option value="">Semua Kategori</option>
                    @if(isset($categories))
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="flex items-center gap-2 w-full md:w-auto">
                <button type="submit" class="w-full md:w-auto px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold rounded-xl shadow-md transition-all flex items-center justify-center">
                    Cari
                </button>
                
                @if(request('search') || request('category'))
                    <a href="{{ route('pengguna.items.index') }}" class="w-full md:w-auto px-4 py-2.5 bg-slate-100 hover:bg-rose-50 text-slate-500 hover:text-rose-600 border border-slate-200 text-sm font-bold rounded-xl transition-all flex items-center justify-center" title="Hapus Filter">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                @endif
            </div>

        </form>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm relative z-10">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-500 font-bold uppercase text-[11px] tracking-wider border-b border-slate-200">
                    <tr>
                        <th scope="col" class="px-6 py-4 w-16 text-center">No</th>
                        <th scope="col" class="px-6 py-4 text-center">Foto</th>
                        <th scope="col" class="px-6 py-4">Nama Barang</th>
                        <th scope="col" class="px-6 py-4">Kategori</th>
                        <th scope="col" class="px-6 py-4 text-center">Status Stok</th>
                        <th scope="col" class="px-6 py-4 text-center w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    
                    @forelse($items as $index => $item)
                        <tr class="hover:bg-slate-50 transition-colors duration-200">
                            <td class="px-6 py-4 text-center text-slate-500 font-medium">{{ $index + 1 }}</td>
                            
                            <td class="px-6 py-4 flex justify-center">
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="h-12 w-12 object-cover rounded-lg shadow-sm border border-slate-200 transition-transform hover:scale-150 cursor-pointer">
                                @else
                                    <div class="h-12 w-12 rounded-lg bg-slate-50 border border-slate-200 flex flex-col items-center justify-center text-[9px] text-slate-400 text-center leading-tight font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mb-0.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                        No Pic
                                    </div>
                                @endif
                            </td>

                            <td class="px-6 py-4 font-bold text-slate-800">{{ $item->name }}</td>
                            <td class="px-6 py-4 font-medium text-blue-600">{{ $item->category ? $item->category->name : '-' }}</td>
                            
                            <td class="px-6 py-4 text-center">
                                @if($item->stock > 0)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Tersedia ({{ $item->stock }})
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                        Kosong
                                    </span>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 text-center">
                                @if($item->stock > 0)
                                    <button onclick="openModal('modal-{{ $item->id }}')" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold rounded-xl shadow-md transition-all flex items-center justify-center mx-auto transform hover:-translate-y-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                        Ajukan
                                    </button>
                                @else
                                    <span class="text-slate-400 text-xs font-medium italic bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100">Stok Habis</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-slate-500">
                                <div class="bg-slate-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-slate-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                    </svg>
                                </div>
                                <p class="text-base font-bold text-slate-700">Barang tidak ditemukan.</p>
                                <p class="text-sm mt-1">Coba gunakan nama atau kategori yang berbeda.</p>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($items as $item)
    @if($item->stock > 0)
    <div id="modal-{{ $item->id }}" class="hidden fixed inset-0 z-[9999] items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4 transition-opacity">
        <div class="bg-white border border-slate-200 rounded-2xl w-full max-w-md p-6 text-left shadow-2xl transform transition-all relative">
            
            <button onclick="closeModal('modal-{{ $item->id }}')" class="absolute top-4 right-4 p-1 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="flex items-center gap-3 mb-6 border-b border-slate-100 pb-4">
                @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" class="w-12 h-12 rounded-lg object-cover border border-slate-200 shadow-sm">
                @else
                    <div class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center text-blue-500 border border-blue-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" /></svg>
                    </div>
                @endif
                <div>
                    <h3 class="text-lg font-black text-slate-800 leading-tight">Pengajuan Barang</h3>
                    <p class="text-sm font-bold text-blue-600">{{ $item->name }}</p>
                </div>
            </div>
            
            <form action="{{ route('pengguna.request.store') }}" method="POST">
                @csrf
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                
                <div class="mb-4">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Jumlah Diminta <span class="text-xs font-normal text-slate-400 ml-1">(Maksimal: {{ $item->stock }})</span></label>
                    <input type="number" name="quantity" min="1" max="{{ $item->stock }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 font-bold focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all">
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Catatan / Alasan Keperluan</label>
                    <textarea name="note" rows="3" required placeholder="Contoh: Untuk keperluan meeting mingguan divisi marketing..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all"></textarea>
                </div>
                
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeModal('modal-{{ $item->id }}')" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition-colors rounded-xl border border-transparent hover:border-slate-200">Batal</button>
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold rounded-xl transition-all shadow-md hover:shadow-lg flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" /></svg>
                        Kirim Pengajuan
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
@endforeach

<script>
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection