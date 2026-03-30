<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hapus Produk Massal - PempekBunda 75</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #fffaf5;
            color: #4a3a2a;
            overflow: hidden;
            height: 100vh;
            margin: 0;
        }
        .bubbly-font {
            font-family: 'Comic Neue', cursive;
            font-weight: 700;
            -webkit-text-stroke: 1px #8b4513;
            color: #fdf8f4;
            text-shadow: 2px 2px 0px #8b4513;
        }
        .bubbly-outline {
            font-family: 'Comic Neue', cursive;
            color: #a64d3d;
        }
        .organic-shadow {
            box-shadow: 0 10px 25px -5px rgba(166, 77, 61, 0.1), 0 8px 10px -6px rgba(166, 77, 61, 0.1);
        }
        .bg-cream {
            background-color: #fffaf5;
        }
        .bg-rust {
            background-color: #a64d3d;
        }
        .bg-light-rust {
            background-color: #fdf2f0;
        }
        .bg-beige {
            background-color: #f5ebe6;
        }
        .text-rust {
            color: #a64d3d;
        }
        .text-brown {
            color: #8b4513;
        }
        .border-rust {
            border-color: #a64d3d;
        }
        .border-light-rust {
            border-color: #e8d5cc;
        }
        .scrollable-content {
            max-height: 50vh;
            overflow-y: auto;
            padding-right: 8px;
        }
        .scrollable-content::-webkit-scrollbar {
            width: 6px;
        }
        .scrollable-content::-webkit-scrollbar-track {
            background: #f5ebe6;
            border-radius: 10px;
        }
        .scrollable-content::-webkit-scrollbar-thumb {
            background: #a64d3d;
            border-radius: 10px;
        }
        .scrollable-content::-webkit-scrollbar-thumb:hover {
            background: #8b4134;
        }
        @keyframes starTwinkle {
            0%, 100% { opacity: 0.7; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.2); }
        }
        @keyframes buttonPulse {
            0% { box-shadow: 0 0 0 0 rgba(166, 77, 61, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(166, 77, 61, 0); }
            100% { box-shadow: 0 0 0 0 rgba(166, 77, 61, 0); }
        }
        .checkbox-custom {
            width: 2rem;
            height: 2rem;
            border-radius: 0.75rem;
            border: 2px solid #e8d5cc;
            transition: all 0.3s;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .checkbox-custom:hover {
            border-color: #a64d3d;
        }
        .checkbox-custom.checked {
            background-color: #a64d3d;
            border-color: #a64d3d;
        }
    </style>
</head>
<body class="bg-cream flex items-center justify-center p-4">
    <div class="w-full max-w-2xl mx-auto">
        <!-- Success Message (Hidden by default) -->
        <div id="successMessage" class="hidden w-full text-center mb-8">
            <div class="animate-bounce">
                <i class="fas fa-trash text-rust text-6xl mb-4"></i>
                <h1 class="text-4xl bubbly-outline mb-2">Produk Terhapus!</h1>
                <p class="text-xl text-brown font-medium">{{ $produks->count() }} produk berhasil dihapus.</p>
                <a href="/admin/produks" 
                   class="inline-block mt-8 bg-rust text-white px-8 py-3 rounded-full hover:opacity-90 transition-all hover:scale-105 active:scale-95 shadow-lg">
                    Kembali ke Daftar Produk
                </a>
            </div>
        </div>

        <!-- Delete Confirmation Card -->
        <div id="confirmationCard" class="bg-white/50 backdrop-blur-sm rounded-[3rem] p-6 md:p-8 border-4 border-light-rust organic-shadow relative overflow-hidden">
            <!-- Decorative blobs -->
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-light-rust rounded-full -z-10"></div>
            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-light-rust rounded-full -z-10"></div>

            <!-- Header Section -->
            <div class="text-center mb-6">
                <h1 class="text-4xl md:text-5xl bubbly-font mb-2">Hapus Data</h1>
                <p class="text-rust italic font-medium opacity-80">
                    Tindakan penghapusan massal admin
                </p>
            </div>

            <!-- Stats Summary -->
            <div class="grid grid-cols-3 gap-4 mb-6">
                @php
                    $totalItems = $produks->count();
                    $totalHarga = $produks->sum('harga');
                    $totalStok = $produks->sum('stok');
                    $avgHarga = $totalItems > 0 ? $totalHarga / $totalItems : 0;
                @endphp
                
                <div class="flex flex-col items-center">
                    <span class="text-3xl font-bold text-rust mb-1">{{ $totalItems }}</span>
                    <span class="text-xs tracking-widest text-rust opacity-50 font-bold">ITEM</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-3xl font-bold text-rust mb-1">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                    <span class="text-xs tracking-widest text-rust opacity-50 font-bold">TOTAL</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-3xl font-bold text-rust mb-1">{{ $totalStok }}</span>
                    <span class="text-xs tracking-widest text-rust opacity-50 font-bold">STOK</span>
                </div>
            </div>

            <!-- Star Divider -->
            <div class="flex justify-center items-center gap-3 py-4 mb-6 overflow-hidden">
                @for($i = 0; $i < 12; $i++)
                    <i class="fas fa-star text-rust text-base" style="animation: starTwinkle 3s infinite {{ $i * 0.1 }}s;"></i>
                @endfor
            </div>

            <!-- Scrollable Content -->
            <div class="scrollable-content mb-6">
                <!-- Content Card -->
                <div class="bg-white rounded-[2rem] p-5 mb-4 border-2 border-light-rust shadow-sm">
                    <p class="text-center text-[10px] tracking-widest text-rust opacity-40 font-bold mb-4">
                        DAFTAR ITEM ({{ $totalItems }})
                    </p>
                    
                    <div class="space-y-3 max-h-60 overflow-y-auto pr-2">
                        @foreach($produks as $index => $produk)
                            <div class="flex items-center gap-4 p-3 rounded-2xl bg-beige border border-light-rust hover:bg-white transition-colors">
                                <div class="relative">
                                    @if($produk->gambar)
                                        <img 
                                            src="{{ asset('storage/' . $produk->gambar) }}" 
                                            alt="{{ $produk->nama_produk }}" 
                                            class="w-14 h-14 rounded-full border-2 border-rust object-cover"
                                            onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTYiIGhlaWdodD0iNTYiIHZpZXdCb3g9IjAgMCA1NiA1NiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iNTYiIGhlaWdodD0iNTYiIHJ4PSI4IiBmaWxsPSIjRjNGNEY2Ii8+PHRleHQgeD0iNTYiIHk9IjU2IiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTAiIGZpbGw9IiM5Q0EzQUYiIHRleHQtYW5jaG9yPSJlbmQiIGR5PSItMTUiPk5PIEk8L3RleHQ+PC9zdmc+'"
                                        >
                                    @else
                                        <div class="w-14 h-14 rounded-full border-2 border-rust bg-gray-100 flex items-center justify-center">
                                            <i class="fas fa-image text-rust/50"></i>
                                        </div>
                                    @endif
                                    <div class="absolute -top-1 -right-1 bg-rust text-white text-[10px] w-5 h-5 flex items-center justify-center rounded-full font-bold">
                                        {{ $index + 1 }}
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-rust text-base leading-tight truncate">{{ $produk->nama_produk }}</h3>
                                    <p class="text-sm text-brown opacity-70 font-medium">
                                        Rp {{ number_format($produk->harga, 0, ',', '.') }} • {{ $produk->stok }} pcs
                                    </p>
                                    <span class="inline-block mt-1 px-2 py-0.5 {{ $produk->status ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }} text-[10px] font-bold rounded-full uppercase">
                                        {{ $produk->status ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-4 mt-4 border-t-2 border-dashed border-light-rust flex justify-between items-end">
                        <div>
                            <p class="text-[10px] text-rust opacity-50 font-bold">ESTIMASI TOTAL</p>
                            <p class="text-xs text-rust font-medium">{{ $totalItems }} item • {{ $totalStok }} pcs</p>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-rust">Rp {{ number_format($totalHarga, 0, ',', '.') }}</p>
                            <p class="text-[10px] text-rust opacity-50">Rata²: Rp {{ number_format($avgHarga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Warning Box -->
                <div class="bg-[#fff1f0] border-2 border-[#ffccc7] rounded-2xl p-4 flex gap-3">
                    <i class="fas fa-exclamation-triangle text-[#f5222d] text-lg flex-shrink-0 mt-0.5"></i>
                    <p class="text-xs text-[#cf1322] font-semibold leading-relaxed">
                        PERINGATAN: {{ $totalItems }} data akan dihapus permanen dari database dan tidak dapat dikembalikan. 
                        Hati-hati ya Bunda!
                        @if($produks->contains('gambar'))
                            <br><span class="opacity-75">Gambar produk juga akan dihapus dari server.</span>
                        @endif
                    </p>
                </div>
            </div>

            <!-- Confirmation Checkbox -->
            <div class="flex justify-center mb-6">
                <label class="flex items-center gap-3 cursor-pointer group">
                    <div class="relative">
                        <input 
                            type="checkbox" 
                            id="confirmCheckbox"
                            class="sr-only" 
                        />
                        <div id="customCheckbox" class="checkbox-custom group-hover:border-rust">
                            <i id="checkIcon" class="fas fa-check text-white text-base hidden"></i>
                        </div>
                    </div>
                    <span class="text-rust font-bold text-base md:text-lg select-none">
                        saya mantap ingin menghapus {{ $totalItems }} produk ini
                    </span>
                </label>
            </div>

            <!-- Action Buttons -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                @if(isset($is_filament) && $is_filament)
                    <form method="POST" action="{{ route('filament.produk.bulk-execute-delete') }}" id="deleteForm">
                @else
                    <form method="POST" action="{{ route('produk.bulk-execute-delete') }}" id="deleteForm">
                @endif
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="ids" value="{{ $ids }}">
                    
                    <button type="button" 
                            id="deleteButton"
                            disabled
                            class="w-full flex items-center justify-center gap-3 px-6 py-3 rounded-full text-base font-bold transition-all duration-300 shadow-lg bg-beige text-rust cursor-not-allowed opacity-70">
                        <i class="fas fa-trash"></i>
                        hapus {{ $totalItems }} item
                    </button>
                </form>
                
                <a href="/admin/produks" 
                   class="flex items-center justify-center gap-3 px-6 py-3 rounded-full bg-light-rust text-rust text-base font-bold border-2 border-light-rust hover:bg-white hover:scale-105 transition-all duration-300 active:scale-95 shadow-sm text-center">
                    <i class="fas fa-times"></i>
                    batal
                </a>
            </div>

            <!-- Footer -->
            <div class="mt-8 pt-6 border-t border-light-rust text-center">
                <div class="text-rust flex flex-col items-center gap-2 opacity-70">
                    <div class="flex items-center gap-2 text-sm font-medium">
                        <i class="fas fa-plus-circle"></i>
                        PempekBunda 75
                    </div>
                    <p class="text-xs">Sistem Manajemen Produk Aman v2.0 - {{ date('Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.getElementById('confirmCheckbox');
            const customCheckbox = document.getElementById('customCheckbox');
            const checkIcon = document.getElementById('checkIcon');
            const deleteButton = document.getElementById('deleteButton');
            const totalItems = {{ $totalItems }};
            
            // Handle checkbox click
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    customCheckbox.classList.add('checked');
                    checkIcon.classList.remove('hidden');
                    deleteButton.disabled = false;
                    deleteButton.classList.remove('bg-beige', 'cursor-not-allowed', 'opacity-70');
                    deleteButton.classList.add('bg-rust', 'text-white', 'hover:scale-105', 'hover:bg-[#8b4134]');
                    deleteButton.style.animation = 'buttonPulse 2s infinite';
                    deleteButton.innerHTML = `<i class="fas fa-trash"></i> hapus ${totalItems} item`;
                } else {
                    customCheckbox.classList.remove('checked');
                    checkIcon.classList.add('hidden');
                    deleteButton.disabled = true;
                    deleteButton.classList.remove('bg-rust', 'text-white', 'hover:scale-105', 'hover:bg-[#8b4134]');
                    deleteButton.classList.add('bg-beige', 'cursor-not-allowed', 'opacity-70');
                    deleteButton.style.animation = 'none';
                    deleteButton.innerHTML = `<i class="fas fa-trash"></i> hapus ${totalItems} item`;
                }
            });
            
            // Custom checkbox click
            customCheckbox.addEventListener('click', function() {
                checkbox.checked = !checkbox.checked;
                checkbox.dispatchEvent(new Event('change'));
            });
            
            // Delete button click
            deleteButton.addEventListener('click', function() {
                if (!checkbox.checked) return;
                
                if (confirm(`Yakin mau hapus ${totalItems} produk ini?\n\nIni tindakan yang tidak bisa dibatalkan!`)) {
                    // Show loading
                    const originalHTML = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
                    this.disabled = true;
                    
                    // Disable cancel button
                    const cancelBtn = document.querySelector('a[href="/admin/produks"]');
                    if (cancelBtn) {
                        cancelBtn.style.opacity = '0.5';
                        cancelBtn.style.pointerEvents = 'none';
                    }
                    
                    // Submit form
                    document.getElementById('deleteForm').submit();
                }
            });
            
            // Adjust scrollable content height
            function adjustContentHeight() {
                const scrollableContent = document.querySelector('.scrollable-content');
                const viewportHeight = window.innerHeight;
                const card = document.getElementById('confirmationCard');
                const cardHeight = card.offsetHeight;
                
                // Set max height for scrollable content
                const availableHeight = viewportHeight * 0.5;
                scrollableContent.style.maxHeight = availableHeight + 'px';
                
                // Ensure card fits in viewport
                if (cardHeight > viewportHeight * 0.9) {
                    card.style.maxHeight = (viewportHeight * 0.9) + 'px';
                    card.style.overflowY = 'auto';
                }
            }
            
            adjustContentHeight();
            window.addEventListener('resize', adjustContentHeight);
            
            // Optional: SweetAlert2 for better confirmation
            // Uncomment jika ingin pakai SweetAlert2
            /*
            deleteButton.addEventListener('click', function() {
                if (!checkbox.checked) return;
                
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
                        title: `Hapus ${totalItems} Produk?`,
                        text: `Yakin mau menghapus ${totalItems} produk sekaligus? Tindakan ini tidak bisa dibatalkan!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#a64d3d',
                        cancelButtonColor: '#8b4513',
                        confirmButtonText: 'Ya, hapus semua!',
                        cancelButtonText: 'Batal',
                        customClass: {
                            popup: 'rounded-2xl',
                            title: 'bubbly-outline'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const originalHTML = deleteButton.innerHTML;
                            deleteButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
                            deleteButton.disabled = true;
                            
                            const cancelBtn = document.querySelector('a[href="/admin/produks"]');
                            if (cancelBtn) {
                                cancelBtn.style.opacity = '0.5';
                                cancelBtn.style.pointerEvents = 'none';
                            }
                            
                            document.getElementById('deleteForm').submit();
                        }
                    });
                }
            });
            */
        });
    </script>
</body>
</html>
