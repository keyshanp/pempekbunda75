<!DOCTYPE html>
<html>
<head>
    <title>Konfirmasi Hapus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h4>Konfirmasi Hapus Produk</h4>
            </div>
            <div class="card-body">
                <p>Anda akan menghapus produk:</p>
                <h5 class="text-danger">{{ $produk->nama_produk }}</h5>
                <p>Harga: Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                <p>Stok: {{ $produk->stok }}</p>
                
                <form method="POST" action="/confirm-delete/{{ $produk->id }}">
                    @csrf
                    <div class="mt-4">
                        <button type="submit" class="btn btn-danger">
                            Ya, Hapus Produk
                        </button>
                        <a href="/admin/produks" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>