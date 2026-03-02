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
    Schema::create('pembelians', function (Blueprint $table) {
        $table->id();
        $table->string('kode_pembelian')->unique();
        $table->dateTime('tanggal');
        $table->integer('total')->default(0);
        $table->string('status')->default('pending'); // pending | lunas
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelians');
    }
};
