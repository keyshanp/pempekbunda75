<?php

namespace App\Filament\Admin\Resources\PembelianResource\Pages;

use App\Filament\Admin\Resources\PembelianResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Produk;

class CreatePembelian extends CreateRecord
{
    protected static string $resource = PembelianResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $total = 0;

        foreach ($data['items'] as &$item) {
            $produk = Produk::find($item['produk_id']);

            $item['harga'] = $produk->harga;
            $item['subtotal'] = $produk->harga * $item['qty'];

            $total += $item['subtotal'];
        }

        $data['total'] = $total;

        return $data;
    }
}
