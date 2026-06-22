<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Tambahkan baris ini untuk mengizinkan mass-assignment
    protected $fillable = [
        'name',
        'description',
    ];
}
