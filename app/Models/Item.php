<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // Izinkan kolom-kolom ini diisi melalui form
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'stock',
        'image',
    ];

    // Relasi belongsTo (Item dimiliki oleh satu Category)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi: Satu Barang bisa memiliki Banyak Transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
