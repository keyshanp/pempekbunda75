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
    
    // ✅ HOOK SETELAH SAVE - BUAT TRANSAKSI OTOMATIS
    protected function afterSave(): void
    {
        $record = $this->record;
        $oldStatus = $this->record->getOriginal('status_pesanan');
        $newStatus = $this->record->status_pesanan;
        
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
                
                \Log::info("Transaksi {$kodeTransaksi} dibuat otomatis untuk order {$record->kode_pesanan}");
                
                // Notifikasi sukses
                \Filament\Notifications\Notification::make()
                    ->title('Transaksi Dibuat')
                    ->body("Transaksi {$kodeTransaksi} berhasil dibuat otomatis")
                    ->success()
                    ->send();
            }
        }
        
        // ✅ KEMBALIKAN STOK JIKA ORDER DIBATALKAN
        if ($newStatus === 'cancelled' && $oldStatus !== 'cancelled') {
            $items = is_array($record->items) ? $record->items : json_decode($record->items, true);
            
            foreach ($items as $item) {
                $produk = \App\Models\Produk::find($item['id']);
                if ($produk) {
                    $produk->increment('stok', $item['quantity']);
                    \Log::info("Stok produk '{$produk->nama_produk}' dikembalikan {$item['quantity']}. Stok sekarang: {$produk->stok}");
                }
            }
        }
    }
}