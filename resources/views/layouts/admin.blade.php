<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Pempek Bunda 75')</title>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Cormorant+Garamond:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Gaegu:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Filament Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/filament/filament-admin.css') }}">
    
    <!-- Custom CSS dari AdminPanelProvider -->
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
        }
        
        .sidebar-active {
            background-color: #C06044;
            color: white;
            box-shadow: 0 4px 12px rgba(192, 96, 68, 0.25);
        }
        
        .status-badge {
            @apply px-2 py-1 rounded-md text-[10px] font-semibold uppercase tracking-wider inline-block;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #C06044;
            border-radius: 10px;
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
        
        /* Filament-like table styles */
        .filament-table {
            border-radius: 1rem;
            overflow: hidden;
        }
        
        .filament-table thead tr {
            background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%);
            color: white;
        }
        
        .filament-table th {
            padding: 1rem 1.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .filament-table tbody tr {
            border-bottom: 1px solid #e2e8f0;
            transition: background-color 0.2s;
        }
        
        .filament-table tbody tr:hover {
            background-color: #f8fafc;
        }
        
        .filament-table td {
            padding: 1rem 1.5rem;
        }
        
        .filament-btn {
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .filament-btn-primary {
            background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%);
            color: white;
        }
        
        .filament-btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        }
        
        .filament-btn-success {
            background: #10b981;
            color: white;
        }
        
        .filament-btn-warning {
            background: #f59e0b;
            color: white;
        }
        
        .filament-btn-danger {
            background: #ef4444;
            color: white;
        }
        
        .filament-input {
            border-radius: 0.5rem;
            border: 2px solid #e2e8f0;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }
        
        .filament-input:focus {
            border-color: #0ea5e9;
            outline: none;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        }
        
        .filament-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
    </style>
    
    @stack('styles')
</head>
<body class="min-h-screen flex">
    <!-- SIDEBAR - Copy dari AdminPanelProvider -->
    <aside class="w-64 bg-white border-r border-slate-100 flex flex-col fixed h-screen">
        <div class="p-8">
            <h1 class="text-3xl font-rascal text-[#C06044] leading-tight">
                Pempek<br>Bunda 75
            </h1>
            <p class="mt-4 text-xs text-slate-400 italic">
                Mari sajikan yang terbaik hari ini ✨
            </p>
        </div>

        <nav class="flex-1 px-4 space-y-2">
            <a href="{{ url('/admin') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all w-full text-slate-400 hover:text-[#C06044] hover:bg-orange-50">
                <i class="fas fa-tachometer-alt w-5"></i>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="{{ url('/admin/produks') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all w-full text-slate-400 hover:text-[#C06044] hover:bg-orange-50">
                <i class="fas fa-box w-5"></i>
                <span class="font-medium">Produk</span>
            </a>
            <a href="{{ url('/admin/orders') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all w-full sidebar-active">
                <i class="fas fa-shopping-bag w-5"></i>
                <span class="font-medium">Pesanan</span>
            </a>
            <a href="{{ url('/admin/transaksis') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all w-full text-slate-400 hover:text-[#C06044] hover:bg-orange-50">
                <i class="fas fa-exchange-alt w-5"></i>
                <span class="font-medium">Transaksi</span>
            </a>
        </nav>

        <div class="p-4 border-t border-slate-50">
            <form method="POST" action="{{ route('filament.admin.auth.logout') }}" class="w-full">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-red-500 transition-colors w-full">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span class="font-medium">Keluar</span>
                </button>
            </form>
            <div class="mt-4 p-3 bg-slate-50 rounded-xl text-[10px] text-center text-slate-400">
                Made with ❤️ for Bunda
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 ml-64 flex flex-col min-h-screen">
        <!-- HEADER - Copy dari AdminPanelProvider -->
        <header class="h-20 bg-white border-b border-slate-100 flex items-center justify-between px-8 fixed top-0 right-0 left-64 z-10">
            <div class="flex flex-col">
                <span class="text-[10px] uppercase tracking-widest text-slate-400 font-bold">Dapur Digital Bunda</span>
                <span class="text-sm text-slate-600">Mari sajikan yang terbaik hari ini ✨</span>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-bold text-slate-800">{{ Auth::user()->name ?? 'Bunda Admin' }}</p>
                    <p class="text-[10px] text-[#C06044] font-bold uppercase">Pemilik Toko</p>
                </div>
                <img 
                    src="https://picsum.photos/seed/{{ Auth::user()->id ?? 'admin' }}/100/100" 
                    alt="Admin" 
                    class="w-10 h-10 rounded-full border-2 border-[#C06044]/20 object-cover"
                >
            </div>
        </header>

        <!-- CONTENT AREA - Tempat konten halaman -->
        <div class="pt-20 p-8 flex-1 overflow-auto">
            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>