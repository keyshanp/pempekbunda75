<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            // Hapus foreign key constraint dulu
            if (Schema::hasColumn('produks', 'kategori_id')) {
                $table->dropForeign(['kategori_id']);
                $table->dropColumn('kategori_id');
            }
            
            // Hapus kolom yang tidak diperlukan
            if (Schema::hasColumn('produks', 'slug')) {
                $table->dropColumn('slug');
            }
            
            if (Schema::hasColumn('produks', 'diskon')) {
                $table->dropColumn('diskon');
            }
            
            if (Schema::hasColumn('produks', 'berat')) {
                $table->dropColumn('berat');
            }
            
            // Ubah status default
            if (Schema::hasColumn('produks', 'status')) {
                $table->boolean('status')->default(true)->change();
            }
        });
    }

    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            // Kembalikan kolom jika rollback
            $table->foreignId('kategori_id')->nullable()->constrained('kategoris')->after('deskripsi');
            $table->string('slug')->nullable()->after('nama_produk');
            $table->integer('diskon')->default(0)->after('harga');
            $table->integer('berat')->nullable()->after('stok');
        });
    }
};