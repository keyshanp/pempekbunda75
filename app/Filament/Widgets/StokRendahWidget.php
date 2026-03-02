<?php

namespace App\Filament\Widgets;

use App\Models\Produk;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Storage;

class StokRendahWidget extends BaseWidget
{
    protected static ?string $heading = 'Produk Stok Rendah';
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Produk::query()
                    ->where('stok', '<', 10)
                    ->orderBy('stok', 'asc')
            )
            ->columns([
                Tables\Columns\ImageColumn::make('gambar')
                    ->label('')
                    ->disk('public')
                    ->circular()
                    ->size(40)
                    ->defaultImageUrl(url('/images/default-product.png')),
                    
                Tables\Columns\TextColumn::make('nama_produk')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable()
                    ->weight('600')
                    ->color('#4A3B34'),
                    
                Tables\Columns\TextColumn::make('kategori.nama')
                    ->label('Kategori')
                    ->badge()
                    ->color('secondary'),
                    
                Tables\Columns\TextColumn::make('stok')
                    ->label('Stok')
                    ->sortable()
                    ->color('danger')
                    ->icon('heroicon-o-exclamation-triangle')
                    ->iconPosition('after')
                    ->formatStateUsing(fn ($state): string => $state . ' pcs')
                    ->weight('bold'),
                    
                Tables\Columns\TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR')
                    ->color('#BC5A42')
                    ->weight('600'),
                    
                Tables\Columns\IconColumn::make('status')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
            ])
            ->actions([
                Tables\Actions\Action::make('tambah_stok')
                    ->icon('heroicon-o-plus')
                    ->color('success')
                    ->url(fn ($record): string => route('filament.admin.resources.produks.edit', $record)),
                    
                Tables\Actions\Action::make('lihat')
                    ->icon('heroicon-o-eye')
                    ->color('primary')
                    ->url(fn ($record): string => route('filament.admin.resources.produks.edit', $record)),
            ])
            ->headerActions([
                Tables\Actions\Action::make('export')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('warning'),
            ])
            ->emptyStateHeading('Tidak ada produk dengan stok rendah')
            ->emptyStateDescription('Semua produk memiliki stok yang cukup.')
            ->emptyStateIcon('heroicon-o-check-circle')
            ->emptyStateActions([
                Tables\Actions\Action::make('create')
                    ->label('Tambah Produk')
                    ->url(route('filament.admin.resources.produks.create'))
                    ->icon('heroicon-o-plus')
                    ->button(),
            ]);
    }
}