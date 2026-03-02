<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Konfirmasi Hapus' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg max-w-md w-full p-6">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-800">Hapus Produk</h2>
            <p class="text-gray-600 mt-2">Anda akan menghapus produk:</p>
            <p class="font-semibold text-lg mt-1 text-gray-900">{{ $produk->nama_produk }}</p>
            <p class="text-sm text-gray-500 mt-2">Rp {{ number_format($produk->harga, 0, ',', '.') }} • Stok: {{ $produk->stok }}</p>
        </div>
        
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
            <p class="text-red-700 text-sm">⚠️ Tindakan ini tidak dapat dibatalkan. Produk akan dihapus permanen.</p>
        </div>
        
        <form method="POST" action="{{ route('produk.delete.execute', $produk->id) }}" class="space-y-4">
            @csrf
            @method('DELETE')
            
            <div class="flex gap-3">
                <a href="/admin/produks" 
                   class="flex-1 py-3 px-4 text-center border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="flex-1 py-3 px-4 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors">
                    Ya, Hapus
                </button>
            </div>
        </form>
    </div>
</body>
</html>