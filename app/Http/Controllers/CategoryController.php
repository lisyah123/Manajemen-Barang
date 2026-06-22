<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // READ: Menampilkan halaman daftar kategori
    public function index()
    {
        // Mengambil semua data kategori dari database, diurutkan dari yang terbaru
        $categories = Category::latest()->get(); 
        
        // Melempar data ke tampilan (View)
        return view('super_admin.categories.index', compact('categories'));
    }

    // CREATE: Menampilkan form tambah kategori
    public function create()
    {
        return view('super_admin.categories.create');
    }

    // STORE: Memproses penyimpanan data baru ke database
    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori sudah digunakan.',
        ]);

        // Simpan ke database
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Kembalikan ke halaman index dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // EDIT: Menampilkan form ubah data
    public function edit(Category $category)
    {
        return view('super_admin.categories.edit', compact('category'));
    }

    // UPDATE: Memproses perubahan data ke database
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        // Update data
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    // DELETE: Menghapus data dari database
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}