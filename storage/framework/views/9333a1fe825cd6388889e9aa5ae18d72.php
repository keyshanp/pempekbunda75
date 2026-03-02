<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? 'Dashboard'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Dashboard User</h1>
        
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Selamat datang, <?php echo e($user->name); ?>!</h2>
            <p class="text-gray-600 mb-4">Email: <?php echo e($user->email); ?></p>
            <p class="text-gray-600">Status: <?php echo e($user->is_admin ? 'Administrator' : 'User Biasa'); ?></p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold mb-2">Aksi Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="<?php echo e(route('produk.index')); ?>" class="text-blue-600 hover:underline">Lihat Produk</a></li>
                    <li><a href="<?php echo e(route('profile')); ?>" class="text-blue-600 hover:underline">Profil Saya</a></li>
                    <li><a href="<?php echo e(route('about')); ?>" class="text-blue-600 hover:underline">Tentang Kami</a></li>
                </ul>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold mb-2">Admin Panel</h3>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->is_admin): ?>
                    <a href="/admin" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        🚀 Buka Admin Panel
                    </a>
                <?php else: ?>
                    <p class="text-gray-500">Anda bukan administrator</p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
        
        <div class="mt-6">
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Logout
                </button>
            </form>
        </div>
    </div>
</body>
</html><?php /**PATH C:\laragon\www\pempekbunda75\resources\views/dashboard.blade.php ENDPATH**/ ?>