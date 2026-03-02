<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PembayaranResource\Pages;
use App\Models\Pembayaran;
use App\Models\Pembelian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationLabel = 'Pembayaran';
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Transaksi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Select::make('pembelian_id')
                    ->label('Kode Pembelian')
                    ->relationship(
                        name: 'pembelian',
                        titleAttribute: 'kode_pembelian',
                        modifyQueryUsing: fn ($query) =>
                            $query->where('status', '!=', 'LUNAS')
                    )
                    ->required()
                    ->reactive(),

                Select::make('metode')
                    ->label('Metode Pembayaran')
                    ->options([
                        'cash' => 'Cash',
                        'transfer' => 'Transfer',
                    ])
                    ->required(),

                TextInput::make('bayar')
                    ->label('Bayar')
                    ->numeric()
                    ->required()
                    ->reactive()
                    ->minValue(function (callable $get) {
                        $pembelianId = $get('pembelian_id');

                        if (!$pembelianId) {
                            return 0;
                        }

                        $pembelian = Pembelian::find($pembelianId);

                        return $pembelian?->total ?? 0;
                    })
                    ->helperText('Uang bayar tidak boleh kurang dari total pembelian'),

                TextInput::make('kembalian')
                    ->label('Kembalian')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pembelian.kode_pembelian')
                    ->label('Kode Pembelian')
                    ->searchable(),

                Tables\Columns\TextColumn::make('metode')
                    ->label('Metode'),

                Tables\Columns\TextColumn::make('bayar')
                    ->label('Bayar')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('kembalian')
                    ->label('Kembalian')
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
            'index' => Pages\ListPembayarans::route('/'),
            'create' => Pages\CreatePembayaran::route('/create'),
        ];
    }
}
