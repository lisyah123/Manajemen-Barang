<?php

namespace App\Http\Controllers;

use App\Models\ItemRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Wajib di-import untuk keamanan transaksi database

class AdminRequestController extends Controller
{
    // Menampilkan semua daftar permintaan dari Staff
   public function index(Request $request)
    {
        // Mulai query dengan memanggil relasi user dan item
        $query = ItemRequest::with(['user', 'item'])->latest();

        // 1. Filter Pencarian (Cari berdasarkan Nama Peminta, Nama Barang, atau Catatan)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('note', 'like', "%{$search}%")
                  ->orWhereHas('user', function($qUser) use ($search) {
                      $qUser->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('item', function($qItem) use ($search) {
                      $qItem->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // 2. Filter Status Permintaan (Pending / Approved / Rejected)
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Eksekusi query
        $requests = $query->get();

        return view('admin.requests.index', compact('requests'));
    }

    // Fungsi untuk MENYETUJUI permintaan
    public function approve($id)
    {
        $itemRequest = ItemRequest::findOrFail($id);

        // Validasi: Pastikan statusnya masih pending
        if ($itemRequest->status !== 'pending') {
            return back()->with('error', 'Permintaan ini sudah diproses sebelumnya.');
        }

        // Validasi: Pastikan stok gudang masih cukup
        if ($itemRequest->item->stock < $itemRequest->quantity) {
            return back()->with('error', 'Gagal menyetujui! Stok barang saat ini tidak mencukupi.');
        }

        // DB Transaction: Memastikan semua proses sukses, jika ada 1 yang gagal, semua dibatalkan (Rollback)
        DB::transaction(function () use ($itemRequest) {
            // 1. Ubah status menjadi disetujui
            $itemRequest->update(['status' => 'approved']);

            // 2. Kurangi stok barang di tabel items
            $itemRequest->item->decrement('stock', $itemRequest->quantity);

            // 3. Catat riwayat otomatis ke tabel transactions
            Transaction::create([
                'item_id' => $itemRequest->item_id,
                'quantity' => $itemRequest->quantity,
                'type' => 'keluar',
                'date' => now(),
                'description' => 'Barang keluar (Disetujui dari permintaan: ' . $itemRequest->user->name . ')'
            ]);
        });

        return back()->with('success', 'Permintaan disetujui! Stok barang telah otomatis dipotong.');
    }

    // Fungsi untuk MENOLAK permintaan
    public function reject($id)
    {
        $itemRequest = ItemRequest::findOrFail($id);

        if ($itemRequest->status !== 'pending') {
            return back()->with('error', 'Permintaan ini sudah diproses sebelumnya.');
        }

        // Hanya ubah status, tidak ada stok yang dikurangi
        $itemRequest->update(['status' => 'rejected']);

        return back()->with('success', 'Permintaan telah ditolak.');
    }
}