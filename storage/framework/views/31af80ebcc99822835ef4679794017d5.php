<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Pempek Bunda 75</title>
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
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <!-- Main Container -->
    <div class="w-full max-w-5xl h-full md:h-[650px] bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row border-4 border-white">
        
        <!-- Left Section: Form -->
        <div class="w-full md:w-[45%] p-8 md:p-12 flex flex-col justify-center bg-white">
            <div class="max-w-xs mx-auto w-full">
                <!-- Title with RASCAL Font -->
                <h1 class="text-5xl md:text-6xl font-rascal text-[#7c2d12] mb-8 tracking-tighter text-center md:center leading-none">
                    Sign In
                </h1>

                <!-- Social Login -->
                <div class="flex justify-center md:center gap-6 mb-8">
                    <button class="w-12 h-12 rounded-full bg-white border-2 border-gray-300 flex items-center justify-center hover:border-[#c48474] transition-colors">
                        <svg class="w-6 h-6" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                    </button>
                    <button class="w-12 h-12 rounded-full bg-white border-2 border-gray-300 flex items-center justify-center hover:border-[#c48474] transition-colors">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </button>
                </div>

                <!-- Divider Text -->
                <p class="font-hand text-[#7c2d12] text-lg mb-6 text-center md:text-left">
                    atau gunakan email untuk masuk
                </p>

                <!-- Form -->
                <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    
                    <!-- Email -->
                    <div class="relative">
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            value="<?php echo e(old('email')); ?>"
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
                    
                    <!-- Password -->
                    <div class="relative">
                        <input 
                            id="password" 
                            name="password" 
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

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between mt-4">
                        <label class="flex items-center gap-2">
                            <input
                                id="remember"
                                name="remember"
                                type="checkbox"
                                class="w-4 h-4 border-2 border-[#7c2d12] rounded bg-transparent focus:ring-0 accent-[#c48474]"
                            >
                            <span class="font-hand text-[#7c2d12] text-lg">Ingat saya</span>
                        </label>
                        
                        <a href="#" class="font-hand text-[#7c2d12] text-lg hover:underline">
                            Lupa password?
                        </a>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4 pt-6">
                        <button
                            type="submit"
                            class="flex-1 btn-primary text-white font-hand text-2xl py-2 px-6 rounded-full shadow-lg transition-all active:scale-95"
                        >
                            Sign In
                        </button>
                        <a
                            href="<?php echo e(route('register')); ?>"
                            class="flex-1 btn-primary text-white font-hand text-2xl py-2 px-6 rounded-full shadow-lg transition-all active:scale-95 text-center"
                        >
                            Sign Up
                        </a>
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
                document.querySelector('.fixed').style.display = 'none';
            }, 5000);
        </script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    
    <!-- Success Alert -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?>
        <div class="fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-lg z-50">
            <?php echo e(session('status')); ?>

        </div>
        <script>
            setTimeout(() => {
                document.querySelector('.fixed').style.display = 'none';
            }, 5000);
        </script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    
    <!-- Font loading fallback -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if RASCAL font is loaded
            const rascalText = document.querySelector('.font-rascal');
            if (rascalText) {
                // Apply additional styling for RASCAL font
                rascalText.style.letterSpacing = '-0.02em';
                rascalText.style.fontWeight = '400';
                
                // Fallback font check
                setTimeout(() => {
                    const originalFontSize = window.getComputedStyle(rascalText).fontSize;
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
                    
                    // If font not loaded properly, adjust styling
                    if (Math.abs(width1 - width2) < 5) {
                        console.warn('RASCAL font may not be loaded properly');
                        rascalText.style.textShadow = '1px 1px 0 #7c2d12';
                    }
                }, 100);
            }
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\pempekbunda75\resources\views/auth/login.blade.php ENDPATH**/ ?>