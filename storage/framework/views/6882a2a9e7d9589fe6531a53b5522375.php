<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - PempekBunda 75</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Finger+Paint&family=Indie+Flower&family=Patrick+Hand&display=swap" rel="stylesheet">
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

        /* Non-scrollable */
        html, body {
            height: 100vh;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-50 h-screen flex items-center justify-center p-4">
    <!-- Main Container -->
    <div class="w-full max-w-5xl h-full md:h-[750px] bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row border-4 border-white">
        
        <!-- Left Section: Form -->
        <div class="w-full md:w-[45%] p-8 md:p-12 flex flex-col justify-center bg-white overflow-y-auto">
            <div class="max-w-xs mx-auto w-full">
                <!-- Title with RASCAL Font -->
                <h1 class="text-5xl md:text-6xl font-rascal text-[#7c2d12] mb-8 tracking-tighter text-center leading-none">
                    Reset Password
                </h1>

                <!-- Description - CENTERED and ALIGNED with form below -->
                <p class="font-hand text-[#7c2d12] text-lg mb-8 text-center leading-relaxed">
                    Masukkan email dan password baru Anda.
                </p>

                <!-- Form -->
                <form method="POST" action="/forgot-password" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    
                    <!-- Email -->
                    <div class="relative">
                        <label class="font-hand text-[#7c2d12] text-sm block mb-1">Email</label>
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            value="<?php echo e(old('email')); ?>"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:border-[#c48474] focus:ring-0 font-hand text-lg placeholder-gray-400 transition-colors"
                            placeholder="nama@email.com"
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

                    <!-- Password Baru -->
                    <div class="relative">
                        <label class="font-hand text-[#7c2d12] text-sm block mb-1">Password Baru</label>
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:border-[#c48474] focus:ring-0 font-hand text-lg placeholder-gray-400 transition-colors"
                            placeholder="Password baru"
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

                    <!-- Confirm Password -->
                    <div class="relative">
                        <label class="font-hand text-[#7c2d12] text-sm block mb-1">Konfirmasi Password</label>
                        <input 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            type="password" 
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:border-[#c48474] focus:ring-0 font-hand text-lg placeholder-gray-400 transition-colors"
                            placeholder="Konfirmasi password"
                            required
                        >
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password_confirmation'];
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

                    <!-- Status Message -->
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?>
                        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg font-hand border border-green-400">
                            ✓ <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <!-- Button -->
                    <div class="pt-6">
                        <button
                            type="submit"
                            class="w-full btn-primary text-white font-hand text-2xl py-3 px-6 rounded-full shadow-lg transition-all active:scale-95"
                        >
                            Reset Password
                        </button>
                    </div>
                </form>
                
                <!-- Back to Login -->
                <div class="mt-8 text-center">
                    <a href="<?php echo e(route('login')); ?>" class="font-hand text-[#7c2d12] text-lg hover:underline">
                        ← Kembali ke login
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Section: Texture -->
        <div class="hidden md:block w-full md:w-[55%] h-full relative overflow-hidden">
            <!-- Green Paper Texture -->
            <div class="absolute inset-0 bg-[#b5c276] paper-texture opacity-90"></div>
            
            <!-- Extra crumpled effect -->
            <div class="absolute inset-0 bg-black/5 mix-blend-multiply"></div>
            
            <!-- Decorative Text -->
            <div class="absolute inset-0 flex items-center justify-center p-12">
                <!-- Optional: Add decorative elements here -->
            </div>
        </div>
    </div>

    <!-- Error Alert -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
        <div class="fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-lg z-50">
            <ul class="list-disc pl-5">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </ul>
        </div>
        <script>
            setTimeout(() => {
                const alert = document.querySelector('.fixed');
                if (alert) alert.style.display = 'none';
            }, 5000);
        </script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    
    <!-- Font loading fallback -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rascalText = document.querySelector('.font-rascal');
            if (rascalText) {
                rascalText.style.letterSpacing = '-0.02em';
                rascalText.style.fontWeight = '400';
                
                setTimeout(() => {
                    const testElement = document.createElement('span');
                    testElement.style.fontFamily = 'RASCAL, sans-serif';
                    testElement.style.fontSize = '100px';
                    testElement.style.position = 'absolute';
                    testElement.style.visibility = 'hidden';
                    testElement.innerHTML = 'S';
                    document.body.appendChild(testElement);
                    
                    const width1 = testElement.offsetWidth;
                    testElement.style.fontFamily = 'sans-serif';
                    const width2 = testElement.offsetWidth;
                    document.body.removeChild(testElement);
                    
                    if (Math.abs(width1 - width2) < 5) {
                        console.warn('RASCAL font may not be loaded properly');
                        rascalText.style.textShadow = '1px 1px 0 #7c2d12';
                    }
                }, 100);
            }
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\2maretpempekbundacode\pempekbunda75\resources\views/auth/forgot-password.blade.php ENDPATH**/ ?>