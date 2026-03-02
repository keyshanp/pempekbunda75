<?php

namespace App\Filament\Resources\LogAktivitasResource\Pages;

use App\Filament\Resources\LogAktivitasResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLogAktivitas extends ViewRecord
{
    protected static string $resource = LogAktivitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('back')
                ->label('Kembali ke Daftar')
                ->url($this->getResource()::getUrl('index'))
                ->color('gray')
                ->icon('heroicon-o-arrow-left'),
                
            Actions\Action::make('print')
                ->label('Cetak')
                ->icon('heroicon-o-printer')
                ->color('secondary')
                ->action(function () {
                    $this->js('window.print()');
                }),
                
            Actions\DeleteAction::make()
                ->requiresConfirmation()
                ->modalHeading('Hapus Log Aktivitas')
                ->modalDescription('Apakah Anda yakin ingin menghapus log aktivitas ini? Tindakan ini tidak dapat dibatalkan.')
                ->modalSubmitActionLabel('Ya, Hapus')
                ->successNotificationTitle('Log aktivitas berhasil dihapus'),
        ];
    }
    
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Format JSON data untuk tampilan yang lebih baik
        if (isset($data['old_data']) && is_string($data['old_data'])) {
            $data['old_data'] = json_encode(json_decode($data['old_data']), JSON_PRETTY_PRINT);
        }
        
        if (isset($data['new_data']) && is_string($data['new_data'])) {
            $data['new_data'] = json_encode(json_decode($data['new_data']), JSON_PRETTY_PRINT);
        }
        
        // Format waktu
        if (isset($data['created_at'])) {
            $data['created_at'] = \Carbon\Carbon::parse($data['created_at'])->format('d M Y H:i:s');
        }
        
        return $data;
    }
}