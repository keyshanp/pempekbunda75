<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    // 🔥 TAMBAHKAN METHOD INI JIKA BELUM ADA
    public static function getResource(): string
    {
        return OrderResource::class;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Pesanan Manual')
                ->icon('heroicon-o-plus')
                ->color('success'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua')
                ->icon('heroicon-o-list-bullet'),
            'pending' => Tab::make('Menunggu')
                ->icon('heroicon-o-clock')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_pesanan', 'pending')),
            'paid' => Tab::make('Dibayar')
                ->icon('heroicon-o-check-circle')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_pesanan', 'paid')),
            'processed' => Tab::make('Diproses')
                ->icon('heroicon-o-cog')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_pesanan', 'processed')),
            'shipped' => Tab::make('Dikirim')
                ->icon('heroicon-o-truck')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_pesanan', 'shipped')),
            'completed' => Tab::make('Selesai')
                ->icon('heroicon-o-check-badge')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_pesanan', 'completed')),
        ];
    }
}