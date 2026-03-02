<?php

namespace App\Filament\Admin\Resources\PembayaranResource\Pages;

use App\Filament\Admin\Resources\PembayaranResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Pembelian;

class CreatePembayaran extends CreateRecord
{
    protected static string $resource = PembayaranResource::class;

    /**
     * AUTO HITUNG KEMBALIAN + KURANGI STOK
     */
protected function mutateFormDataBeforeCreate(array $data): array
{
    $pembelian = \App\Models\Pembelian::with('items.produk')
        ->find($data['pembelian_id']);

    // hitung kembalian
    $data['kembalian'] = $data['bayar'] - $pembelian->total;

    // kurangi stok
    foreach ($pembelian->items as $item) {
        $produk = $item->produk;
        $produk->stok -= $item->qty;
        $produk->save();
    }

    // update status pembelian
    $pembelian->status = 'LUNAS';
    $pembelian->save();

    return $data;
}

}
