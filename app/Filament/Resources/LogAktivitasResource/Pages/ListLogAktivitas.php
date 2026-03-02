<?php

namespace App\Filament\Resources\LogAktivitasResource\Pages;

use App\Filament\Resources\LogAktivitasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLogAktivitas extends ListRecords  // ← NAMA CLASS HARUS SAMA DENGAN NAMA FILE
{
    protected static string $resource = LogAktivitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('refresh')
                ->label('Refresh Data')
                ->icon('heroicon-o-arrow-path')
                ->color('gray')
                ->action(fn () => $this->refreshTableData()),
            
            Actions\Action::make('clear_old_logs')
                ->label('Bersihkan Log Lama')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('Bersihkan Log Lama')
                ->modalDescription('Log yang berumur lebih dari 30 hari akan dihapus. Tindakan ini tidak dapat dibatalkan.')
                ->modalSubmitActionLabel('Ya, Hapus')
                ->action(function () {
                    $deletedCount = \App\Models\LogAktivitas::where('created_at', '<', now()->subDays(30))->delete();
                    
                    // Log aktivitas
                    \App\Models\LogAktivitas::create([
                        'user_id' => auth()->id(),
                        'user_name' => auth()->user()->name,
                        'action' => 'delete',
                        'model' => 'LogAktivitas',
                        'description' => "Membersihkan {$deletedCount} log aktivitas yang berumur > 30 hari",
                    ]);
                    
                    $this->refreshTableData();
                    $this->dispatch('notify', [
                        'title' => 'Berhasil!',
                        'message' => "{$deletedCount} log lama telah dihapus.",
                        'status' => 'success',
                    ]);
                })
                ->visible(fn () => \App\Models\LogAktivitas::where('created_at', '<', now()->subDays(30))->exists()),
        ];
    }
    
    protected function refreshTableData(): void
    {
        $this->resetTable();
        $this->dispatch('refreshTable');
    }
    
    protected function getHeaderWidgets(): array
    {
        return [
            // LogAktivitasResource\Widgets\LogStatsWidget::class, // Comment dulu jika belum ada
        ];
    }
}