<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Menambahkan kolom latitude dan longitude untuk kemudahan query lokasi
     * Data ini juga tersimpan di JSON delivery, tapi kolom terpisah memudahkan:
     * - Query berdasarkan radius/jarak
     * - Indexing untuk performa
     * - Integrasi dengan map services
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Koordinat lokasi pengiriman (user)
            $table->decimal('latitude', 10, 7)->nullable()->after('delivery');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            
            // Koordinat toko (untuk referensi)
            $table->decimal('latitude_toko', 10, 7)->nullable()->after('longitude');
            $table->decimal('longitude_toko', 10, 7)->nullable()->after('latitude_toko');
            
            // Jarak dan ongkir
            $table->decimal('jarak_km', 8, 2)->nullable()->after('longitude_toko')->comment('Jarak dari toko ke customer dalam KM');
            $table->integer('ongkir')->nullable()->after('jarak_km')->comment('Ongkos kirim dalam Rupiah');
            
            // Index untuk query berdasarkan lokasi
            $table->index(['latitude', 'longitude']);
            $table->index('jarak_km');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['latitude', 'longitude']);
            $table->dropIndex(['jarak_km']);
            $table->dropColumn(['latitude', 'longitude', 'latitude_toko', 'longitude_toko', 'jarak_km', 'ongkir']);
        });
    }
};
