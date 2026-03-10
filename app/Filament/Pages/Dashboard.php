<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = 'Dashboard Admin';
    protected static ?int $navigationSort = -2;
    
    // Gunakan custom view
    protected static string $view = 'filament.pages.custom-dashboard';
    
    // Widgets yang akan ditampilkan
    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\StatsOverview::class,
        ];
    }
    
    protected function getFooterWidgets(): array
    {
        return [
            \App\Filament\Widgets\ProdukChartWidget::class,
            \App\Filament\Widgets\TransaksiTerbaruWidget::class,
            \App\Filament\Widgets\AktivitasTerbaruWidget::class,
            \App\Filament\Widgets\StokRendahWidget::class,
        ];
    }
    
    // Override untuk custom description
    public static function getNavigationBadge(): ?string
    {
        return '✨';
    }
}