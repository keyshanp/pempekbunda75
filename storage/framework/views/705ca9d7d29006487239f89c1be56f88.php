<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin - Pempek Bunda 75</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Finger+Paint&family=Indie+Flower&family=Patrick+Hand&display=swap" rel="stylesheet">
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <style>
        /* Load RASCAL font */
        @font-face {
            font-family: 'RASCAL';
            src: url('<?php echo e(asset("fonts/RASCAL__.TTF")); ?>') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }
        
        .font-rascal { 
            font-family: 'RASCAL', sans-serif; 
        }

        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #FDFBF7;
            font-family: 'Patrick Hand', cursive;
        }

        .font-sketch { font-family: 'Finger Paint', cursive; }
        .font-hand { font-family: 'Patrick Hand', cursive; }
        .font-indie { font-family: 'Indie Flower', cursive; }
        
        .text-outline {
            -webkit-text-stroke: 1px #7c2d12;
            color: transparent;
        }
        
        .paper-texture {
            background-image: url('https://images.unsplash.com/photo-1586075010923-2dd4570fb338?q=80&w=1974&auto=format&fit=crop');
            background-size: cover;
            background-blend-mode: multiply;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #c48474 0%, #b06f5f 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(192, 132, 116, 0.3);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .form-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 100%;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <!-- Main Container - SATU ROOT ELEMENT -->
    <div class="w-full max-w-5xl min-h-fit md:min-h-[600px] bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row border-4 border-white">
        
        <!-- Left Section: Form -->
        <div class="w-full md:w-[45%] p-8 md:p-12 flex items-center justify-center">
            <div class="max-w-xs mx-auto w-full form-container">
                <!-- Title -->
                <h1 class="text-5xl md:text-6xl font-rascal text-[#7c2d12] mb-8 tracking-tighter text-center leading-none">
                    Admin Login
                </h1>

                <!-- PERBAIKAN: Form Livewire dengan wire:submit -->
                <form wire:submit.prevent="authenticate" class="space-y-4">
                    <!-- Email dengan wire:model -->
                    <div>
                        <input 
                            wire:model="email"
                            type="email" 
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:border-[#c48474] focus:ring-0 font-hand text-lg placeholder-gray-400 transition-colors"
                            placeholder="Email"
                            required 
                            autofocus
                        >
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-red-600 text-sm font-hand"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    
                    <!-- Password dengan wire:model -->
                    <div>
                        <input 
                            wire:model="password"
                            type="password" 
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:border-[#c48474] focus:ring-0 font-hand text-lg placeholder-gray-400 transition-colors"
                            placeholder="Password"
                            required
                        >
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-red-600 text-sm font-hand"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between mt-4">
                        <label class="flex items-center gap-2">
                            <input
                                wire:model="remember"
                                type="checkbox"
                                class="w-4 h-4 border-2 border-[#7c2d12] rounded bg-transparent focus:ring-0 accent-[#c48474]"
                            >
                            <span class="font-hand text-[#7c2d12] text-lg">Ingat saya</span>
                        </label>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4 pt-6">
                        <button
                            type="submit"
                            class="flex-1 btn-primary text-white font-hand text-2xl py-2 px-6 rounded-full shadow-lg transition-all active:scale-95"
                        >
                            Sign In
                        </button>
                    </div>
                </form>
                
                <!-- Back to Home -->
                <div class="mt-8 text-center">
                    <a href="<?php echo e(url('/')); ?>" class="font-hand text-[#7c2d12] text-lg hover:underline">
                        ← Kembali ke halaman utama
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Section: Texture -->
        <div class="hidden md:block w-full md:w-[55%] relative overflow-hidden">
            <div class="absolute inset-0 bg-[#b5c276] paper-texture opacity-90"></div>
            <div class="absolute inset-0 bg-black/5 mix-blend-multiply"></div>
        </div>
    </div>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>


    <!-- Error Alert dengan Alpine.js -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
        <div x-data="{ show: true }" 
             x-show="show" 
             x-init="setTimeout(() => show = false, 5000)"
             class="fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-lg z-50">
            <ul class="list-disc pl-5">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </ul>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</body>
</html><?php /**PATH C:\laragon\www\pempekbunda75\resources\views/filament/pages/auth/admin-login.blade.php ENDPATH**/ ?>