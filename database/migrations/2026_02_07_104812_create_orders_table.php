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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            // Kode pesanan unik (contoh: PB202502171234)
            $table->string('kode_pesanan')->unique();
            
            // Relasi ke user (nullable karena bisa guest checkout)
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            
            // Data customer dalam format JSON
            $table->json('customer');
            
            // Data pengiriman dalam format JSON
            $table->json('delivery');
            
            // Data pembayaran dalam format JSON
            $table->json('payment');
            
            // Data items/produk dalam format JSON
            $table->json('items');
            
            // Total harga
            $table->decimal('subtotal', 15, 2);
            $table->decimal('total', 15, 2);
            
            // Status
            $table->string('status_pesanan')->default('pending');
            $table->string('status_pembayaran')->default('belum_bayar');
            
            // Timestamps pesanan
            $table->timestamp('tanggal_pesanan');
            $table->timestamp('batas_pembayaran');
            
            // Catatan admin
            $table->text('catatan_admin')->nullable();
            
            $table->timestamps();
            
            // Index untuk pencarian cepat
            $table->index('kode_pesanan');
            $table->index('status_pesanan');
            $table->index('status_pembayaran');
            $table->index('tanggal_pesanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};