<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction; // <-- Tambahkan baris ini
use App\Models\Category; // ini untuk filter cari/filet cari kategori
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    // Laporan Semua Data Barang
    public function itemsReport(Request $request)
    {
        // Mulai query pemanggilan data barang
        $query = Item::with('category')->latest();

        // 1. Jika ada input pencarian (Search)
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // 2. Jika ada filter Kategori yang dipilih
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Eksekusi query
        $items = $query->get();

        // Ambil semua data kategori untuk ditampilkan di pilihan dropdown
        $categories = Category::orderBy('name', 'asc')->get();

        return view('super_admin.reports.index', compact('items', 'categories'));
    }

    // Laporan Semua Transaksi
    public function transactionsReport(Request $request)
    {
        // Mulai query pemanggilan data transaksi beserta relasi item-nya
        $query = Transaction::with('item')->latest();

        // 1. Filter Pencarian (Cari berdasarkan Keterangan ATAU Nama Barang di tabel relasi)
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

        $transactions = $query->get(); 
        
        return view('super_admin.reports.index2', compact('transactions'));
    }
    public function exportItemsPdf()
    {
        $items = Item::with('category')->latest()->get();
        
        // Memuat view khusus PDF
        $pdf = Pdf::loadView('super_admin.print.index', compact('items'));
        
        // Mengunduh file PDF
        return $pdf->download('Laporan_Data_Barang.pdf');
    }

    // Fungsi Cetak PDF Transaksi
    public function exportTransactionsPdf()
    {
        // Ambil semua transaksi
        $transactions = Transaction::with('item')->latest()->get();
        
        // Kita arahkan ke file view PDF khusus transaksi di folder print
        $pdf = Pdf::loadView('super_admin.print.index2', compact('transactions'));
        
        return $pdf->download('Laporan_Riwayat_Transaksi.pdf');
    }
}