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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            // relasi ke pembelian
            $table->foreignId('pembelian_id')
                ->constrained()
                ->cascadeOnDelete();

            // info pembayaran
            $table->decimal('total_bayar', 12, 2);
            $table->decimal('uang_dibayar', 12, 2);
            $table->decimal('kembalian', 12, 2)->default(0);

            $table->string('metode_pembayaran'); // cash, qris, transfer, dll
            $table->string('status')->default('lunas'); // lunas / belum

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
