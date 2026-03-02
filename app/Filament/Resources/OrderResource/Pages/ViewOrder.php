<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    // 🔥 TAMBAHKAN METHOD INI
    public static function getResource(): string
    {
        return OrderResource::class;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Edit Pesanan')
                ->icon('heroicon-o-pencil')
                ->color('warning'),
            
            Actions\Action::make('whatsapp')
                ->label('Hubungi Customer')
                ->icon('heroicon-o-chat-bubble-left-right')
                ->color('success')
                ->url(fn ($record): string => 'https://wa.me/' . ($record->customer['telepon'] ?? '') . '?text=Halo%20' . urlencode($record->customer['nama'] ?? 'Customer') . '%2C%20kami%20dari%20Pempek%20Bunda%2075%2C%20ada%20info%20terkait%20pesanan%20Anda%20dengan%20ID%3A%20' . $record->kode_pesanan)
                ->openUrlInNewTab()
                ->visible(fn ($record) => !empty($record->customer['telepon'])),
            
            Actions\DeleteAction::make()
                ->label('Hapus')
                ->icon('heroicon-o-trash')
                ->color('danger'),
        ];
    }
}