<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * INI HANYA MEMBUAT TABEL BARU, TIDAK MENGHAPUS APAPUN
     */
    public function up(): void
    {
        // Cek dulu apakah tabel sudah ada
        if (!Schema::hasTable('feedback')) {
            Schema::create('feedback', function (Blueprint $table) {
                $table->id();
                $table->string('kode_pesanan')->unique();
                $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
                $table->string('user_name')->nullable();
                $table->string('user_email')->nullable();
                $table->integer('rating')->unsigned();
                $table->json('tags')->nullable();
                $table->text('review')->nullable();
                $table->timestamps();
                
                // Indexes
                $table->index('kode_pesanan');
                $table->index('user_id');
                $table->index('rating');
                $table->index('created_at');
            });
            
            echo "✅ Tabel feedback berhasil dibuat!\n";
        } else {
            echo "⚠️ Tabel feedback sudah ada, tidak perlu dibuat ulang.\n";
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // HAPUS TABEL (INI OPSIONAL, JALANKAN KALAU MAU HAPUS)
        // Schema::dropIfExists('feedback');
    }
};