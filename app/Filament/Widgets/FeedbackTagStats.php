<?php

namespace App\Filament\Widgets;

use App\Models\Feedback;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class FeedbackTagStats extends Widget
{
    use InteractsWithPageFilters;
    
    protected static string $view = 'filament.widgets.feedback-tag-stats';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 1;

    public function getTagStats()
    {
        try {
            $allTags = Feedback::whereNotNull('tags')
                ->where('tags', '!=', '[]')
                ->where('tags', '!=', 'null')
                ->get()
                ->pluck('tags')
                ->flatten()
                ->toArray();
            
            $tagCounts = array_count_values($allTags);
            arsort($tagCounts);
            
            return $tagCounts;
        } catch (\Exception $e) {
            return [];
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

    public function getTotalTags()
    {
        try {
            $allTags = Feedback::whereNotNull('tags')
                ->where('tags', '!=', '[]')
                ->where('tags', '!=', 'null')
                ->get()
                ->pluck('tags')
                ->flatten()
                ->toArray();
            
            return count(array_unique($allTags));
        } catch (\Exception $e) {
            return 0;
        }
    }
}