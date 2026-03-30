<!DOCTYPE html>
<html lang="id" class="min-h-screen">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? 'Admin - PempekBunda 75' }}</title>
        
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Finger+Paint&family=Indie+Flower&family=Patrick+Hand&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Custom Styling -->
        <style>
            .font-sketch { font-family: 'Finger Paint', cursive; }
            .font-hand { font-family: 'Patrick Hand', cursive; }
            .font-indie { font-family: 'Indie Flower', cursive; }
            .font-body { font-family: 'Inter', sans-serif; }
            
            .paper-texture {
                background-image: url('https://images.unsplash.com/photo-1586075010923-2dd4570fb338?q=80&w=1974&auto=format&fit=crop');
                background-size: cover;
                background-blend-mode: multiply;
            }
            
            .text-outline {
                -webkit-text-stroke: 1px #7c2d12;
                color: transparent;
            }
            
            .btn-primary {
                background: linear-gradient(135deg, #BC5A42 0%, #9C4A32 100%) !important;
                transition: all 0.3s ease !important;
                border: none !important;
            }
            
            .btn-primary:hover {
                transform: translateY(-2px) !important;
                box-shadow: 0 10px 20px rgba(188, 90, 66, 0.3) !important;
            }
            
            .btn-primary:active {
                transform: translateY(0) !important;
            }
            
            /* Custom input styling */
            .custom-input {
                border: 2px solid #D4A76A !important;
                border-radius: 50px !important;
                padding: 0.75rem 1.5rem !important;
                font-family: 'Patrick Hand', cursive !important;
                font-size: 1.25rem !important;
                transition: all 0.3s ease !important;
                background: #FDFBF7 !important;
            }
            
            .custom-input:focus {
                border-color: #BC5A42 !important;
                box-shadow: 0 0 0 3px rgba(188, 90, 66, 0.1) !important;
                background: white !important;
            }
            
            /* Center the form */
            .min-h-screen {
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                background: #FDFBF7 !important;
                padding: 1rem !important;
            }
        </style>
        
        @filamentStyles
    </head>
    
    <body class="min-h-screen">
        <!-- Main Container -->
        <div class="w-full max-w-5xl min-h-fit md:min-h-[600px] bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row border-4 border-white">
            
            <!-- Left Section: Form -->
            <div class="w-full md:w-[45%] p-8 md:p-12 flex items-center justify-center">
                <div class="max-w-xs mx-auto w-full">
                    <!-- Title -->
                    <div class="mb-10 text-center md:text-left">
                        <h1 class="text-5xl md:text-6xl font-sketch text-[#BC5A42] mb-4 tracking-tighter">
                            Pempek
                        </h1>
                        <h2 class="text-5xl md:text-6xl font-sketch text-[#BC5A42] mb-6 tracking-tighter">
                            Bunda 75
                        </h2>
                        <div class="h-1 w-24 bg-[#8C9440] rounded-full mx-auto md:mx-0"></div>
                    </div>
                    
                    <!-- Welcome Text -->
                    <div class="mb-8">
                        <h3 class="text-3xl font-sketch text-[#4A3B34] mb-2">Admin Login</h3>
                        <p class="font-hand text-[#4A3B34]/70 text-lg">Masuk ke dapur digital Bunda</p>
                    </div>

                    <!-- Form -->
                    <div class="space-y-6">
                        {{ $slot }}
                    </div>
                    
                    <!-- Back to Home -->
                    <div class="mt-8 text-center md:text-left">
                        <a href="{{ url('/') }}" class="font-hand text-[#7c2d12] text-lg hover:underline flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali ke halaman utama
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Section: Texture & Branding -->
            <div class="hidden md:block w-full md:w-[55%] relative overflow-hidden">
                <!-- Branding in the middle of right panel -->
                <div class="absolute inset-0 flex items-center justify-center p-12">
                    <div class="text-center">
                        <div class="text-white text-7xl font-sketch mb-4">🍢</div>
                        <div class="text-white text-5xl font-sketch mb-2 leading-tight">Pempek</div>
                        <div class="text-white text-5xl font-sketch mb-6 leading-tight">Bunda 75</div>
                        <div class="h-1 w-32 bg-white/30 rounded-full mx-auto mb-8"></div>
                        <p class="text-white/90 font-hand text-2xl">Mari sajikan yang terbaik hari ini ✨</p>
                    </div>
                </div>
                
                <!-- Green Paper Texture -->
                <div class="absolute inset-0 bg-gradient(135deg, #8C9440 0%, #7C8430 100%) paper-texture opacity-90"></div>
                
                <!-- Extra crumpled effect -->
                <div class="absolute inset-0 bg-black/5 mix-blend-multiply"></div>
            </div>
        </div>

        @filamentScripts
    </body>
</html>
