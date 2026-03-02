<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class ProdukChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Statistik Produk';
    protected static ?int $sort = 2;
    protected static ?string $maxHeight = '400px';

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        // Generate data untuk 7 hari terakhir
        $labels = [];
        $data = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->translatedFormat('d M');
            
            // Generate data random untuk demo
            // Di aplikasi nyata, ganti dengan query database
            $data[] = rand(1000, 5000) * 1000; // Random dalam ribuan
        }

        return [
            'datasets' => [
                [
                    'label' => 'Penjualan (Rp)',
                    'data' => $data,
                    'backgroundColor' => 'rgba(188, 90, 66, 0.1)',
                    'borderColor' => '#BC5A42',
                    'borderWidth' => 3,
                    'fill' => true,
                    'tension' => 0.4,
                    'pointBackgroundColor' => '#BC5A42',
                    'pointBorderColor' => '#fff',
                    'pointBorderWidth' => 2,
                    'pointRadius' => 5,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                    'labels' => [
                        'color' => '#4A3B34',
                        'font' => [
                            'size' => 14,
                            'weight' => '600',
                        ],
                    ],
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'grid' => [
                        'color' => 'rgba(140, 148, 64, 0.05)',
                    ],
                    'ticks' => [
                        'color' => '#4A3B34',
                        'callback' => 'function(value) {
                            return "Rp " + (value / 1000).toLocaleString("id-ID") + "K";
                        }',
                    ],
                ],
                'x' => [
                    'grid' => [
                        'display' => false,
                    ],
                    'ticks' => [
                        'color' => '#4A3B34',
                    ],
                ],
            ],
        ];
    }
}