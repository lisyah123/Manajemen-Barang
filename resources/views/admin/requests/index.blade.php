@extends('layouts.admin')

@section('title', 'Persetujuan Permintaan Barang')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <h1 class="text-2xl font-bold text-slate-800">Persetujuan Permintaan</h1>
        <p class="text-sm text-slate-500 mt-1">Kelola dan tinjau pengajuan barang dari Staff. Menyetujui permintaan akan otomatis memotong stok gudang.</p>
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

    @if(session('error'))
        <div class="rounded-xl bg-rose-50 border border-rose-200 p-4 flex items-start shadow-sm">
            <div class="flex-shrink-0 bg-rose-100 p-1.5 rounded-full mt-0.5">
                <svg class="h-4 w-4 text-rose-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-bold text-rose-800">Gagal Diproses</h3>
                <p class="mt-1 text-sm font-medium text-rose-600">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200">
        <form action="{{ route('admin.requests.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
            
            <div class="w-full md:flex-1">
                <label for="search" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Cari Permintaan</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Cari nama staff, barang, atau catatan..." class="block w-full pl-10 pr-4 py-2.5 text-sm text-slate-800 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all outline-none hover:border-blue-300">
                </div>
            </div>

            <div class="w-full md:w-64">
                <label for="status" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Status Permintaan</label>
                <select name="status" id="status" class="block w-full px-4 py-2.5 text-sm text-slate-800 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all outline-none hover:border-blue-300 cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu (Pending)</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <div class="flex items-center gap-2 w-full md:w-auto">
                <button type="submit" class="w-full md:w-auto px-6 py-2.5 bg-slate-800 hover:bg-slate-700 text-white text-sm font-bold rounded-xl shadow-md hover:shadow-lg transition-all flex items-center justify-center">
                    Cari
                </button>
                
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.requests.index') }}" class="w-full md:w-auto px-4 py-2.5 bg-slate-100 hover:bg-rose-50 text-slate-500 hover:text-rose-600 border border-slate-200 hover:border-rose-200 text-sm font-bold rounded-xl transition-all flex items-center justify-center" title="Hapus Filter">
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
                        <th scope="col" class="px-6 py-4">Waktu Pengajuan</th>
                        <th scope="col" class="px-6 py-4">Nama Peminta</th>
                        <th scope="col" class="px-6 py-4">Detail Barang</th>
                        <th scope="col" class="px-6 py-4 text-center">Jumlah</th>
                        <th scope="col" class="px-6 py-4 text-center">Status</th>
                        <th scope="col" class="px-6 py-4 text-center">Aksi Admin</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    
                    @forelse($requests as $index => $request)
                        <tr class="hover:bg-slate-50 transition-colors duration-200">
                            <td class="px-6 py-4 text-center text-slate-500 font-medium">{{ $index + 1 }}</td>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-slate-800 font-bold">{{ $request->created_at->format('d M Y') }}</div>
                                <div class="text-xs text-slate-500 font-medium mt-0.5">{{ $request->created_at->format('H:i') }} WIB</div>
                            </td>
                            
                            <td class="px-6 py-4 font-bold text-slate-800">
                                {{ $request->user ? $request->user->name : 'User Dihapus' }}
                            </td>
                            
                            <td class="px-6 py-4">
                                <div class="font-bold text-blue-600">{{ $request->item ? $request->item->name : 'Barang Dihapus' }}</div>
                                @if($request->note)
                                    <div class="text-xs text-slate-500 mt-1 italic leading-relaxed line-clamp-2 max-w-xs">
                                        "{{ $request->note }}"
                                    </div>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 text-center">
                                <span class="font-black text-lg text-slate-800">{{ $request->quantity }}</span>
                            </td>
                            
                            <td class="px-6 py-4 text-center">
                                @if($request->status === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-amber-50 text-amber-600 border border-amber-200 uppercase tracking-widest">
                                        Menunggu
                                    </span>
                                @elseif($request->status === 'approved')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-emerald-50 text-emerald-600 border border-emerald-200 uppercase tracking-widest">
                                        Disetujui
                                    </span>
                                @elseif($request->status === 'rejected')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-rose-50 text-rose-600 border border-rose-200 uppercase tracking-widest">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 text-center">
                                @if($request->status === 'pending')
                                    <div class="flex items-center justify-center gap-2">
                                        
                                        <form action="{{ route('admin.requests.approve', $request->id) }}" method="POST" onsubmit="return confirm('Yakin ingin MENYETUJUI permintaan ini? Stok barang akan otomatis terpotong sebanyak {{ $request->quantity }}.');">
                                            @csrf
                                            <button type="submit" class="px-3 py-1.5 bg-emerald-500 hover:bg-emerald-400 text-white text-xs font-bold rounded-lg shadow-sm hover:shadow-md transition-all flex items-center" title="Setujui dan Potong Stok">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                                Setujui
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.requests.reject', $request->id) }}" method="POST" onsubmit="return confirm('Yakin ingin MENOLAK permintaan ini?');">
                                            @csrf
                                            <button type="submit" class="px-3 py-1.5 bg-rose-500 hover:bg-rose-400 text-white text-xs font-bold rounded-lg shadow-sm hover:shadow-md transition-all flex items-center" title="Tolak Permintaan">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Tolak
                                            </button>
                                        </form>

                                    </div>
                                @else
                                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest bg-slate-100 px-2 py-1 rounded-md border border-slate-200">
                                        Selesai
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center text-slate-500">
                                <div class="bg-slate-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-slate-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                    </svg>
                                </div>
                                @if(request('search') || request('status'))
                                    <p class="text-base font-bold text-slate-700">Permintaan tidak ditemukan.</p>
                                    <p class="text-sm mt-1">Silakan coba kata kunci atau filter status yang berbeda.</p>
                                @else
                                    <p class="text-base font-bold text-slate-700">Belum ada permintaan dari Staff.</p>
                                    <p class="text-sm mt-1">Pengajuan pengambilan barang dari Staff akan otomatis muncul di sini.</p>
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