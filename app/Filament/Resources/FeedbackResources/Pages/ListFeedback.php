<?php

namespace App\Filament\Resources\FeedbackResource\Pages;

use App\Filament\Resources\FeedbackResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListFeedback extends ListRecords
{
    protected static string $resource = FeedbackResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\FeedbackTagStats::class,
            \App\Filament\Widgets\FeedbackRatingStats::class,
            \App\Filament\Widgets\FeedbackMonthlyStats::class,
        ];
    }

    public function getTabs(): array
    {
        $getCount = function($query) {
            try {
                return $query->count();
            } catch (\Exception $e) {
                return 0;
            }
        };

        return [
            'all' => Tab::make('Semua Review')
                ->label('📋 Semua')
                ->icon('heroicon-o-list-bullet'),
            
            '5star' => Tab::make('5 Star')
                ->label('5 ⭐')
                ->icon('heroicon-o-star')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('rating', 5))
                ->badge($getCount(FeedbackResource::getModel()::where('rating', 5))),
            
            '4star' => Tab::make('4 Star')
                ->label('4 ⭐')
                ->icon('heroicon-o-star')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('rating', 4))
                ->badge($getCount(FeedbackResource::getModel()::where('rating', 4))),
            
            '3star' => Tab::make('3 Star')
                ->label('3 ⭐')
                ->icon('heroicon-o-star')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('rating', 3))
                ->badge($getCount(FeedbackResource::getModel()::where('rating', 3))),
            
            '2star' => Tab::make('2 Star')
                ->label('2 ⭐')
                ->icon('heroicon-o-star')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('rating', 2))
                ->badge($getCount(FeedbackResource::getModel()::where('rating', 2))),
            
            '1star' => Tab::make('1 Star')
                ->label('1 ⭐')
                ->icon('heroicon-o-star')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('rating', 1))
                ->badge($getCount(FeedbackResource::getModel()::where('rating', 1))),
        ];
    }
}