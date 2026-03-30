<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Carbon;

class AktivitasTerbaruWidget extends Widget
{
    protected static string $view = 'filament.widgets.aktivitas-terbaru';
    protected static ?int $sort = 3;
    protected static ?string $pollingInterval = '30s';

    public function getViewData(): array
    {
        return [
            'activities' => $this->getActivities(),
        ];
    }

    protected function getActivities(): array
    {
        return [
            [
                'icon' => 'heroicon-o-cube',
                'icon_color' => '#8C9440',
                'icon_bg' => 'rgba(140, 148, 64, 0.1)',
                'title' => 'Stok Baru Masuk',
                'description' => 'Paket A telah ditambah +50 pcs',
                'time' => '2 Jam Lalu',
            ],
            [
                'icon' => 'heroicon-o-shopping-cart',
                'icon_color' => '#BC5A42',
                'icon_bg' => 'rgba(188, 90, 66, 0.1)',
                'title' => 'Pesanan Baru',
                'description' => 'Order #INV-2019-0012 diproses',
                'time' => '4 Jam Lalu',
            ],
            [
                'icon' => 'heroicon-o-user-plus',
                'icon_color' => '#E6A34F',
                'icon_bg' => 'rgba(230, 163, 79, 0.1)',
                'title' => 'Pelanggan Baru',
                'description' => 'Budi Santoso mendaftar',
                'time' => '6 Jam Lalu',
            ],
            [
                'icon' => 'heroicon-o-currency-dollar',
                'icon_color' => '#10B981',
                'icon_bg' => 'rgba(16, 185, 129, 0.1)',
                'title' => 'Pembayaran Diterima',
                'description' => 'Rp 450.000 dari Order #INV-2019-0011',
                'time' => '1 Hari Lalu',
            ],
        ];
    }
}