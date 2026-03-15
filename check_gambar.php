<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$prod = App\Models\Produk::first();
if (! $prod) {
    echo "No products found\n";
    exit;
}

echo "id=" . $prod->id . "\n";
echo "nama=" . $prod->nama_produk . "\n";
echo "gambar=" . $prod->gambar . "\n";
