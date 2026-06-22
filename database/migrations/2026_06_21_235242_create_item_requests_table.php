<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('item_requests', function (Blueprint $table) {
            $table->id();
            // Relasi ke User (Staff) yang meminta barang
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();         
            // Relasi ke Item (Barang) yang diminta
            $table->foreignId('item_id')->constrained('items')->cascadeOnDelete();            
            $table->integer('quantity');
            // Status default otomatis 'pending' saat pertama kali diajukan
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            // Alasan atau tujuan permintaan barang
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_requests');
    }
};
