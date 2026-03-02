<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    public static function getResource(): string
    {
        return OrderResource::class;
    }

    // 🔥 OVERRIDE FORM DI SINI, PASTI TIDAK ERROR
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('status_pesanan')
                    ->label('Status Pesanan')
                    ->options([
                        'pending' => 'Menunggu',
                        'paid' => 'Dibayar',
                        'processed' => 'Diproses',
                        'shipped' => 'Dikirim',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    ])
                    ->required(),
                
                Select::make('status_pembayaran')
                    ->label('Status Pembayaran')
                    ->options([
                        'belum_bayar' => 'Belum Dibayar',
                        'sudah_bayar' => 'Sudah Bayar',
                        'verifikasi' => 'Perlu Verifikasi',
                        'gagal' => 'Gagal',
                    ])
                    ->required(),
                
                Textarea::make('catatan_admin')
                    ->label('Catatan Admin')
                    ->rows(3),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->label('Lihat'),
            Actions\DeleteAction::make()
                ->label('Hapus'),
        ];
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
    protected function getSavedNotificationTitle(): ?string
    {
        return 'Pesanan berhasil diperbarui';
    }
}