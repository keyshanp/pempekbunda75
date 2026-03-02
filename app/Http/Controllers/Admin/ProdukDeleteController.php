<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukDeleteController extends Controller
{
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        
        return redirect('/admin/produks')
            ->with('success', 'Produk berhasil dihapus');
    }
}