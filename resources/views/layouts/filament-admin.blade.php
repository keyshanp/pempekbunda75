<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - PempekBunda 75')</title>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Gaegu:wght@400;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        @font-face {
            font-family: 'RASCAL';
            src: url('{{ asset("fonts/RASCAL__.TTF") }}') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }
        
        .font-rascal {
            font-family: 'RASCAL', cursive;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #FDF8F3;
            color: #1e293b;
            margin: 0;
            padding: 0;
        }
        
        /* ============================
           CUSTOM REACT-LIKE SIDEBAR
           ============================ */
        .react-sidebar {
            position: fixed !important;
            left: 0 !important;
            top: 0 !important;
            width: 16rem !important;
            height: 100vh !important;
            background: #FDFBF7 !important;
            border-right: 2px solid rgba(188, 90, 66, 0.2) !important;
            padding: 1.5rem !important;
            display: flex !important;
            flex-direction: column !important;
            z-index: 50 !important;
            overflow-y: auto !important;
        }
        
        /* Custom scrollbar */
        .react-sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        .react-sidebar::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .react-sidebar::-webkit-scrollbar-thumb {
            background: rgba(188, 90, 66, 0.3);
            border-radius: 10px;
        }
        
        /* Brand Header */
        .sidebar-brand {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            margin-bottom: 3rem !important;
            padding-top: 1rem !important;
        }
        
        .brand-title {
            font-family: "Gaegu", cursive !important;
            font-size: 2.5rem !important;
            color: #BC5A42 !important;
            font-weight: 700 !important;
            line-height: 0.9 !important;
            margin: 0 !important;
        }
        
        .brand-title-top {
            margin-bottom: -0.10rem !important;
        }
        
        .brand-divider {
            height: 3px !important;
            width: 3rem !important;
            background: #8C9440 !important;
            margin: 1rem auto 0.75rem auto !important;
            border-radius: 10px !important;
        }
        
        .sidebar-motto {
            font-family: "Gaegu", cursive !important;
            font-size: 1.25rem !important;
            color: rgba(74, 59, 52, 0.8) !important;
            font-weight: 400 !important;
            margin-top: 0.75rem !important;
            line-height: 1.2 !important;
            text-align: center !important;
        }
        
        /* Navigation Menu */
        .sidebar-nav {
            flex: 1 !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 0.5rem !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        
        .sidebar-item {
            border-radius: 1rem !important;
            margin: 0 !important;
            padding: 1rem 1.25rem !important;
            font-family: "Inter", sans-serif !important;
            font-weight: 600 !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            border: 2px solid transparent !important;
            background: transparent !important;
            color: #4A3B34 !important;
            display: flex !important;
            align-items: center !important;
            gap: 1rem !important;
            text-decoration: none !important;
            width: 100% !important;
            text-align: left !important;
            cursor: pointer !important;
        }
        
        .sidebar-item:hover {
            background: rgba(140, 148, 64, 0.1) !important;
            color: #4A3B34 !important;
            transform: translateX(4px) !important;
            box-shadow: 0 4px 12px rgba(140, 148, 64, 0.1) !important;
        }
        
        .sidebar-item-active {
            background: #BC5A42 !important;
            color: white !important;
            box-shadow: 0 6px 20px rgba(188, 90, 66, 0.25) !important;
            transform: translateX(4px) !important;
        }
        
        .sidebar-item-active:hover {
            background: #BC5A42 !important;
            color: white !important;
        }
        
        .sidebar-icon {
            width: 1.25rem !important;
            height: 1.25rem !important;
            transition: all 0.3s ease !important;
        }
        
        .sidebar-item:hover .sidebar-icon {
            transform: scale(1.1) !important;
        }
        
        .sidebar-item-active .sidebar-icon {
            color: white !important;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1)) !important;
        }
        
        /* Sidebar Footer */
        .sidebar-footer {
            padding: 1.5rem 0 0 0 !important;
            margin-top: auto !important;
            border-top: 1px solid rgba(188, 90, 66, 0.1) !important;
        }
        
        .sidebar-logout-btn {
            border-radius: 1rem !important;
            padding: 1rem 1.25rem !important;
            font-family: "Inter", sans-serif !important;
            font-weight: 600 !important;
            color: #EF4444 !important;
            background: transparent !important;
            border: none !important;
            display: flex !important;
            align-items: center !important;
            gap: 1rem !important;
            width: 100% !important;
            transition: all 0.3s ease !important;
            cursor: pointer !important;
            text-decoration: none !important;
            text-align: left !important;
        }
        
        .sidebar-logout-btn:hover {
            background: rgba(239, 68, 68, 0.1) !important;
            transform: translateX(4px) !important;
        }
        
        /* Made with love */
        .made-with-love {
            background: rgba(140, 148, 64, 0.05) !important;
            border-radius: 1rem !important;
            padding: 1rem !important;
            margin-top: 1rem !important;
            text-align: center !important;
        }
        
        .made-with-love p {
            color: #4A3B34 !important;
            font-size: 0.75rem !important;
            font-weight: 500 !important;
            font-family: "Inter", sans-serif !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 0.25rem !important;
            margin: 0 !important;
        }
        
        /* ============================
           CUSTOM TOPBAR - REACT STYLE
           ============================ */
        .custom-topbar {
            position: fixed !important;
            top: 0 !important;
            left: 16rem !important;
            right: 0 !important;
            background: linear-gradient(135deg, #FDFBF7 0%, #F9F5E7 100%) !important;
            border-bottom: 2px solid rgba(188, 90, 66, 0.15) !important;
            box-shadow: 0 2px 15px rgba(188, 90, 66, 0.08) !important;
            padding: 1.25rem 2rem !important;
            height: 5rem !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            z-index: 40 !important;
        }
        
        .topbar-left {
            display: flex !important;
            flex-direction: column !important;
        }
        
        .topbar-subtitle {
            font-family: "Inter", sans-serif !important;
            font-size: 0.75rem !important;
            font-weight: 700 !important;
            color: rgba(74, 59, 52, 0.4) !important;
            text-transform: uppercase !important;
            letter-spacing: 0.1em !important;
            margin-bottom: 0.25rem !important;
        }
        
        .topbar-greeting {
            font-family: "Gaegu", cursive !important;
            font-size: 1.5rem !important;
            font-weight: 400 !important;
            color: #4A3B34 !important;
            line-height: 1.2 !important;
        }
        
        .topbar-user {
            display: flex !important;
            align-items: center !important;
            gap: 0.75rem !important;
            padding-left: 1.5rem !important;
            border-left: 1px solid rgba(188, 90, 66, 0.1) !important;
        }
        
        .user-name {
            font-family: "Inter", sans-serif !important;
            font-size: 0.875rem !important;
            font-weight: 700 !important;
            color: #4A3B34 !important;
        }
        
        .user-role {
            font-family: "Inter", sans-serif !important;
            font-size: 0.625rem !important;
            font-weight: 700 !important;
            color: #8C9440 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
        }
        
        .user-avatar {
            width: 3rem !important;
            height: 3rem !important;
            border-radius: 1rem !important;
            background: #BC5A42 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            color: white !important;
            font-weight: 700 !important;
            border: 2px solid #BC5A42 !important;
            overflow: hidden !important;
            box-shadow: 0 4px 12px rgba(188, 90, 66, 0.2) !important;
        }
        
        .user-avatar img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
        }
        
        /* Content Area */
        .main-content {
            margin-left: 16rem;
            margin-top: 5rem;
            min-height: calc(100vh - 5rem);
            background: #FDFBF7;
            padding: 2rem;
        }
        
        .status-badge {
            @apply px-2 py-1 rounded-md text-[10px] font-semibold uppercase tracking-wider inline-block;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.3s ease-out;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- SIDEBAR - SAMA PERSIS DENGAN RENDERHOOK -->
    <div class="react-sidebar">
        <!-- Brand Header -->
        <div class="sidebar-brand">
            <h1 class="brand-title brand-title-top">Pempek</h1>
            <h1 class="brand-title">Bunda 75</h1>
            <div class="brand-divider"></div>
            <p class="sidebar-motto">Mari sajikan yang terbaik hari ini ✨</p>
        </div>

        <!-- Navigation Menu -->
        <nav class="sidebar-nav">
            @php
                $currentPath = request()->path();
                $active = 'dashboard';
                
                if (str_contains($currentPath, 'produks')) {
                    $active = 'products';
                } elseif (str_contains($currentPath, 'orders')) {
                    $active = 'orders';
                } elseif (str_contains($currentPath, 'transaksis')) {
                    $active = 'transactions';
                }
            @endphp

            <!-- Dashboard -->
            <a href="{{ url('/admin') }}" class="sidebar-item {{ $active === 'dashboard' ? 'sidebar-item-active' : '' }}">
                <svg class="sidebar-icon {{ $active === 'dashboard' ? 'text-white' : 'text-[#BC5A42]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- Produk -->
            <a href="{{ url('/admin/produks') }}" class="sidebar-item {{ $active === 'products' ? 'sidebar-item-active' : '' }}">
                <svg class="sidebar-icon {{ $active === 'products' ? 'text-white' : 'text-[#BC5A42]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <span>Produk</span>
            </a>

            <!-- Pesanan -->
            <a href="{{ url('/admin/orders') }}" class="sidebar-item {{ $active === 'orders' ? 'sidebar-item-active' : '' }}">
                <svg class="sidebar-icon {{ $active === 'orders' ? 'text-white' : 'text-[#BC5A42]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <span>Pesanan</span>
            </a>

            <!-- Transaksi -->
            <a href="{{ url('/admin/transaksis') }}" class="sidebar-item {{ $active === 'transactions' ? 'sidebar-item-active' : '' }}">
                <svg class="sidebar-icon {{ $active === 'transactions' ? 'text-white' : 'text-[#BC5A42]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Transaksi</span>
            </a>
        </nav>

        <!-- Footer Section -->
        <div class="sidebar-footer">
            <form method="POST" action="{{ route('filament.admin.auth.logout') }}" class="w-full">
                @csrf
                <button type="submit" class="sidebar-logout-btn">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span>Keluar</span>
                </button>
            </form>
            
            <div class="made-with-love">
                <p>
                    Made with 
                    <svg class="w-3.5 h-3.5" fill="#BC5A42" stroke="#BC5A42" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    for Bunda
                </p>
            </div>
        </div>
    </div>

    <!-- CUSTOM TOPBAR -->
    <div class="custom-topbar">
        <div class="topbar-left">
            <div class="topbar-subtitle">Dapur Digital Bunda</div>
            <div class="topbar-greeting">Mari sajikan yang terbaik hari ini ✨</div>
        </div>
        <div class="topbar-user">
            <div class="text-right">
                <p class="user-name">{{ Auth::user()->name ?? 'Bunda Admin' }}</p>
                <p class="user-role">Pemilik Toko</p>
            </div>
            <div class="user-avatar">
                <img src="https://picsum.photos/seed/{{ Auth::user()->id ?? 'bunda' }}/100/100" alt="Admin">
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <main class="main-content">
        @yield('content')
    </main>

    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🎨 React-style dashboard loaded!');
            
            // Add click handler for sidebar items
            document.querySelectorAll('.sidebar-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    // Remove active class from all items
                    document.querySelectorAll('.sidebar-item').forEach(i => {
                        i.classList.remove('sidebar-item-active');
                        const icon = i.querySelector('.sidebar-icon');
                        if (icon) {
                            icon.classList.remove('text-white');
                            icon.classList.add('text-[#BC5A42]');
                        }
                    });
                    
                    // Add active class to clicked item
                    this.classList.add('sidebar-item-active');
                    const icon = this.querySelector('.sidebar-icon');
                    if (icon) {
                        icon.classList.add('text-white');
                        icon.classList.remove('text-[#BC5A42]');
                    }
                });
            });
        });
    </script>
</body>
</html>
