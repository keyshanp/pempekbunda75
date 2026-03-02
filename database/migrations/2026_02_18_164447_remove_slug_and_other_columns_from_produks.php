<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            // Hapus foreign key kategori_id dulu
            if (Schema::hasColumn('produks', 'kategori_id')) {
                $table->dropForeign(['kategori_id']);
                $table->dropColumn('kategori_id');
            }
            
            // Hapus kolom slug
            if (Schema::hasColumn('produks', 'slug')) {
                $table->dropColumn('slug');
            }
            
            // Hapus kolom diskon
            if (Schema::hasColumn('produks', 'diskon')) {
                $table->dropColumn('diskon');
            }
            
            // Hapus kolom berat
            if (Schema::hasColumn('produks', 'berat')) {
                $table->dropColumn('berat');
            }
            
            // Hapus kolom deleted_at (soft delete) jika tidak dipakai
            if (Schema::hasColumn('produks', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            // Kembalikan kolom jika rollback
            $table->string('slug')->nullable()->after('nama_produk');
            $table->foreignId('kategori_id')->nullable()->constrained('kategoris')->after('deskripsi');
            $table->integer('diskon')->default(0)->after('harga');
            $table->integer('berat')->nullable()->after('stok');
            $table->softDeletes(); // untuk deleted_at
        });
    }
};