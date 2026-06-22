@extends('layouts.pengguna')

@section('title', 'Riwayat Permintaan Barang')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <h1 class="text-2xl font-bold text-slate-800">Riwayat Permintaan Anda</h1>
        <p class="text-sm text-slate-500 mt-1">Pantau status persetujuan barang yang telah Anda ajukan ke Admin.</p>
    </div>

    <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200">
        <form action="{{ route('pengguna.items.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="w-full md:flex-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Cari Barang</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang..." class="block w-full px-4 py-2.5 text-sm text-slate-800 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 transition-all outline-none">
            </div>
            <div class="w-full md:w-64">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Status</label>
                <select name="status" class="block w-full px-4 py-2.5 text-sm text-slate-800 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold rounded-xl transition-all">Cari</button>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-500 font-bold uppercase text-[11px] tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-center">No</th>
                        <th class="px-6 py-4">Waktu Pengajuan</th>
                        <th class="px-6 py-4">Nama Barang</th>
                        <th class="px-6 py-4 text-center">Jumlah</th>
                        <th class="px-6 py-4">Catatan</th>
                        <th class="px-6 py-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($requests as $index => $request)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 text-center text-slate-500 font-medium">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-bold text-slate-800">{{ $request->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4 font-bold text-blue-600">{{ $request->item ? $request->item->name : 'Barang Dihapus' }}</td>
                            <td class="px-6 py-4 text-center font-bold text-slate-800">{{ $request->quantity }}</td>
                            <td class="px-6 py-4 text-slate-500 truncate max-w-[200px]">{{ $request->note ?: '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                @if($request->status === 'pending')
                                    <span class="px-3 py-1 rounded-md text-[10px] font-bold bg-amber-50 text-amber-600 border border-amber-200 uppercase tracking-widest">Menunggu</span>
                                @elseif($request->status === 'approved')
                                    <span class="px-3 py-1 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-200 uppercase tracking-widest">Disetujui</span>
                                @else
                                    <span class="px-3 py-1 rounded-md text-[10px] font-bold bg-rose-50 text-rose-600 border border-rose-200 uppercase tracking-widest">Ditolak</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-slate-500">
                                <p>Belum ada riwayat permintaan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection