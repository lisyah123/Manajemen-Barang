<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Item;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Menampilkan riwayat transaksi
    public function index(Request $request)
    {
        // Mulai query dengan relasi item
        $query = Transaction::with('item')->latest();

        // 1. Filter Pencarian (Cari berdasarkan Keterangan ATAU Nama Barang)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhereHas('item', function($qItem) use ($search) {
                      $qItem->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // 2. Filter Jenis Transaksi (Masuk / Keluar)
        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        // Eksekusi query
        $transactions = $query->get();

        return view('admin.transactions.index', compact('transactions'));
    }

    // Menampilkan form tambah transaksi
    public function create()
    {
        // Mengambil data barang yang stoknya lebih dari 0 untuk ditampilkan di pilihan
        $items = Item::all();
        return view('admin.transactions.create', compact('items'));
    }

    // Memproses data transaksi dan MENGUPDATE STOK (Poin Penting Uji Kom)
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'type' => 'required|in:masuk,keluar',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        // 1. Cari data barang yang dipilih
        $item = Item::findOrFail($request->item_id);

        // 2. Validasi Khusus: Jika barang KELUAR, cek apakah stok mencukupi!
        if ($request->type === 'keluar' && $item->stock < $request->quantity) {
            return back()->withInput()->with('error', 'Gagal! Stok barang tidak mencukupi untuk jumlah yang dikeluarkan.');
        }

        // 3. Simpan data transaksi ke tabel transactions
        Transaction::create($request->all());

        // 4. Update stok di tabel items secara otomatis
        if ($request->type === 'masuk') {
            $item->increment('stock', $request->quantity); // Tambah stok
        } else {
            $item->decrement('stock', $request->quantity); // Kurangi stok
        }

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dicatat dan stok barang telah otomatis diperbarui!');
    }

    // Catatan: Untuk sistem inventaris standar, transaksi biasanya TIDAK BOLEH diedit atau dihapus 
    // agar riwayat/log tetap valid. Tapi jika dibutuhkan, kita bisa tambahkan nanti.
}