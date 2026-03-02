<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Feedback;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

class FeedbackDashboard extends Page implements HasTable
{
    use InteractsWithTable;
    
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    
    protected static string $view = 'filament.pages.feedback-dashboard';
    
    protected static ?string $navigationLabel = 'Feedback Analytics';
    
    protected static ?string $title = 'Feedback Analytics';
    
    protected static ?string $slug = 'feedback-analytics';
    
    protected static ?int $navigationSort = 4;
    
    public function getTitle(): string
    {
        return 'Feedback Analytics';
    }
    
    public function table(Table $table): Table
    {
        return $table
            ->query(Feedback::query())
            ->columns([
                TextColumn::make('kode_pesanan')
                    ->label('Order')
                    ->searchable()
                    ->copyable()
                    ->sortable(),
                    
                TextColumn::make('user_name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => $record->user_email),
                    
                TextColumn::make('rating')
                    ->label('Rating')
                    ->formatStateUsing(fn ($state) => str_repeat('⭐', $state))
                    ->badge()
                    ->color('warning')
                    ->sortable(),
                    
                TextColumn::make('tags')
                    ->label('Tags')
                    ->formatStateUsing(function ($state) {
                        if (empty($state) || !is_array($state)) {
                            return '-';
                        }
                        return implode(', ', $state);
                    })
                    ->badge()
                    ->separator(',')
                    ->limitList(2)
                    ->expandableLimitedList(),
                    
                TextColumn::make('review')
                    ->label('Review')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->review)
                    ->searchable(),
                    
                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc');
    }
    
    public function getMonthlyStats()
    {
        try {
            return Feedback::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, count(*) as count')
                ->groupBy('month')
                ->orderBy('month', 'asc')
                ->get();
        } catch (\Exception $e) {
            return collect([]);
        }
    }
    
    public function getTagStats()
    {
        try {
            $allFeedback = Feedback::whereNotNull('tags')->get();
            $tagCounts = [];
            
            foreach ($allFeedback as $feedback) {
                $tags = $feedback->tags ?? [];
                foreach ($tags as $tag) {
                    $tagCounts[$tag] = ($tagCounts[$tag] ?? 0) + 1;
                }
            }
            
            arsort($tagCounts);
            return $tagCounts;
        } catch (\Exception $e) {
            return [];
        }
    }
    
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
    
    public function getTotalFeedback()
    {
        try {
            return Feedback::count();
        } catch (\Exception $e) {
            return 0;
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
    
    public function getThisMonthCount()
    {
        try {
            return Feedback::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count();
        } catch (\Exception $e) {
            return 0;
        }
    }
}