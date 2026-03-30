<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - PempekBunda 75</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Finger+Paint&family=Indie+Flower&family=Patrick+Hand&display=swap" rel="stylesheet">
    <style>
        /* Load RASCAL font */
        @font-face {
            font-family: 'RASCAL';
            src: url('{{ asset("fonts/RASCAL__.TTF") }}') format('truetype');
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

                <!-- Success Message -->
                @if (session('status'))
                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg font-hand border border-green-400">
                        ✓ {{ session('status') }}
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    
                    <!-- Email -->
                    <div class="relative">
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            value="{{ old('email') }}"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:border-[#c48474] focus:ring-0 font-hand text-lg placeholder-gray-400 transition-colors"
                            placeholder="Email"
                            required 
                            autofocus
                        >
                        @error('email')
                            <p class="mt-1 text-red-600 text-sm font-hand">{{ $message }}</p>
                        @enderror
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
                        @error('password')
                            <p class="mt-1 text-red-600 text-sm font-hand">{{ $message }}</p>
                        @enderror
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
                        
                        <a href="{{ route('password.request') }}" class="font-hand text-[#7c2d12] text-lg hover:underline">
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
                            href="{{ route('register') }}"
                            class="flex-1 btn-primary text-white font-hand text-2xl py-2 px-6 rounded-full shadow-lg transition-all active:scale-95 text-center"
                        >
                            Sign Up
                        </a>
                    </div>
                </form>
                
                <!-- Back to Home -->
                <div class="mt-8 text-center">
                    <a href="{{ url('/') }}" class="font-hand text-[#7c2d12] text-lg hover:underline">
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
    @if($errors->any())
        <div class="fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-lg z-50">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <script>
            setTimeout(() => {
                document.querySelector('.fixed').style.display = 'none';
            }, 5000);
        </script>
    @endif
    
    <!-- Success Alert -->
    @if(session('status'))
        <div class="fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-lg z-50">
            {{ session('status') }}
        </div>
        <script>
            setTimeout(() => {
                document.querySelector('.fixed').style.display = 'none';
            }, 5000);
        </script>
    @endif
    
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

            // Handle redirect after login
            const redirectAfterLogin = localStorage.getItem('redirect_after_login');
            if (redirectAfterLogin) {
                // Tambahkan redirect parameter ke form action
                const form = document.querySelector('form');
                if (form) {
                    const action = form.getAttribute('action');
                    form.setAttribute('action', action + '?redirect=' + encodeURIComponent(redirectAfterLogin));
                }
            }

            // Hapus redirect_after_login dari localStorage setelah digunakan
            localStorage.removeItem('redirect_after_login');
        });
    </script>
</body>
</html>
