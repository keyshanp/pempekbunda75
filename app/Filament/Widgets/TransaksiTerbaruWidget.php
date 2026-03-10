<?php

namespace App\Filament\Widgets;

use App\Models\Transaksi;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TransaksiTerbaruWidget extends BaseWidget
{
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';
    
    public function table(Table $table): Table
    {
        return $table
            ->heading('📊 Transaksi Terbaru')
            ->query(
                Transaksi::query()
                    ->with('order')
                    ->latest()
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('kode_transaksi')
                    ->label('Kode')
                    ->searchable()
                    ->weight('bold')
                    ->copyable(),
                    
                Tables\Columns\TextColumn::make('order.customer')
                    ->label('Customer')
                    ->formatStateUsing(fn ($state) => is_array($state) ? ($state['nama'] ?? '-') : '-')
                    ->icon('heroicon-o-user'),
                    
                Tables\Columns\TextColumn::make('metode_pembayaran')
                    ->label('Metode')
                    ->formatStateUsing(function ($record) {
                        return $record->getMetodePembayaranIcon() . ' ' . $record->getMetodePembayaranText();
                    }),
                    
                Tables\Columns\TextColumn::make('jumlah_bayar')
                    ->label('Jumlah')
                    ->money('IDR')
                    ->weight('bold'),
                    
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'success' => 'success',
                        'pending' => 'warning',
                        'failed' => 'danger',
                        'expired' => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'success' => 'Berhasil',
                        'pending' => 'Pending',
                        'failed' => 'Gagal',
                        'expired' => 'Expired',
                    }),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Lihat')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Transaksi $record): string => route('filament.admin.resources.transaksis.edit', $record))
                    ->openUrlInNewTab(),
            ]);
    }
}
