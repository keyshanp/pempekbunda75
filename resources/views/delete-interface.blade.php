<!DOCTYPE html>
<html>
<head>
    <title>Hapus Produk - Pempek Bunda</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background: #f3f4f6; }
        .btn { padding: 8px 16px; text-decoration: none; border-radius: 4px; display: inline-block; }
        .btn-danger { background: #ef4444; color: white; }
        .btn-danger:hover { background: #dc2626; }
        .btn-success { background: #10b981; color: white; }
        .btn-primary { background: #3b82f6; color: white; }
        .alert-success { background: #d1fae5; padding: 12px; border-radius: 5px; margin-bottom: 20px; }
        .alert-error { background: #fee2e2; padding: 12px; border-radius: 5px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>🗑️ Hapus Produk - Pempek Bunda</h1>
    
    @if(session('success'))
        <div class="alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert-error">
            ❌ {{ session('error') }}
        </div>
    @endif
    
    @if($produks->isEmpty())
        <p>Tidak ada produk.</p>
    @else
        <table>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            
            @foreach($produks as $produk)
            <tr>
                <td>{{ $produk->id }}</td>
                <td>{{ $produk->nama_produk }}</td>
                <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                <td>{{ $produk->stok }}</td>
                <td>
                    @if($produk->status)
                        <span style="color: #10b981;">● Aktif</span>
                    @else
                        <span style="color: #ef4444;">● Nonaktif</span>
                    @endif
                </td>
                <td>
                    <a href="/confirm-delete/{{ $produk->id }}" 
                       class="btn btn-danger"
                       onclick="return confirm('Yakin hapus {{ $produk->nama_produk }}?')">
                        Hapus
                    </a>
                </td>
            </tr>
            @endforeach
        </table>
        
        <p style="margin-top: 20px; color: #6b7280;">
            Total: {{ $produks->count() }} produk
        </p>
    @endif
    
    <br>
    <div style="margin-top: 30px;">
        <a href="/admin/produks" class="btn btn-primary">Buka Admin Filament</a>
        <a href="/simple-delete" class="btn btn-success" style="margin-left: 10px;">Simple Delete</a>
        <a href="/" class="btn" style="margin-left: 10px; background: #6b7280; color: white;">Homepage</a>
    </div>
</body>
</html>