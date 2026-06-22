<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemRequest; // Wajib di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Wajib di-import untuk mengambil ID user yang login

class StaffController extends Controller
{
    // 1. Menampilkan daftar katalog barang
    public function index(Request $request)
    {
        // Ambil data request milik user yang sedang login saja
        $query = ItemRequest::with('item')
                            ->where('user_id', auth()->id())
                            ->latest();

        // 1. Filter Pencarian berdasarkan nama barang
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('item', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // 2. Filter Status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $requests = $query->get();

        return view('pengguna.items.history', compact('requests'));
    }

    // 2. Memproses pengajuan permintaan barang
    public function storeRequest(Request $request)
    {
        // Validasi input
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string|max:500'
        ]);

        $item = Item::findOrFail($request->item_id);

        // Mencegah request jika jumlahnya melebihi stok gudang saat ini
        if ($request->quantity > $item->stock) {
            return back()->with('error', 'Pengajuan gagal. Jumlah permintaan melebihi sisa stok yang tersedia di gudang.');
        }

        // Simpan ke database dengan status default 'pending'
        ItemRequest::create([
            'user_id' => Auth::id(),
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
            'note' => $request->note,
            'status' => 'pending' // Menunggu persetujuan Admin
        ]);

        return back()->with('success', 'Permintaan barang berhasil diajukan! Silakan pantau statusnya di menu Riwayat Permintaan.');
    }

    // 3. Menampilkan riwayat permintaan khusus untuk user yang sedang login
    public function requestHistory()
    {
        // Mengambil data request milik user ini saja, lengkap dengan relasi nama barangnya
        $requests = ItemRequest::with('item')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
            
        return view('pengguna.items.history', compact('requests'));
    }
}