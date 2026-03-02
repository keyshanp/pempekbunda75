<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Pempek Bunda 75</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Finger+Paint&family=Indie+Flower&family=Patrick+Hand&display=swap" rel="stylesheet">
    <style>
        .font-sketch { font-family: 'Finger Paint', cursive; }
        .font-hand { font-family: 'Patrick Hand', cursive; }
        
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
        
        @media (min-width: 768px) {
            .custom-container-height {
                height: 650px !important;
            }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-5xl custom-container-height bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row border-4 border-white">
        
        <!-- Left Section: Form -->
        <div class="w-full md:w-[45%] p-8 md:p-12 flex flex-col justify-center bg-white">
            <div class="max-w-xs mx-auto w-full">
                <h1 class="text-5xl md:text-6xl font-sketch text-outline mb-8 tracking-tighter text-center md:text-left">
                    Daftar
                </h1>

                <form method="POST" action="{{ route('filament.admin.auth.register') }}" class="space-y-4">
                    @csrf
                    
                    <!-- Nama -->
                    <div class="relative">
                        <input 
                            id="name" 
                            name="name" 
                            type="text" 
                            value="{{ old('name') }}"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:border-[#c48474] focus:ring-0 font-hand text-lg placeholder-gray-400 transition-colors"
                            placeholder="Nama Lengkap"
                            required 
                            autofocus
                        >
                        @error('name')
                            <p class="mt-1 text-red-600 text-sm font-hand">{{ $message }}</p>
                        @enderror
                    </div>
                    
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
                    
                    <!-- Confirm Password -->
                    <div class="relative">
                        <input 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            type="password" 
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:border-[#c48474] focus:ring-0 font-hand text-lg placeholder-gray-400 transition-colors"
                            placeholder="Konfirmasi Password"
                            required
                        >
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4 pt-6">
                        <button
                            type="submit"
                            class="flex-1 btn-primary text-white font-hand text-2xl py-2 px-6 rounded-full shadow-lg transition-all active:scale-95"
                        >
                            Sign Up
                        </button>
                        <a
                            href="{{ route('filament.admin.auth.login') }}"
                            class="flex-1 btn-primary text-white font-hand text-2xl py-2 px-6 rounded-full shadow-lg transition-all active:scale-95 text-center"
                        >
                            Sign In
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
            <div class="absolute inset-0 bg-[#b5c276] paper-texture opacity-90"></div>
            <div class="absolute inset-0 bg-black/5 mix-blend-multiply"></div>
            <div class="absolute inset-0 flex items-center justify-center p-12">
                <div class="text-white/20 font-sketch text-8xl rotate-[-20deg] select-none">
                    PEMPEK
                </div>
            </div>
        </div>
    </div>
</body>
</html>