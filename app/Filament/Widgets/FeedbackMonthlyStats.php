<?php

namespace App\Filament\Widgets;

use App\Models\Feedback;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class FeedbackMonthlyStats extends Widget
{
    use InteractsWithPageFilters;
    
    protected static string $view = 'filament.widgets.feedback-monthly-stats';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 3;

    public function getMonthlyStats($months = 6)
    {
        try {
            $stats = [];
            for ($i = $months - 1; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $month = $date->format('M Y');
                
                $count = Feedback::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count();
                
                $stats[$month] = $count;
            }
            return $stats;
        } catch (\Exception $e) {
            $stats = [];
            for ($i = 5; $i >= 0; $i--) {
                $stats[now()->subMonths($i)->format('M Y')] = 0;
            }
            return $stats;
        }
    }

    public function getMaxCount()
    {
        $stats = $this->getMonthlyStats();
        return empty($stats) ? 1 : max($stats);
    }

    public function getTotal6Months()
    {
        return array_sum($this->getMonthlyStats());
    }

    public function getAveragePerMonth()
    {
        $stats = $this->getMonthlyStats();
        return count($stats) > 0 ? round(array_sum($stats) / count($stats), 1) : 0;
    }

    public function getGrowth()
    {
        $stats = $this->getMonthlyStats(2);
        $values = array_values($stats);
        
        if (count($values) < 2 || $values[0] == 0) {
            return ['percentage' => 0, 'trend' => 'stable'];
        }
        
        $previous = $values[0];
        $current = $values[1];
        $growth = (($current - $previous) / $previous) * 100;
        
        return [
            'percentage' => round($growth, 1),
            'trend' => $growth > 0 ? 'up' : ($growth < 0 ? 'down' : 'stable')
        ];
    }
}