<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            
            // PERBAIKAN: tambahkan nama tabel explicit
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            
            $table->integer('harga');
            $table->integer('stok')->default(0);
            $table->string('gambar')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('berat')->nullable();
            $table->integer('diskon')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};