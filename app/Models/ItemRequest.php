<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'quantity',
        'status',
        'note',
    ];

    // Permintaan ini diajukan oleh satu User (Staff)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Permintaan ini untuk satu Item (Barang)
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
