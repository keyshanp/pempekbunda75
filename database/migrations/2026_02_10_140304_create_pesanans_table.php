<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pesanan')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('nama_pemesan');
            $table->string('email')->nullable();
            $table->string('telepon');
            $table->text('alamat_pengiriman');
            $table->enum('metode_pengiriman', ['ambil_ditempat', 'delivery'])->default('ambil_ditempat');
            $table->enum('status_pesanan', ['pending', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])->default('pending');
            $table->enum('status_pembayaran', ['belum_bayar', 'menunggu_konfirmasi', 'lunas', 'gagal'])->default('belum_bayar');
            $table->decimal('total_harga', 15, 2);
            $table->decimal('ongkos_kirim', 15, 2)->default(0);
            $table->decimal('total_bayar', 15, 2);
            $table->text('catatan')->nullable();
            $table->timestamp('tanggal_pesanan')->useCurrent();
            $table->timestamp('tanggal_selesai')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};