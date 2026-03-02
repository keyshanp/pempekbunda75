// app/Models/Penjualan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penjualan extends Model
{
    protected $fillable = [
        'kode_transaksi',
        'produk_id',
        'quantity',
        'harga_satuan',
        'total_harga',
        'status'
    ];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class);
    }
}