<x-filament-panels::page.simple :heading="''" :subheading="''" :logo="false">
    <style>
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

        body {
            background: #FDFBF7;
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
        
        /* Pastikan halaman Filament ini full-height dan bisa benar center */
        .fi-simple-page {
            min-height: 100vh;
        }

        .fi-simple-page > section {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 0;
            gap: 0;
        }

        .fi-simple-header {
            display: none;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 100%;
        }
    </style>

    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-5xl min-h-fit md:min-h-[600px] bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row border-4 border-white">
            <div class="w-full md:w-[45%] p-8 md:p-12 flex items-center justify-center">
                <div class="max-w-xs mx-auto w-full form-container">
                    <h1 class="text-5xl md:text-6xl font-rascal text-[#7c2d12] mb-8 tracking-tighter text-center leading-none">
                        Admin Login
                    </h1>

                    <form wire:submit.prevent="authenticate" class="space-y-4">
                        <div>
                            <input 
                                wire:model="email"
                                type="email" 
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:border-[#c48474] focus:ring-0 font-hand text-lg placeholder-gray-400 transition-colors"
                                placeholder="Email"
                                required 
                                autofocus
                            >
                            @error('email')
                                <p class="mt-1 text-red-600 text-sm font-hand">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <input 
                                wire:model="password"
                                type="password" 
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:border-[#c48474] focus:ring-0 font-hand text-lg placeholder-gray-400 transition-colors"
                                placeholder="Password"
                                required
                            >
                            @error('password')
                                <p class="mt-1 text-red-600 text-sm font-hand">{{ $message }}</p>
                            @enderror
                        </div>

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

                        <div class="flex gap-4 pt-6">
                            <button
                                type="submit"
                                class="flex-1 btn-primary text-white font-hand text-2xl py-2 px-6 rounded-full shadow-lg transition-all active:scale-95"
                            >
                                Sign In
                            </button>
                        </div>
                    </form>

                    <div class="mt-8 text-center">
                        <a href="{{ url('/') }}" class="font-hand text-[#7c2d12] text-lg hover:underline">
                            ← Kembali ke halaman utama
                        </a>
                    </div>
                </div>
            </div>

            <div class="hidden md:block w-full md:w-[55%] relative overflow-hidden">
                <div class="absolute inset-0 bg-[#b5c276] paper-texture opacity-90"></div>
                <div class="absolute inset-0 bg-black/5 mix-blend-multiply"></div>
            </div>
        </div>
    </div>

    @if($errors->any())
        <div class="fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-lg z-50">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</x-filament-panels::page.simple>
