<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    
    protected static ?string $navigationLabel = 'Pesanan';
    
    protected static ?string $modelLabel = 'Pesanan';
    
    protected static ?string $pluralModelLabel = 'Daftar Pesanan';
    
    protected static ?string $navigationGroup = 'Manajemen Toko';
    
    protected static ?int $navigationSort = 2;
    
    protected static ?string $recordTitleAttribute = 'kode_pesanan';
    
    protected static ?string $slug = 'orders';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Status Pesanan')
                    ->schema([
                        Forms\Components\Select::make('status_pesanan')
                            ->label('Status Pesanan')
                            ->options([
                                'pending' => 'Menunggu',
                                'paid' => 'Dibayar',
                                'processed' => 'Diproses',
                                'shipped' => 'Dikirim',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                            ])
                            ->required()
                            ->native(false),
                        
                        Forms\Components\Select::make('status_pembayaran')
                            ->label('Status Pembayaran')
                            ->options([
                                'belum_bayar' => 'Belum Dibayar',
                                'sudah_bayar' => 'Sudah Dibayar',
                                'verifikasi' => 'Perlu Verifikasi',
                                'gagal' => 'Gagal',
                            ])
                            ->required()
                            ->native(false),
                        
                        Forms\Components\Textarea::make('catatan_admin')
                            ->label('Catatan Admin')
                            ->rows(3),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_pesanan')
                    ->label('ID Pesanan')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('ID Pesanan disalin')
                    ->weight('bold')
                    ->color('primary'),
                
                TextColumn::make('customer_nama')
                    ->label('Nama Customer')
                    ->searchable()
                    ->sortable()
                    ->getStateUsing(function ($record) {
                        $customer = $record->customer;
                        return is_array($customer) ? ($customer['nama'] ?? '-') : '-';
                    })
                    ->description(function ($record) {
                        $customer = $record->customer;
                        return is_array($customer) ? ($customer['telepon'] ?? '') : '';
                    }),
                
                TextColumn::make('customer_alamat')
                    ->label('Alamat')
                    ->getStateUsing(function ($record) {
                        $customer = $record->customer;
                        return is_array($customer) ? ($customer['alamat'] ?? '-') : '-';
                    })
                    ->limit(30)
                    ->tooltip(function ($record) {
                        $customer = $record->customer;
                        return is_array($customer) ? ($customer['alamat'] ?? '-') : '-';
                    }),
                
                TextColumn::make('items_count')
                    ->label('Items')
                    ->getStateUsing(function ($record) {
                        $items = $record->items;
                        return count($items ?? []) . ' item';
                    })
                    ->badge()
                    ->color('gray'),
                
                TextColumn::make('total')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable()
                    ->weight('bold')
                    ->color('success'),
                
                TextColumn::make('status_pesanan')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'paid' => 'success',
                        'processed' => 'info',
                        'shipped' => 'primary',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Menunggu',
                        'paid' => 'Dibayar',
                        'processed' => 'Diproses',
                        'shipped' => 'Dikirim',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                        default => $state,
                    })
                    ->sortable(),
                
                TextColumn::make('status_pembayaran')
                    ->label('Pembayaran')
                    ->badge()
                    ->getStateUsing(function ($record) {
                        // Jika order sudah melewati tahap dibayar, maka anggap sudah bayar
                        $paidStatuses = ['paid', 'processed', 'shipped', 'completed'];

                        if (in_array($record->status_pesanan, $paidStatuses)) {
                            return 'sudah_bayar';
                        }

                        // Jika ada transaksi sukses, anggap sudah bayar
                        if ($record->transaksis()->where('status', 'success')->exists()) {
                            return 'sudah_bayar';
                        }

                        return $record->status_pembayaran ?? 'belum_bayar';
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'belum_bayar' => 'danger',
                        'sudah_bayar' => 'success',
                        'verifikasi' => 'warning',
                        'gagal' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'belum_bayar' => 'Belum Bayar',
                        'sudah_bayar' => 'Sudah Bayar',
                        'verifikasi' => 'Perlu Verifikasi',
                        'gagal' => 'Gagal',
                        default => $state,
                    })
                    ->sortable(),
                
                TextColumn::make('pengiriman')
                    ->label('Pengiriman')
                    ->getStateUsing(function ($record) {
                        $delivery = $record->delivery;
                        if (!is_array($delivery)) return '-';
                        return ($delivery['metode'] ?? '') === 'pickup' ? 'Ambil Sendiri' : 'GoSend';
                    })
                    ->badge()
                    ->color(fn ($state) => $state === 'Ambil Sendiri' ? 'gray' : 'primary'),
                
                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('status_pesanan')
                    ->label('Filter Status Pesanan')
                    ->options([
                        'pending' => 'Menunggu',
                        'paid' => 'Dibayar',
                        'processed' => 'Diproses',
                        'shipped' => 'Dikirim',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    ])
                    ->multiple()
                    ->placeholder('Semua Status'),
                
                SelectFilter::make('status_pembayaran')
                    ->label('Filter Status Pembayaran')
                    ->options([
                        'belum_bayar' => 'Belum Bayar',
                        'sudah_bayar' => 'Sudah Bayar',
                        'verifikasi' => 'Perlu Verifikasi',
                        'gagal' => 'Gagal',
                    ])
                    ->multiple(),
                
                Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('dari_tanggal')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('sampai_tanggal')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['dari_tanggal'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['sampai_tanggal'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->columns(2)
                    ->columnSpanFull(),
            ])
            ->actions([
                // 🔥 GANTI ViewAction dengan Action yang TIDAK ADA LABEL // Tooltip tetap ada
                    
                // 🔥 GANTI EditAction dengan Action custom yang mengarah ke halaman Blade
                Tables\Actions\Action::make('update_status')
                    ->label('Update Status')
                    ->icon('heroicon-o-pencil')
                    ->color('warning')
                    ->url(fn ($record): string => route('admin.orders.edit-status', $record->kode_pesanan))
                    ->openUrlInNewTab(false),
                
                Tables\Actions\Action::make('whatsapp')
                    ->label('WA')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->url(function ($record): string {
                        $customer = $record->customer;
                        $telepon = is_array($customer) ? ($customer['telepon'] ?? '') : '';
                        $nama = is_array($customer) ? ($customer['nama'] ?? 'Customer') : 'Customer';
                        
                        return 'https://wa.me/' . $telepon . '?text=Halo%20' . urlencode($nama) . '%2C%20kami%20dari%20Pempek%20Bunda%2075%2C%20ada%20info%20terkait%20pesanan%20Anda%20dengan%20ID%3A%20' . $record->kode_pesanan;
                    })
                    ->openUrlInNewTab()
                    ->visible(fn ($record): bool => is_array($record->customer) && !empty($record->customer['telepon'] ?? '')),
                
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Pesanan')
                    ->modalDescription('Apakah Anda yakin ingin menghapus pesanan ini? Tindakan ini tidak dapat dibatalkan.')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Pesanan dihapus')
                            ->body('Pesanan berhasil dihapus.'),
                    ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Pesanan Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menghapus pesanan yang dipilih? Tindakan ini tidak dapat dibatalkan.')
                        ->modalSubmitActionLabel('Ya, Hapus'),
                    
                    Tables\Actions\BulkAction::make('update_status')
                        ->label('Ubah Status')
                        ->icon('heroicon-o-arrow-path')
                        ->color('warning')
                        ->form([
                            Forms\Components\Select::make('status_pesanan')
                                ->label('Status Pesanan')
                                ->options([
                                    'pending' => 'Menunggu',
                                    'paid' => 'Dibayar',
                                    'processed' => 'Diproses',
                                    'shipped' => 'Dikirim',
                                    'completed' => 'Selesai',
                                    'cancelled' => 'Dibatalkan',
                                ])
                                ->required()
                                ->native(false),
                        ])
                        ->action(function ($records, array $data) {
                            foreach ($records as $record) {
                                $oldStatus = $record->status_pesanan;
                                $newStatus = $data['status_pesanan'];
                                
                                // Update status
                                $record->update(['status_pesanan' => $newStatus]);
                                
                                // ✅ BUAT TRANSAKSI OTOMATIS JIKA ORDER COMPLETED
                                if ($newStatus === 'completed' && $oldStatus !== 'completed') {
                                    // Cek apakah transaksi sudah ada
                                    $existingTransaksi = \App\Models\Transaksi::where('pesanan_id', $record->id)->first();
                                    
                                    if (!$existingTransaksi) {
                                        // Generate kode transaksi unik
                                        $kodeTransaksi = 'TRX-' . now()->format('Ymd') . '-' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
                                        
                                        // Ambil metode pembayaran dari order
                                        $payment = is_array($record->payment) ? $record->payment : json_decode($record->payment, true);
                                        $metodePembayaran = $payment['metode'] ?? 'qris';
                                        
                                        // Mapping metode pembayaran
                                        $metodeMap = [
                                            'qris' => 'qris',
                                            'transfer' => 'transfer_bank',
                                            'cod' => 'cash',
                                            'gopay' => 'gopay',
                                            'dana' => 'dana',
                                            'ovo' => 'ovo',
                                            'shopeepay' => 'shopeepay'
                                        ];
                                        
                                        $metodeFinal = $metodeMap[$metodePembayaran] ?? 'qris';
                                        
                                        // Buat transaksi
                                        \App\Models\Transaksi::create([
                                            'kode_transaksi' => $kodeTransaksi,
                                            'pesanan_id' => $record->id,
                                            'metode_pembayaran' => $metodeFinal,
                                            'jumlah_bayar' => $record->total,
                                            'status' => 'success',
                                            'waktu_pembayaran' => now(),
                                            'waktu_konfirmasi' => now(),
                                            'catatan' => 'Transaksi otomatis dari order completed'
                                        ]);
                                        
                                        Log::info("Transaksi {$kodeTransaksi} dibuat otomatis untuk order {$record->kode_pesanan}");
                                    }
                                }
                                
                                // ✅ KEMBALIKAN STOK JIKA ORDER DIBATALKAN
                                if ($newStatus === 'cancelled' && $oldStatus !== 'cancelled') {
                                    $items = is_array($record->items) ? $record->items : json_decode($record->items, true);
                                    
                                    foreach ($items as $item) {
                                        $produk = \App\Models\Produk::find($item['id']);
                                        if ($produk) {
                                            $produk->increment('stok', $item['quantity']);
                                            Log::info("Stok produk '{$produk->nama_produk}' dikembalikan {$item['quantity']}. Stok sekarang: {$produk->stok}");
                                        }
                                    }
                                }
                            }
                            
                            Notification::make()
                                ->title('Status berhasil diperbarui')
                                ->success()
                                ->send();
                        }),
                ]),
            ])
            ->emptyStateHeading('Belum ada pesanan')
            ->emptyStateDescription('Pesanan dari customer akan muncul di sini.')
            ->emptyStateIcon('heroicon-o-shopping-bag')
            ->emptyStateActions([
                Tables\Actions\Action::make('refresh')
                    ->label('Refresh')
                    ->icon('heroicon-o-arrow-path')
                    ->action(fn () => null),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('10s')
            ->striped();
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Pesanan')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('kode_pesanan')
                                    ->label('ID Pesanan')
                                    ->copyable()
                                    ->weight('bold')
                                    ->size(TextEntry\TextEntrySize::Large)
                                    ->color('primary'),
                                TextEntry::make('created_at')
                                    ->label('Tanggal Pesan')
                                    ->dateTime('d M Y H:i'),
                                TextEntry::make('status_pesanan')
                                    ->label('Status')
                                    ->badge()
                                    ->color(fn ($state): string => match ($state) {
                                        'pending' => 'warning',
                                        'paid' => 'success',
                                        'processed' => 'info',
                                        'shipped' => 'primary',
                                        'completed' => 'success',
                                        'cancelled' => 'danger',
                                        default => 'gray',
                                    })
                                    ->formatStateUsing(fn ($state): string => match ($state) {
                                        'pending' => 'Menunggu',
                                        'paid' => 'Dibayar',
                                        'processed' => 'Diproses',
                                        'shipped' => 'Dikirim',
                                        'completed' => 'Selesai',
                                        'cancelled' => 'Dibatalkan',
                                        default => $state,
                                    }),
                            ]),
                        
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('status_pembayaran')
                                    ->label('Status Pembayaran')
                                    ->badge()
                                    ->color(fn ($state): string => match ($state) {
                                        'belum_bayar' => 'danger',
                                        'sudah_bayar' => 'success',
                                        'verifikasi' => 'warning',
                                        'gagal' => 'gray',
                                        default => 'gray',
                                    })
                                    ->formatStateUsing(fn ($state): string => match ($state) {
                                        'belum_bayar' => 'Belum Bayar',
                                        'sudah_bayar' => 'Sudah Bayar',
                                        'verifikasi' => 'Perlu Verifikasi',
                                        'gagal' => 'Gagal',
                                        default => $state,
                                    }),
                                
                                TextEntry::make('delivery')
                                    ->label('Metode Pengiriman')
                                    ->formatStateUsing(function ($state) {
                                        if (!is_array($state)) return '-';
                                        return ($state['metode'] ?? '') === 'pickup' ? 'Ambil Sendiri' : 'GoSend';
                                    })
                                    ->badge()
                                    ->color(fn ($state) => $state === 'Ambil Sendiri' ? 'gray' : 'primary'),
                            ]),
                    ]),
                
                Section::make('Data Pemesan')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('customer')
                                    ->label('Nama Lengkap')
                                    ->formatStateUsing(fn ($state) => is_array($state) ? ($state['nama'] ?? '-') : '-')
                                    ->weight('bold'),
                                
                                TextEntry::make('customer')
                                    ->label('Email')
                                    ->formatStateUsing(fn ($state) => is_array($state) ? ($state['email'] ?? '-') : '-')
                                    ->copyable(),
                                
                                TextEntry::make('customer')
                                    ->label('WhatsApp')
                                    ->formatStateUsing(fn ($state) => is_array($state) ? ($state['telepon'] ?? '-') : '-')
                                    ->copyable()
                                    ->url(function ($state) {
                                        $telepon = is_array($state) ? ($state['telepon'] ?? '') : '';
                                        return 'https://wa.me/' . $telepon;
                                    })
                                    ->openUrlInNewTab()
                                    ->icon('heroicon-o-chat-bubble-left-right'),
                                
                                TextEntry::make('customer')
                                    ->label('Alamat Lengkap')
                                    ->formatStateUsing(fn ($state) => is_array($state) ? ($state['alamat'] ?? '-') : '-')
                                    ->columnSpanFull(),
                            ]),
                    ]),
                
                Section::make('Detail Pesanan')
                    ->schema([
                        RepeatableEntry::make('items')
                            ->schema([
                                Grid::make(12)
                                    ->schema([
                                        TextEntry::make('name')
                                            ->label('Produk')
                                            ->columnSpan(5)
                                            ->weight('bold'),
                                        TextEntry::make('quantity')
                                            ->label('Jumlah')
                                            ->columnSpan(2)
                                            ->badge()
                                            ->color('gray'),
                                        TextEntry::make('price')
                                            ->label('Harga')
                                            ->money('IDR')
                                            ->columnSpan(2),
                                        TextEntry::make('subtotal')
                                            ->label('Subtotal')
                                            ->money('IDR')
                                            ->columnSpan(3)
                                            ->weight('bold')
                                            ->color('success'),
                                    ]),
                            ])
                            ->contained(false)
                            ->columns(1),
                        
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('subtotal')
                                    ->label('Subtotal')
                                    ->money('IDR')
                                    ->size(TextEntry\TextEntrySize::Large),
                                
                                TextEntry::make('delivery')
                                    ->label('Ongkos Kirim')
                                    ->formatStateUsing(function ($state) {
                                        if (!is_array($state)) return 'Rp 0';
                                        $shippingCost = $state['shipping_cost'] ?? 0;
                                        return $shippingCost == 0 ? 'GRATIS' : 'Rp ' . number_format($shippingCost, 0, ',', '.');
                                    })
                                    ->size(TextEntry\TextEntrySize::Large),
                                
                                TextEntry::make('total')
                                    ->label('Total Pembayaran')
                                    ->money('IDR')
                                    ->weight('bold')
                                    ->color('success')
                                    ->size(TextEntry\TextEntrySize::Large),
                            ]),
                    ]),
                
                Section::make('Informasi Tambahan')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('payment')
                                    ->label('Metode Pembayaran')
                                    ->formatStateUsing(fn ($state) => is_array($state) ? strtoupper($state['metode'] ?? 'QRIS') : 'QRIS')
                                    ->badge()
                                    ->color('primary'),
                                
                                TextEntry::make('payment')
                                    ->label('Nama Pengirim')
                                    ->formatStateUsing(fn ($state) => is_array($state) ? ($state['nama_pengirim'] ?? '-') : '-'),
                            ]),
                        
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('customer')
                                    ->label('Koordinat Latitude')
                                    ->formatStateUsing(fn ($state) => is_array($state) ? ($state['lat'] ?? '-') : '-')
                                    ->copyable()
                                    ->visible(fn ($state) => is_array($state) && !empty($state['lat'] ?? '')),
                                
                                TextEntry::make('customer')
                                    ->label('Koordinat Longitude')
                                    ->formatStateUsing(fn ($state) => is_array($state) ? ($state['lng'] ?? '-') : '-')
                                    ->copyable()
                                    ->visible(fn ($state) => is_array($state) && !empty($state['lng'] ?? '')),
                            ]),
                        
                        TextEntry::make('customer')
                            ->label('Jarak dari Toko')
                            ->formatStateUsing(fn ($state) => is_array($state) && !empty($state['jarak']) ? $state['jarak'] . ' km' : '-')
                            ->visible(fn ($state) => is_array($state) && !empty($state['jarak'] ?? '')),
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }
}