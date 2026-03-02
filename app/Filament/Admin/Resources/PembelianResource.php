<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PembelianResource\Pages;
use App\Models\Pembelian;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PembelianResource extends Resource
{
    protected static ?string $model = Pembelian::class;

    protected static ?string $navigationLabel = 'Pembelian';
    protected static ?string $navigationIcon = 'heroicon-o-receipt-refund';
    protected static ?string $navigationGroup = 'Transaksi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode_pembelian')
                    ->label('Kode Pembelian')
                    ->default(fn () => 'TRX-' . now()->timestamp)
                    ->disabled()
                    ->dehydrated(),

                Repeater::make('items')
                    ->relationship()
                    ->label('Daftar Produk')
                    ->schema([
                        Select::make('produk_id')
                            ->label('Produk')
                            ->options(Produk::pluck('nama_produk', 'id'))
                            ->reactive()
                            ->required(),

                        TextInput::make('qty')
                            ->label('Qty')
                            ->numeric()
                            ->default(1)
                            ->reactive()
                            ->required(),

                        TextInput::make('harga')
                            ->label('Harga')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(),

                        TextInput::make('subtotal')
                            ->label('Subtotal')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(),
                    ])
                    ->afterStateUpdated(function ($state, callable $set) {
                        $total = 0;

                        foreach ($state as $item) {
                            $total += $item['subtotal'] ?? 0;
                        }

                        $set('total', $total);
                    })
                    ->columnSpanFull(),

                TextInput::make('total')
                    ->label('Total')
                    ->numeric()
                    ->prefix('Rp')
                    ->disabled()
                    ->dehydrated(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_pembelian')
                    ->label('Kode')
                    ->searchable(),

                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPembelians::route('/'),
            'create' => Pages\CreatePembelian::route('/create'),
            'view' => Pages\ViewPembelian::route('/{record}'),
        ];
    }
}
