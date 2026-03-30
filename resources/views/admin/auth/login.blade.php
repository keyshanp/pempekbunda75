<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - PempekBunda 75</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Finger+Paint&family=Indie+Flower&family=Patrick+Hand&display=swap" rel="stylesheet">
    <style>
        .font-sketch { font-family: 'Finger Paint', cursive; }
        .font-hand { font-family: 'Patrick Hand', cursive; }
        .font-indie { font-family: 'Indie Flower', cursive; }
        
        .text-outline {
            -webkit-text-stroke: 1px #7c2d12;
            color: transparent;
        }
        
        .paper-texture {
            background-image: linear-gradient(45deg, #1e293b 25%, transparent 25%),
                              linear-gradient(-45deg, #1e293b 25%, transparent 25%),
                              linear-gradient(45deg, transparent 75%, #1e293b 75%),
                              linear-gradient(-45deg, transparent 75%, #1e293b 75%);
            background-size: 20px 20px;
            background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
            opacity: 0.9;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(14, 165, 233, 0.3);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .btn-admin {
            background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%);
        }
        
        .btn-admin:hover {
            box-shadow: 0 10px 20px rgba(124, 58, 237, 0.3);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .admin-badge {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: bold;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-900 to-gray-900 min-h-screen flex items-center justify-center p-4">
    <!-- Main Container -->
    <div class="w-full max-w-5xl h-full md:h-[650px] glass-effect rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row border-4 border-white/10">
        
        <!-- Left Section: Form -->
        <div class="w-full md:w-[45%] p-8 md:p-12 flex flex-col justify-center bg-white/95 backdrop-blur-sm">
            <div class="max-w-xs mx-auto w-full">
                <!-- Title & Badge -->
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-5xl md:text-6xl font-sketch text-slate-800 tracking-tighter">
                        Admin
                    </h1>
                    <span class="admin-badge font-hand animate-pulse">
                        🔐 SECURE
                    </span>
                </div>

                <!-- Welcome Text -->
                <p class="font-hand text-slate-600 text-lg mb-8">
                    Selamat datang kembali, Administrator! <br>
                    <span class="text-sm text-slate-500">Silakan masuk ke dashboard admin.</span>
                </p>

                <!-- Form -->
                <form method="POST" action="{{ route('admin.login') }}" class="space-y-4" id="adminLoginForm">
                    @csrf
                    
                    <!-- Email -->
                    <div class="relative">
                        <label for="email" class="block font-hand text-slate-700 mb-2 text-lg">
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Email Administrator
                            </span>
                        </label>
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            value="{{ old('email') }}"
                            class="w-full px-4 py-3 border-2 border-slate-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 font-hand text-lg placeholder-slate-400 transition-all bg-white/80"
                            placeholder="admin@pempekbunda75.com"
                            required 
                            autofocus
                            autocomplete="username"
                        >
                        @error('email')
                            <p class="mt-1 text-red-600 text-sm font-hand">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Password -->
                    <div class="relative">
                        <label for="password" class="block font-hand text-slate-700 mb-2 text-lg">
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                Password
                            </span>
                        </label>
                        <div class="relative">
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                class="w-full px-4 py-3 border-2 border-slate-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 font-hand text-lg placeholder-slate-400 transition-all bg-white/80 pr-10"
                                placeholder="••••••••"
                                required
                                autocomplete="current-password"
                            >
                            <button type="button" 
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-slate-400 hover:text-blue-600 transition-colors"
                                    onclick="togglePassword('password')">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-red-600 text-sm font-hand">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between mt-6">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <div class="relative">
                                <input
                                    id="remember"
                                    name="remember"
                                    type="checkbox"
                                    class="sr-only"
                                    {{ old('remember') ? 'checked' : '' }}
                                >
                                <div class="w-5 h-5 border-2 border-slate-400 rounded flex items-center justify-center">
                                    <svg class="w-3 h-3 text-blue-600 opacity-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                            <span class="font-hand text-slate-700 text-lg select-none">Ingat saya</span>
                        </label>
                        
                        <a href="{{ route('admin.password.request') }}" class="font-hand text-blue-600 text-lg hover:text-blue-800 hover:underline transition-colors">
                            Lupa password?
                        </a>
                    </div>

                    <!-- Security Check -->
                    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <div>
                                <p class="font-hand text-blue-800 text-sm">
                                    <strong>Keamanan:</strong> Pastikan Anda berada di lingkungan yang aman sebelum login.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4 pt-8">
                        <button
                            type="submit"
                            class="flex-1 btn-primary text-white font-hand text-2xl py-3 px-6 rounded-xl shadow-lg transition-all active:scale-95 flex items-center justify-center gap-2"
                            id="submitBtn"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Login Admin
                        </button>
                    </div>
                    
                    <!-- Back to User Login -->
                    <div class="mt-6 text-center">
                        <a href="{{ route('login') }}" class="font-hand text-slate-600 text-lg hover:text-blue-600 hover:underline transition-colors inline-flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Kembali ke Login User
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Section: Admin Texture -->
        <div class="hidden md:block w-full md:w-[55%] h-full relative overflow-hidden">
            <!-- Dark Blue Paper Texture -->
            <div class="absolute inset-0 paper-texture"></div>
            
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900/30 to-purple-900/30"></div>
            
            <!-- Animated Icons -->
            <div class="absolute inset-0 flex flex-col items-center justify-center p-12">
                <!-- Shield Icon -->
                <div class="mb-8 animate-float">
                    <div class="w-32 h-32 bg-gradient-to-br from-blue-500/20 to-purple-500/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-20 h-20 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                </div>
                
                <!-- Decorative Text -->
                <div class="text-white/20 font-sketch text-6xl rotate-[-5deg] select-none text-center">
                    ADMIN<br>PANEL
                </div>
                
                <!-- Security Badge -->
                <div class="mt-8 bg-white/10 backdrop-blur-sm rounded-full px-6 py-2 border border-white/20">
                    <p class="font-hand text-white/70 text-sm">
                        ⚡ SSL Secured • 🔒 Encrypted • 🛡️ Protected
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Alert -->
    @if($errors->any())
        <div class="fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-xl z-50 max-w-md">
            <div class="flex items-start gap-3">
                <svg class="w-6 h-6 text-red-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <h3 class="font-hand font-bold text-lg">Login Gagal</h3>
                    <ul class="list-disc pl-5 mt-1">
                        @foreach($errors->all() as $error)
                            <li class="font-hand">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">
                    ✕
                </button>
            </div>
        </div>
    @endif
    
    <!-- Success Alert -->
    @if(session('status'))
        <div class="fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-xl z-50">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="font-hand">{{ session('status') }}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="text-green-500 hover:text-green-700">
                    ✕
                </button>
            </div>
        </div>
    @endif

    <script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = field.nextElementSibling.querySelector('svg');
        
        if (field.type === 'password') {
            field.type = 'text';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
        } else {
            field.type = 'password';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
        }
    }

    // Custom checkbox
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        const customCheckbox = checkbox.nextElementSibling;
        
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                customCheckbox.querySelector('svg').classList.remove('opacity-0');
                customCheckbox.classList.add('bg-blue-100', 'border-blue-500');
            } else {
                customCheckbox.querySelector('svg').classList.add('opacity-0');
                customCheckbox.classList.remove('bg-blue-100', 'border-blue-500');
            }
        });
    });

    // Form submission loading state
    document.getElementById('adminLoginForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.innerHTML;
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <div class="flex items-center justify-center gap-2">
                <div class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                Memverifikasi...
            </div>
        `;
        submitBtn.classList.add('opacity-75');
        
        // Jika form invalid, kembalikan button
        if (!this.checkValidity()) {
            setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
                submitBtn.classList.remove('opacity-75');
            }, 1000);
        }
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(() => {
        document.querySelectorAll('.fixed').forEach(alert => {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.5s';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);
    </script>
</body>
</html>
