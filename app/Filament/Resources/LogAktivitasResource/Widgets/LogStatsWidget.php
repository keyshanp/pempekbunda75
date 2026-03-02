<?php

namespace App\Filament\Resources\LogAktivitasResource\Widgets;

use App\Models\LogAktivitas;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class LogStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        
        return [
            Stat::make('Total Log', LogAktivitas::count())
                ->description('Semua waktu')
                ->descriptionIcon('heroicon-o-clipboard-document-list')
                ->color('primary')
                ->chart($this->getChartData()),
                
            Stat::make('Hari Ini', LogAktivitas::whereDate('created_at', $today)->count())
                ->description('vs kemarin: ' . LogAktivitas::whereDate('created_at', $yesterday)->count())
                ->descriptionIcon('heroicon-o-calendar')
                ->color('success'),
                
            Stat::make('Aksi Create', LogAktivitas::where('action', 'create')->count())
                ->description('Data ditambahkan')
                ->descriptionIcon('heroicon-o-plus-circle')
                ->color('info'),
                
            Stat::make('Aksi Delete', LogAktivitas::where('action', 'delete')->count())
                ->description('Data dihapus')
                ->descriptionIcon('heroicon-o-trash')
                ->color('danger'),
        ];
    }
    
    protected function getChartData(): array
    {
        // Data untuk chart 7 hari terakhir
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $count = LogAktivitas::whereDate('created_at', $date)->count();
            $data[] = $count;
        }
        
        return $data;
    }
}