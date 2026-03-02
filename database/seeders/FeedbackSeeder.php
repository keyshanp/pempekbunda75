<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Feedback;
use Carbon\Carbon;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * MEMBUAT DATA DUMMY UNTUK TESTING
     */
    public function run(): void
    {
        $tags = [
            '🍜 Pempeknya enak',
            '🚚 Kilat pengirimannya',
            '😄 Adminnya ramah',
            '💰 Harga worth it',
            '📦 Packing rapi',
            '⭐ Porsi pas',
            '🔥 Sambelnya nampol',
        ];

        $reviews = [
            'Pempeknya enak banget! Teksturnya lembut dan cukonya mantap. Recommended!',
            'Pengiriman cepat, packing rapi. Bakal order lagi nih!',
            'Harga worth it dengan kualitas. Admin ramah, respon cepat.',
            'Mantap! Sambelnya nampol banget. Cocok buat yang suka pedas.',
            'Enak, cuma agak lama deliverynya. Tapi overall puas.',
            'Porsi pas, packing aman. Recommended buat cemilan keluarga.',
        ];

        for ($i = 1; $i <= 15; $i++) {
            $rating = rand(3, 5);
            $numTags = rand(2, 4);
            $selectedTags = [];
            
            for ($j = 0; $j < $numTags; $j++) {
                $selectedTags[] = $tags[array_rand($tags)];
            }
            
            Feedback::create([
                'kode_pesanan' => 'TEST-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'user_name' => 'Customer Test ' . $i,
                'user_email' => 'customer' . $i . '@test.com',
                'rating' => $rating,
                'tags' => array_unique($selectedTags),
                'review' => $reviews[array_rand($reviews)],
                'created_at' => Carbon::now()->subDays(rand(0, 30)),
            ]);
        }

        echo "✅ " . Feedback::count() . " feedback berhasil dibuat!\n";
    }
}