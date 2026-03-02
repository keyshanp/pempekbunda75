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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            
            // Kode transaksi unik
            $table->string('kode_transaksi')->unique();
            
            // Relasi ke tabel orders - PERBAIKAN: tambahkan referensi explicit
            $table->foreignId('pesanan_id')->constrained('orders')->onDelete('cascade');
            
            // Metode pembayaran
            $table->enum('metode_pembayaran', [
                'cash', 
                'gopay', 
                'dana', 
                'ovo', 
                'shopeepay', 
                'qris', 
                'transfer_bank', 
                'kredit'
            ]);
            
            // Detail transfer bank (hanya jika metode = transfer_bank)
            $table->string('nama_bank')->nullable();
            $table->string('nomor_rekening')->nullable();
            $table->string('nama_pemilik_rekening')->nullable();
            
            // Jumlah pembayaran
            $table->decimal('jumlah_bayar', 15, 2);
            
            // Bukti pembayaran (path file)
            $table->string('bukti_pembayaran')->nullable();
            
            // Status transaksi
            $table->enum('status', [
                'pending', 
                'success', 
                'failed', 
                'expired'
            ])->default('pending');
            
            // Waktu-waktu penting
            $table->timestamp('waktu_pembayaran')->nullable();
            $table->timestamp('waktu_konfirmasi')->nullable();
            
            // Catatan tambahan
            $table->text('catatan')->nullable();
            
            $table->timestamps();
            
            // Index untuk optimasi query
            $table->index('kode_transaksi');
            $table->index('status');
            $table->index('pesanan_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};