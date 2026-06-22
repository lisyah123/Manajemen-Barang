<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Mengizinkan mass-assignment
    protected $fillable = [
        'item_id',
        'quantity',
        'type',
        'date',
        'description',
    ];

    // Relasi: Transaksi ini milik satu Item (Barang)
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
