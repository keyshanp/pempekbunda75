<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$admins = \App\Models\User::where('is_admin', 1)->get(['id', 'name', 'email']);

echo "=== ADMIN USERS ===\n\n";
foreach ($admins as $admin) {
    echo "ID: {$admin->id}\n";
    echo "Name: {$admin->name}\n";
    echo "Email: {$admin->email}\n";
    echo "---\n";
}
echo "\nTotal: " . $admins->count() . " admin users\n";
