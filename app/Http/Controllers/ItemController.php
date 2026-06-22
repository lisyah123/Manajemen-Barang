<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category; // Wajib di-import untuk mengambil data kategori
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data kategori untuk ditampilkan di pilihan Dropdown Filter
        $categories = Category::orderBy('name', 'asc')->get();

        // 2. Mulai query pemanggilan data barang
        $query = Item::with('category')->latest();

        // 3. Jika ada input pencarian (Search)
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // 4. Jika ada filter Kategori yang dipilih
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Eksekusi query
        $items = $query->get();

        return view('admin.items.index', compact('items', 'categories'));
    }
    public function create()
    {
        // Mengambil semua data kategori untuk ditampilkan di dropdown (select) form
        $categories = Category::all();
        return view('admin.items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi file gambar maks 2MB
        ]);

        // Logika Upload Gambar
        if ($request->hasFile('image')) {
            // Simpan gambar ke folder storage/app/public/items
            $validated['image'] = $request->file('image')->store('items', 'public');
        }

        Item::create($validated);

        return redirect()->route('items.index')->with('success', 'Barang baru berhasil ditambahkan.');
    }

    public function edit(Item $item)
    {
        // Ambil semua kategori untuk dropdown form edit
        $categories = Category::all();
        return view('admin.items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $item = Item::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Logika Update Gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            // Simpan gambar baru
            $validated['image'] = $request->file('image')->store('items', 'public');
        }

        $item->update($validated);

        return redirect()->route('items.index')->with('success', 'Data barang berhasil diperbarui.');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Data barang berhasil dihapus!');
    }

    public function katalogPengguna(Request $request)
    {
        // 1. Ambil data kategori untuk filter
        $categories = Category::orderBy('name', 'asc')->get();

        // 2. Mulai query pemanggilan data barang
        $query = Item::with('category')->latest();

        // 3. Filter Pencarian Nama/Deskripsi
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // 4. Filter Kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Eksekusi query
        $items = $query->get();

        // Return ke view milik pengguna/staff
        return view('pengguna.items.index', compact('items', 'categories'));
    }
}