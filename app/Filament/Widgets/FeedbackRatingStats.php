<?php

namespace App\Filament\Widgets;

use App\Models\Feedback;
use Filament\Widgets\Widget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class FeedbackRatingStats extends Widget
{
    use InteractsWithPageFilters;
    
    protected static string $view = 'filament.widgets.feedback-rating-stats';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function getRatingDistribution()
    {
        try {
            return [
                5 => Feedback::where('rating', 5)->count(),
                4 => Feedback::where('rating', 4)->count(),
                3 => Feedback::where('rating', 3)->count(),
                2 => Feedback::where('rating', 2)->count(),
                1 => Feedback::where('rating', 1)->count(),
            ];
        } catch (\Exception $e) {
            return [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
        }
    }

    public function getAverageRating()
    {
        try {
            $avg = Feedback::avg('rating');
            return $avg ? round($avg, 1) : 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function getTotalRating()
    {
        try {
            return Feedback::sum('rating');
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function getTotalFeedback()
    {
        try {
            return Feedback::count();
        } catch (\Exception $e) {
            return 0;
        }
    }
}