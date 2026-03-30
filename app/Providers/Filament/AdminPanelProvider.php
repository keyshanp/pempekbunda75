<?php

namespace App\Providers\Filament;

use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\NavigationGroup;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Support\Str;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(\App\Filament\Pages\Auth\AdminLogin::class)
            ->passwordReset()
            ->profile()
            ->colors([
                'primary' => Color::hex('#BC5A42'),
                'secondary' => Color::hex('#8C9440'),
                'accent' => Color::hex('#E6A34F'),
                'danger' => Color::hex('#EF4444'),
                'warning' => Color::hex('#F59E0B'),
                'info' => Color::hex('#3B82F6'),
                'success' => Color::hex('#10B981'),
                'gray' => Color::hex('#64748B'),
            ])
            ->font('Inter')
            ->brandName('PempekBunda 75')
            ->brandLogo(null)
            ->brandLogoHeight('3rem')
            ->favicon(asset('favicon.ico'))
            ->darkMode(false)
            
            // 🔥 NAVIGATION GROUPS
            ->navigationGroups([
                'Manajemen Data',
                'Transaksi & Keuangan',
                'Laporan',
            ])
            
            ->navigationItems([
    // ... items yang sudah ada
    NavigationItem::make('Feedback Analytics')
        ->label('Feedback Analytics')
        ->icon('heroicon-o-chart-bar')
        ->url('/admin/feedback-analytics')
        ->group('Manajemen Data')
        ->sort(4),
])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                \App\Filament\Widgets\StatsOverview::class,
                \App\Filament\Widgets\ProdukChartWidget::class,
                \App\Filament\Widgets\AktivitasTerbaruWidget::class,
                \App\Filament\Widgets\TransaksiTerbaruWidget::class,
            ])
            ->pages([
            \App\Filament\Pages\FeedbackDetail::class,
        ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                \Filament\Http\Middleware\Authenticate::class,
                \App\Http\Middleware\AdminMiddleware::class,
            ])
            ->sidebarCollapsibleOnDesktop(false)
            ->sidebarFullyCollapsibleOnDesktop(false)
            ->collapsedSidebarWidth('5rem')
            ->sidebarWidth('16rem')
            ->topNavigation(false)
            ->maxContentWidth('full')
            ->globalSearch(true)
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->breadcrumbs(false)
            
            // 🔥 RENDER HOOK UNTUK HEAD - CSS CUSTOM
            ->renderHook(
                'panels::head.start',
                function (): string {
                    return '
                        <!-- Google Fonts -->
                        <link rel="preconnect" href="https://fonts.googleapis.com">
                        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                        <link href="https://fonts.googleapis.com/css2?family=Gaegu:wght@400;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
                        
                        <!-- Custom CSS -->
                        <style>
                            /* ============================
                               RESET FILAMENT SIDEBAR & TOPBAR
                               ============================ */
                            .fi-sidebar {
                                display: none !important;
                            }
                            
                            .fi-topbar {
                                display: none !important;
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
                            
                            /* Brand Header - WITH MORE SPACING */
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
                            
                            /* Navigation Menu - SEMUA MENU */
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
                            
                            /* Topbar user info */
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
                            
                            /* ============================
                               CONTENT AREA - FULL WIDTH
                               ============================ */
                            .fi-main {
                                background: #FDFBF7 !important;
                                padding: 2rem 3rem !important;
                                padding-top: 7rem !important;
                                min-height: 100vh !important;
                                margin-left: 16rem !important;
                                width: calc(100% - 16rem) !important;
                                max-width: none !important;
                            }
                            
                            .fi-page-header {
                                background: transparent !important;
                                padding: 0 !important;
                                margin-bottom: 3rem !important;
                                border: none !important;
                                max-width: none !important;
                            }
                            
                            .fi-page-header-heading {
                                color: #BC5A42 !important;
                                font-family: "Gaegu", cursive !important;
                                font-size: 3rem !important;
                                font-weight: 700 !important;
                                margin-bottom: 0.5rem !important;
                                line-height: 1.2 !important;
                                max-width: none !important;
                            }
                            
                            .fi-page-header-description {
                                color: rgba(74, 59, 52, 0.6) !important;
                                font-size: 1.1rem !important;
                                font-weight: 400 !important;
                                font-family: "Inter", sans-serif !important;
                                line-height: 1.6 !important;
                                max-width: none !important;
                            }
                            
                            /* ============================
                               STATS CARDS - REACT STYLE
                               ============================ */
                            .stats-grid {
                                display: grid !important;
                                grid-template-columns: repeat(1, 1fr) !important;
                                gap: 1.5rem !important;
                                margin-bottom: 2.5rem !important;
                                max-width: none !important;
                            }
                            
                            @media (min-width: 768px) {
                                .stats-grid {
                                    grid-template-columns: repeat(2, 1fr) !important;
                                }
                            }
                            
                            @media (min-width: 1024px) {
                                .stats-grid {
                                    grid-template-columns: repeat(4, 1fr) !important;
                                }
                            }
                            
                            .stat-card {
                                background: white !important;
                                padding: 1.5rem !important;
                                border-radius: 1.5rem !important;
                                border: 2px solid rgba(140, 148, 64, 0.1) !important;
                                box-shadow: 0 4px 12px rgba(140, 148, 64, 0.08) !important;
                                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                                position: relative !important;
                                overflow: hidden !important;
                                max-width: none !important;
                            }
                            
                            .stat-card:hover {
                                transform: translateY(-4px) !important;
                                box-shadow: 0 12px 24px rgba(140, 148, 64, 0.15) !important;
                                border-color: rgba(140, 148, 64, 0.3) !important;
                            }
                            
                            .stat-card::before {
                                content: "" !important;
                                position: absolute !important;
                                top: 0 !important;
                                left: 0 !important;
                                right: 0 !important;
                                height: 4px !important;
                                background: linear-gradient(90deg, #BC5A42, #8C9440) !important;
                                border-radius: 4px 4px 0 0 !important;
                            }
                            
                            /* ============================
                               RESPONSIVE
                               ============================ */
                            @media (max-width: 768px) {
                                .react-sidebar {
                                    width: 100% !important;
                                    height: auto !important;
                                    position: relative !important;
                                    padding: 1rem !important;
                                }
                                
                                .custom-topbar {
                                    left: 0 !important;
                                    padding: 1rem !important;
                                }
                                
                                .fi-main {
                                    margin-left: 0 !important;
                                    width: 100% !important;
                                    padding: 1.5rem !important;
                                    padding-top: 6rem !important;
                                }
                                
                                .fi-page-header-heading {
                                    font-size: 2.5rem !important;
                                }
                                
                                .brand-title {
                                    font-size: 2rem !important;
                                }
                                
                                .sidebar-motto {
                                    font-size: 1rem !important;
                                }
                            }
                        </style>
                    ';
                }
            )
            
            // 🔥 RENDER HOOK UNTUK BODY START - SIDEBAR & TOPBAR
            ->renderHook(
                'panels::body.start',
                function (): string {
                    // Determine active menu based on current route
                    $currentPath = request()->path();
                    $active = 'dashboard';
                    
                    // Deteksi halaman aktif berdasarkan URL
                    if (Str::contains($currentPath, 'produks') || Str::contains($currentPath, 'produk')) {
                        $active = 'products';
                    } elseif (Str::contains($currentPath, 'orders') || Str::contains($currentPath, 'pesanans')) {
                        $active = 'orders';
                    } elseif (Str::contains($currentPath, 'transaksis')) {
                        $active = 'transactions';
                    } elseif (Str::contains($currentPath, 'feedback')) { // 🔥 TAMBAHKAN INI
                        $active = 'feedback';
                    }
                    
                    // MENU ITEMS - LENGKAP DENGAN URL YANG BENAR
                    $menuItems = [
                        'dashboard' => [
                            'label' => 'Dashboard',
                            'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                            'url' => url('/admin'),
                        ],
                        'products' => [
                            'label' => 'Produk',
                            'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z',
                            'url' => url('/admin/produks'),
                        ],
                        'orders' => [
                            'label' => 'Pesanan',
                            'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z',
                            'url' => url('/admin/orders'),
                        ],
                        'feedback' => [ // 🔥 MENU FEEDBACK BARU
                            'label' => 'Feedback',
                            'icon' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z',
                            'url' => url('/admin/feedback'),
                        ],
                        'transactions' => [
                            'label' => 'Transaksi',
                            'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                            'url' => url('/admin/transaksis'),
                        ],
                    ];
                    
                    $logoutUrl = route('filament.admin.auth.logout');
                    
                    return '
                        <!-- CUSTOM REACT-LIKE SIDEBAR -->
                        <div class="react-sidebar">
                            <!-- Brand Header -->
                            <div class="sidebar-brand">
                                <h1 class="brand-title brand-title-top">Pempek</h1>
                                <h1 class="brand-title">Bunda 75</h1>
                                <div class="brand-divider"></div>
                                <p class="sidebar-motto">Mari sajikan yang terbaik hari ini ✨</p>
                            </div>

                            <!-- Navigation Menu - SEMUA MENU -->
                            <nav class="sidebar-nav">
                                ' . implode('', array_map(function($key, $item) use ($active) {
                                    $isActive = $active === $key;
                                    return '
                                        <a href="' . $item['url'] . '" 
                                           class="sidebar-item ' . ($isActive ? 'sidebar-item-active' : '') . '">
                                            <svg class="sidebar-icon ' . ($isActive ? 'text-white' : 'text-[#BC5A42]') . '" 
                                                 fill="none" 
                                                 stroke="currentColor" 
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="' . $item['icon'] . '" />
                                            </svg>
                                            <span>' . $item['label'] . '</span>
                                        </a>
                                    ';
                                }, array_keys($menuItems), $menuItems)) . '
                            </nav>

                            <!-- Footer Section -->
                            <div class="sidebar-footer">
                                <form method="POST" action="' . $logoutUrl . '" class="w-full">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <button type="submit" class="sidebar-logout-btn">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        <span>Keluar</span>
                                    </button>
                                </form>
                                
                                <!-- Made with love -->
                                <div class="made-with-love">
                                    <p>
                                        Made with 
                                        <svg class="w-3.5 h-3.5" fill="#BC5A42" stroke="#BC5A42" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
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
                                    <div class="user-name">Bunda Admin</div>
                                    <div class="user-role">Pemilik Toko</div>
                                </div>
                                <div class="user-avatar">
                                    <img src="https://picsum.photos/seed/bunda/100/100" alt="Admin">
                                </div>
                            </div>
                        </div>
                    ';
                }
            )
            
            // 🔥 RENDER HOOK UNTUK BODY END - JAVASCRIPT
            ->renderHook(
                'panels::body.end',
                function (): string {
                    return '
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                console.log("🎨 React-style dashboard loaded!");
                                
                                // 1. Update Dashboard Header
                                setTimeout(() => {
                                    const heading = document.querySelector(".fi-page-header-heading");
                                    if (heading && heading.textContent.includes("Dashboard")) {
                                        heading.textContent = "Dashboard Bunda";
                                        heading.style.opacity = "0";
                                        heading.style.transform = "translateY(20px)";
                                        
                                        setTimeout(() => {
                                            heading.style.transition = "all 0.6s cubic-bezier(0.4, 0, 0.2, 1)";
                                            heading.style.opacity = "1";
                                            heading.style.transform = "translateY(0)";
                                        }, 300);
                                    }
                                    
                                    // Update dashboard description
                                    const description = document.querySelector(".fi-page-header-description");
                                    if (description) {
                                        description.textContent = "Selamat datang kembali di dapur digital Bunda! Kelola pempek, pantau penjualan, dan berkembang bersama kami.";
                                    }
                                    
                                    // 2. FORCE PRODUCTS URL to /admin/produks
                                    document.querySelectorAll(".sidebar-item").forEach(item => {
                                        if (item.textContent.includes("Produk")) {
                                            item.href = "/admin/produks";
                                        }
                                    });
                                    
                                    // 3. FORCE ORDERS URL to /admin/orders
                                    document.querySelectorAll(".sidebar-item").forEach(item => {
                                        if (item.textContent.includes("Pesanan")) {
                                            item.href = "/admin/orders";
                                        }
                                    });
                                    
                                    // 4. FORCE FEEDBACK URL to /admin/feedback
                                    document.querySelectorAll(".sidebar-item").forEach(item => {
                                        if (item.textContent.includes("Customer Reviews")) {
                                            item.href = "/admin/feedback";
                                        }
                                    });
                                    
                                    // 5. Add stats grid layout
                                    const statsContainer = document.querySelector(".fi-main > div:first-child");
                                    if (statsContainer && statsContainer.querySelectorAll(".fi-widget").length > 0) {
                                        statsContainer.classList.add("stats-grid");
                                        statsContainer.querySelectorAll(".fi-widget").forEach(widget => {
                                            widget.classList.add("stat-card");
                                        });
                                    }
                                    
                                    // 6. Make content area FULL WIDTH
                                    const mainContent = document.querySelector(".fi-main");
                                    if (mainContent) {
                                        mainContent.style.maxWidth = "none";
                                        mainContent.style.width = "calc(100% - 16rem)";
                                    }
                                    
                                    // 7. Hide unwanted Filament sidebar items
                                    const unwantedItems = ["Pelanggan", "Customers", "Pengaturan", "Settings", "Laporan", "Reports"];
                                    document.querySelectorAll(".fi-sidebar-item").forEach(item => {
                                        const text = item.textContent;
                                        if (unwantedItems.some(unwanted => text.includes(unwanted))) {
                                            item.style.display = "none";
                                        }
                                    });
                                    
                                }, 1000);
                                
                                // 8. Add click handler for custom sidebar items
                                document.querySelectorAll(".sidebar-item").forEach(item => {
                                    item.addEventListener("click", function(e) {
                                        // Remove active class from all items
                                        document.querySelectorAll(".sidebar-item").forEach(i => {
                                            i.classList.remove("sidebar-item-active");
                                            const icon = i.querySelector(".sidebar-icon");
                                            if (icon) {
                                                icon.classList.remove("text-white");
                                                icon.classList.add("text-[#BC5A42]");
                                            }
                                        });
                                        
                                        // Add active class to clicked item
                                        this.classList.add("sidebar-item-active");
                                        const icon = this.querySelector(".sidebar-icon");
                                        if (icon) {
                                            icon.classList.add("text-white");
                                            icon.classList.remove("text-[#BC5A42]");
                                        }
                                    });
                                });
                            });
                        </script>
                    ';
                }
            );
    }
}
