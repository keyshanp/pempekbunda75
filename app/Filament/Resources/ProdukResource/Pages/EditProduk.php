<?php

namespace App\Filament\Resources\ProdukResource\Pages;

use App\Filament\Resources\ProdukResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditProduk extends EditRecord
{
    protected static string $resource = ProdukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // 🔥 KOMENTAR ATAU HAPUS DELETE ACTION INI
            // Actions\DeleteAction::make()
            //     ->label('Hapus Produk')
            //     ->icon('heroicon-o-trash')
            //     ->color('danger')
            //     ->modalHeading('Hapus Produk')
            //     ->modalDescription('Apakah Anda yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan.')
            //     ->modalSubmitActionLabel('Ya, Hapus')
            //     ->modalCancelActionLabel('Batal'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Produk berhasil diperbarui!';
    }
}