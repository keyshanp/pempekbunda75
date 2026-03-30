<?php

namespace App\Filament\Resources\TransaksiResource\Pages;

use App\Filament\Resources\TransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransaksis extends ListRecords
{
    protected static string $resource = TransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('create_transaksi')
                ->label('Tambah Transaksi')
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->url(route('coming-soon'))
                ->openUrlInNewTab(false),
        ];
    }
}