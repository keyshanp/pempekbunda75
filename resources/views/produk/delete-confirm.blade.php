<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Konfirmasi Hapus Produk - Pempek Bunda 75' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gloria+Hallelujah&family=Itim&family=Handlee&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #fffcf2;
            color: #4a3a2a;
            font-family: 'Itim', cursive;
            overflow: hidden; /* No scroll pada body */
            height: 100vh; /* Full viewport height */
            margin: 0;
        }
        .font-heading {
            font-family: 'Gloria Hallelujah', cursive;
        }
        .font-body {
            font-family: 'Handlee', cursive;
        }
        .star {
            color: #bc5a45;
            text-shadow: 0 0 8px rgba(188, 90, 69, 0.3);
        }
        .bg-cream {
            background-color: #fffcf2;
        }
        .bg-rust {
            background-color: #bc5a45;
        }
        .bg-green {
            background-color: #7b8c5a;
        }
        .bg-brown {
            background-color: #4a3a2a;
        }
        .bg-beige {
            background-color: #f5e8d3;
        }
        .text-rust {
            color: #bc5a45;
        }
        .text-green {
            color: #7b8c5a;
        }
        .text-brown {
            color: #4a3a2a;
        }
        .hover-lift {
            transition: all 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        /* Scrollable content area */
        .scrollable-content {
            max-height: 60vh;
            overflow-y: auto;
            padding-right: 8px;
        }
        /* Custom scrollbar */
        .scrollable-content::-webkit-scrollbar {
            width: 6px;
        }
        .scrollable-content::-webkit-scrollbar-track {
            background: #f5e8d3;
            border-radius: 10px;
        }
        .scrollable-content::-webkit-scrollbar-thumb {
            background: #bc5a45;
            border-radius: 10px;
        }
        .scrollable-content::-webkit-scrollbar-thumb:hover {
            background: #9c4a37;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        @keyframes starTwinkle {
            0%, 100% { opacity: 0.7; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.2); }
        }
        @keyframes buttonPulse {
            0% { box-shadow: 0 0 0 0 rgba(188, 90, 69, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(188, 90, 69, 0); }
            100% { box-shadow: 0 0 0 0 rgba(188, 90, 69, 0); }
        }
    </style>
</head>
<body class="bg-cream flex items-center justify-center p-4">
    <!-- Main Container - Centered and Fixed Size -->
    <div class="w-full max-w-xl mx-auto">
        <!-- Success Message (Hidden by default) -->
        <div id="successMessage" class="hidden w-full text-center">
            <div class="animate-bounce">
                <i class="fas fa-trash text-rust text-6xl mb-4"></i>
                <h1 class="text-4xl font-heading text-rust mb-2">Produk Terhapus!</h1>
                <p class="font-body text-xl text-brown">Daftar produk sudah diperbarui ya Bun.</p>
                <a href="/admin/produks" 
                   class="inline-block mt-8 bg-brown text-white px-8 py-3 rounded-full font-body hover:opacity-90 transition-all hover-lift">
                    Kembali ke Daftar Produk
                </a>
            </div>
        </div>

        <!-- Delete Confirmation Card -->
        <div id="confirmationCard" class="bg-white rounded-[2.5rem] shadow-xl overflow-hidden border-2 border-rust/10">
            <!-- Header Section -->
            <div class="bg-rust p-8 text-center relative overflow-hidden">
                <!-- Background decoration circles -->
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full"></div>
                <div class="absolute -bottom-5 -left-5 w-20 h-20 bg-white/10 rounded-full"></div>
                
                <div class="bg-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <i class="fas fa-trash text-rust text-2xl"></i>
                </div>
                
                <h1 class="text-3xl font-heading text-white mb-2 leading-tight">
                    Yah, Mau Dihapus?
                </h1>
                <p class="text-white/80 font-body text-base italic">
                    Konfirmasi dulu ya sebelum produknya hilang...
                </p>
            </div>

            <!-- Scrollable Content Area -->
            <div class="scrollable-content p-6 space-y-6 bg-cream/50">
                <!-- Product Details -->
                <div class="bg-white p-5 rounded-[1.5rem] border border-green/20 shadow-sm flex gap-5 items-center hover-lift">
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-green/20 rounded-xl blur opacity-10 group-hover:opacity-20 transition"></div>
                        @if($produk->gambar)
                            <img 
                                src="{{ asset('storage/' . $produk->gambar) }}" 
                                alt="{{ $produk->nama_produk }}" 
                                class="w-20 h-20 object-cover rounded-xl border-4 border-green"
                                onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iOTYiIGhlaWdodD0iOTYiIHZpZXdCb3g9IjAgMCA5NiA5NiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iOTYiIGhlaWdodD0iOTYiIHJ4PSIxMiIgZmlsbD0iI0YzRjRGNiIvPjx0ZXh0IHg9Ijk2IiB5PSI5NiIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjOUNBM0FGIiB0ZXh0LWFuY2hvcj0iZW5kIiBkeT0iLTI1Ij5OTyBJTUc8L3RleHQ+PC9zdmc+'"
                            >
                        @else
                            <div class="w-20 h-20 rounded-xl border-4 border-green bg-gray-100 flex items-center justify-center">
                                <i class="fas fa-image text-green/50 text-2xl"></i>
                            </div>
                        @endif
                    </div>
                    <div class="space-y-1 flex-1">
                        <h3 class="text-xl font-heading text-rust">{{ $produk->nama_produk }}</h3>
                        <p class="text-lg font-body text-green font-bold">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                        <div class="flex items-center gap-2 text-sm text-brown/60 font-body">
                            <i class="fas fa-box text-xs"></i>
                            <span>Sisa Stok: {{ $produk->stok }} pcs</span>
                        </div>
                        @if($produk->deskripsi)
                            <p class="text-brown/70 text-xs mt-2 line-clamp-2">{{ $produk->deskripsi }}</p>
                        @endif
                    </div>
                </div>

                <!-- Warning Message -->
                <div class="bg-rust/10 p-4 rounded-2xl border-l-8 border-rust flex gap-3 items-start hover-lift">
                    <i class="fas fa-exclamation-triangle text-rust shrink-0 mt-1 text-lg"></i>
                    <div class="font-body">
                        <p class="font-bold text-rust text-base">Hati-hati ya!</p>
                        <p class="text-brown/80 leading-relaxed text-sm">
                            Tindakan ini tidak bisa dibatalkan lho. Produk akan dihapus permanen dari menu kita.
                            @if($produk->gambar)
                                <br><span class="text-xs opacity-75">Gambar produk juga akan dihapus dari server.</span>
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Star Separator -->
                <div class="flex justify-center gap-2 my-3">
                    @for($i = 0; $i < 9; $i++)
                        <span class="star text-base" style="animation: starTwinkle 3s infinite {{ $i * 0.1 }}s;">★</span>
                    @endfor
                </div>

                <!-- Additional Product Details (Scrollable if many) -->
                <div class="space-y-3">
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div class="bg-white/50 p-3 rounded-xl border border-brown/10">
                            <p class="text-brown/60 font-body">ID Produk</p>
                            <p class="font-bold text-brown">{{ $produk->id }}</p>
                        </div>
                        <div class="bg-white/50 p-3 rounded-xl border border-brown/10">
                            <p class="text-brown/60 font-body">Status</p>
                            <p class="font-bold {{ $produk->status ? 'text-green' : 'text-rust' }}">
                                {{ $produk->status ? 'Aktif' : 'Nonaktif' }}
                            </p>
                        </div>
                    </div>
                    
                    @if($produk->created_at)
                    <div class="bg-white/50 p-3 rounded-xl border border-brown/10">
                        <p class="text-brown/60 font-body text-sm">Ditambahkan pada</p>
                        <p class="font-bold text-brown text-sm">{{ $produk->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Fixed Bottom Action Buttons (Not Scrollable) -->
            <div class="p-6 bg-white border-t border-rust/10 space-y-4">
                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="/admin/produks" 
                       class="flex-1 flex items-center justify-center gap-2 py-3 px-4 rounded-full border-2 border-brown font-body text-base hover:bg-brown hover:text-white transition-all group hover-lift">
                        <i class="fas fa-times group-hover:rotate-90 transition-transform"></i>
                        Gak Jadi
                    </a>
                    
                    <!-- Delete Form -->
                    @if(isset($is_filament) && $is_filament)
                        <form method="POST" action="{{ route('filament.produk.execute-delete', $produk->id) }}" 
                              id="deleteForm" class="flex-1">
                    @else
                        <form method="POST" action="{{ route('produk.execute-delete', $produk->id) }}" 
                              id="deleteForm" class="flex-1">
                    @endif
                        @csrf
                        @method('DELETE')
                        <button type="button" 
                                onclick="confirmDelete()"
                                class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-full bg-rust text-white font-body text-base shadow-lg shadow-rust/20 hover:scale-105 active:scale-95 transition-all group hover-lift"
                                style="animation: buttonPulse 2s infinite">
                            <i class="fas fa-trash group-hover:animate-pulse"></i>
                            Iya, Hapus
                        </button>
                    </form>
                </div>

                <div class="text-center">
                    <a href="/admin/produks" class="font-body text-brown/50 hover:text-rust underline decoration-dotted transition-colors text-sm">
                        <i class="fas fa-arrow-left mr-1"></i>Kembali ke daftar produk
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            // Simple confirmation (bisa diganti SweetAlert2 nanti)
            if (confirm(`Yakin banget mau hapus "${'{{ addslashes($produk->nama_produk) }}'}"?\n\nTindakan ini tidak bisa dibatalkan!`)) {
                // Show loading animation
                const button = document.querySelector('button[onclick="confirmDelete()"]');
                const originalHTML = button.innerHTML;
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
                button.disabled = true;
                
                // Disable the cancel button too
                const cancelBtn = document.querySelector('a[href="/admin/produks"]');
                if (cancelBtn) {
                    cancelBtn.style.opacity = '0.5';
                    cancelBtn.style.pointerEvents = 'none';
                }
                
                // Submit the form
                document.getElementById('deleteForm').submit();
            }
        }

        // Optional: Add SweetAlert2 jika ingin tampilan lebih bagus
        // Uncomment kode di bawah jika ingin pakai SweetAlert2
        /*
        function confirmDelete() {
            // Load SweetAlert2 dynamically
            if (typeof Swal === 'undefined') {
                const script = document.createElement('script');
                script.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
                script.onload = function() {
                    showSweetAlert();
                };
                document.head.appendChild(script);
            } else {
                showSweetAlert();
            }
            
            function showSweetAlert() {
                Swal.fire({
                    title: 'Yakin banget nih?',
                    text: `Produk "{{ addslashes($produk->nama_produk) }}" akan dihapus selamanya!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#bc5a45',
                    cancelButtonColor: '#4a3a2a',
                    confirmButtonText: 'Iya, hapus aja!',
                    cancelButtonText: 'Gak jadi',
                    customClass: {
                        popup: 'font-body rounded-2xl',
                        title: 'font-heading text-rust'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const button = document.querySelector('button[onclick="confirmDelete()"]');
                        const originalHTML = button.innerHTML;
                        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
                        button.disabled = true;
                        
                        const cancelBtn = document.querySelector('a[href="/admin/produks"]');
                        if (cancelBtn) {
                            cancelBtn.style.opacity = '0.5';
                            cancelBtn.style.pointerEvents = 'none';
                        }
                        
                        document.getElementById('deleteForm').submit();
                    }
                });
            }
        }
        */

        // Add hover effects
        document.addEventListener('DOMContentLoaded', function() {
            // Make sure content fits without scrolling if not needed
            const scrollableContent = document.querySelector('.scrollable-content');
            const card = document.getElementById('confirmationCard');
            
            function adjustHeight() {
                const viewportHeight = window.innerHeight;
                const cardHeight = card.offsetHeight;
                const scrollableHeight = scrollableContent.scrollHeight;
                
                // Jika konten terlalu tinggi, aktifkan scroll
                if (scrollableHeight > 300) { // 300px adalah max height sebelum scroll
                    scrollableContent.style.maxHeight = '40vh';
                } else {
                    scrollableContent.style.maxHeight = 'none';
                    scrollableContent.style.overflowY = 'hidden';
                }
                
                // Pastikan card tidak lebih tinggi dari viewport
                const maxCardHeight = viewportHeight * 0.9;
                if (cardHeight > maxCardHeight) {
                    card.style.maxHeight = maxCardHeight + 'px';
                }
            }
            
            // Adjust on load and resize
            adjustHeight();
            window.addEventListener('resize', adjustHeight);
            
            // Add smooth transitions
            const cards = document.querySelectorAll('.hover-lift');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transition = 'all 0.3s ease';
                });
            });
        });
    </script>
</body>
</html>