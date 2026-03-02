<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiResource\Pages;
use App\Models\Transaksi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'Transaksi';
    protected static ?string $modelLabel = 'Transaksi';
    protected static ?string $pluralModelLabel = 'Laporan Transaksi';
    protected static ?string $navigationGroup = 'Manajemen Toko';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Transaksi')
                    ->schema([
                        Forms\Components\TextInput::make('kode_transaksi')
                            ->required()
                            ->maxLength(50)
                            ->default(fn() => (new Transaksi())->generateKodeTransaksi())
                            ->disabled()
                            ->dehydrated(),
                            
                        Forms\Components\Select::make('pesanan_id')
                            ->label('Pesanan')
                            ->relationship('order', 'kode_pesanan')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $order = \App\Models\Order::find($state);
                                    if ($order) {
                                        $set('jumlah_bayar', $order->total);
                                    }
                                }
                            }),
                            
                        Forms\Components\Select::make('metode_pembayaran')
                            ->options([
                                'cash' => 'Cash',
                                'gopay' => 'GoPay',
                                'dana' => 'DANA',
                                'ovo' => 'OVO',
                                'shopeepay' => 'ShopeePay',
                                'qris' => 'QRIS',
                                'transfer_bank' => 'Transfer Bank',
                                'kredit' => 'Kartu Kredit',
                            ])
                            ->required()
                            ->reactive(),
                            
                        Forms\Components\TextInput::make('nama_bank')
                            ->label('Nama Bank')
                            ->visible(fn(callable $get) => $get('metode_pembayaran') === 'transfer_bank')
                            ->maxLength(100),
                            
                        Forms\Components\TextInput::make('nomor_rekening')
                            ->label('Nomor Rekening')
                            ->visible(fn(callable $get) => $get('metode_pembayaran') === 'transfer_bank')
                            ->maxLength(50),
                            
                        Forms\Components\TextInput::make('nama_pemilik_rekening')
                            ->label('Nama Pemilik Rekening')
                            ->visible(fn(callable $get) => $get('metode_pembayaran') === 'transfer_bank')
                            ->maxLength(100),
                    ])->columns(2),
                    
                Forms\Components\Section::make('Detail Pembayaran')
                    ->schema([
                        Forms\Components\TextInput::make('jumlah_bayar')
                            ->label('Jumlah Bayar')
                            ->required()
                            ->numeric()
                            ->prefix('Rp'),
                            
                        Forms\Components\FileUpload::make('bukti_pembayaran')
                            ->label('Bukti Pembayaran')
                            ->image()
                            ->directory('bukti-pembayaran')
                            ->disk('public')
                            ->maxSize(2048)
                            ->imageEditor(),
                            
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'success' => 'Success',
                                'failed' => 'Failed',
                                'expired' => 'Expired',
                            ])
                            ->required()
                            ->default('pending'),
                            
                        Forms\Components\DateTimePicker::make('waktu_pembayaran')
                            ->label('Waktu Pembayaran')
                            ->nullable(),
                            
                        Forms\Components\DateTimePicker::make('waktu_konfirmasi')
                            ->label('Waktu Konfirmasi')
                            ->nullable(),
                            
                        Forms\Components\Textarea::make('catatan')
                            ->label('Catatan')
                            ->rows(2),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_transaksi')
                    ->label('Kode Transaksi')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('bold'),
                    
                Tables\Columns\TextColumn::make('order.kode_pesanan')
                    ->label('Kode Pesanan')
                    ->searchable()
                    ->sortable()
                    ->url(fn($record) => OrderResource::getUrl('view', ['record' => $record->pesanan_id]))
                    ->color('primary'),
                    
                Tables\Columns\TextColumn::make('metode_pembayaran')
                    ->label('Metode Pembayaran')
                    ->formatStateUsing(function ($record) {
                        $icon = $record->getMetodePembayaranIcon();
                        $text = $record->getMetodePembayaranText();
                        return $icon . ' ' . $text;
                    })
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('jumlah_bayar')
                    ->label('Jumlah')
                    ->money('IDR')
                    ->sortable()
                    ->weight('bold'),
                    
                Tables\Columns\ImageColumn::make('bukti_pembayaran')
                    ->label('Bukti')
                    ->disk('public')
                    ->width(50)
                    ->height(50)
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn($record) => $record->getStatusBadge())
                    ->html()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('waktu_pembayaran')
                    ->label('Waktu Bayar')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('waktu_konfirmasi')
                    ->label('Waktu Konfirmasi')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('metode_pembayaran')
                    ->label('Metode Pembayaran')
                    ->options([
                        'cash' => 'Cash',
                        'gopay' => 'GoPay',
                        'dana' => 'DANA',
                        'ovo' => 'OVO',
                        'shopeepay' => 'ShopeePay',
                        'qris' => 'QRIS',
                        'transfer_bank' => 'Transfer Bank',
                        'kredit' => 'Kartu Kredit',
                    ]),
                    
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'success' => 'Success',
                        'failed' => 'Failed',
                        'expired' => 'Expired',
                    ]),
                    
                Tables\Filters\Filter::make('waktu_pembayaran')
                    ->form([
                        Forms\Components\DatePicker::make('dari_tanggal'),
                        Forms\Components\DatePicker::make('sampai_tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['dari_tanggal'], fn($q, $date) => $q->whereDate('waktu_pembayaran', '>=', $date))
                            ->when($data['sampai_tanggal'], fn($q, $date) => $q->whereDate('waktu_pembayaran', '<=', $date));
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->color('info'),
                    
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-pencil')
                    ->color('warning'),
                    
                Tables\Actions\Action::make('lihat_bukti')
                    ->label('')
                    ->icon('heroicon-o-photo')
                    ->color('primary')
                    ->modalHeading('Bukti Pembayaran')
                    ->modalContent(function ($record) {
                        if (!$record->bukti_pembayaran) {
                            return view('filament.components.no-image');
                        }
                        
                        return view('filament.components.image-viewer', [
                            'imageUrl' => Storage::url($record->bukti_pembayaran),
                            'title' => 'Bukti Pembayaran - ' . $record->kode_transaksi,
                        ]);
                    })
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup')
                    ->visible(fn($record) => !empty($record->bukti_pembayaran)),
                    
                Tables\Actions\Action::make('konfirmasi')
                    ->label('')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->tooltip('Konfirmasi pembayaran')
                    ->visible(fn($record) => $record->status === 'pending')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'success',
                            'waktu_konfirmasi' => now(),
                        ]);
                        
                        // Update status pembayaran di pesanan
                        if ($record->order) {
                            $record->order->update([
                                'status_pembayaran' => 'sudah_bayar',
                                'status_pesanan' => 'paid'
                            ]);
                        }
                        
                        \Filament\Notifications\Notification::make()
                            ->title('Transaksi dikonfirmasi')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Transaksi Terpilih')
                        ->icon('heroicon-o-trash')
                        ->color('danger'),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50, 100]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }
}