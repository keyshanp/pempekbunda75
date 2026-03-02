<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_create_penjualans_table.php
public function up()
{
    Schema::create('penjualans', function (Blueprint $table) {
        $table->id();
        $table->string('kode_transaksi')->unique();
        $table->foreignId('produk_id')->constrained()->onDelete('cascade');
        $table->integer('quantity');
        $table->decimal('harga_satuan', 12, 2);
        $table->decimal('total_harga', 12, 2);
        $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
