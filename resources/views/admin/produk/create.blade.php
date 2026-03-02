<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="mb-6">
                <a href="{{ route('admin.produk.index') }}" class="text-blue-600 hover:underline">
                    ← Kembali ke Daftar Produk
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h1 class="text-2xl font-bold mb-6">Tambah Produk Baru</h1>

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="nama_produk" class="block text-gray-700 font-medium mb-2">Nama Produk *</label>
                        <input type="text" 
                               id="nama_produk" 
                               name="nama_produk" 
                               value="{{ old('nama_produk') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                               required>
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                        <textarea id="deskripsi" 
                                  name="deskripsi" 
                                  rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="harga" class="block text-gray-700 font-medium mb-2">Harga (Rp) *</label>
                            <input type="number" 
                                   id="harga" 
                                   name="harga" 
                                   value="{{ old('harga') }}"
                                   min="0"
                                   class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                                   required>
                        </div>
                        <div>
                            <label for="stok" class="block text-gray-700 font-medium mb-2">Stok *</label>
                            <input type="number" 
                                   id="stok" 
                                   name="stok" 
                                   value="{{ old('stok', 0) }}"
                                   min="0"
                                   class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                                   required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="gambar" class="block text-gray-700 font-medium mb-2">Gambar Produk</label>
                        <input type="file" 
                               id="gambar" 
                               name="gambar" 
                               accept="image/*"
                               class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB.</p>
                    </div>

                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" 
                                   name="status" 
                                   value="1"
                                   {{ old('status', true) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-gray-700">Aktif (tampilkan di toko)</span>
                        </label>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" 
                                class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Simpan Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Preview gambar sebelum upload
        document.getElementById('gambar').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Tampilkan preview jika belum ada
                    let preview = document.getElementById('image-preview');
                    if (!preview) {
                        preview = document.createElement('div');
                        preview.id = 'image-preview';
                        preview.className = 'mt-4';
                        document.querySelector('form').insertBefore(preview, document.querySelector('button[type="submit"]').parentElement);
                    }
                    preview.innerHTML = `
                        <p class="text-gray-700 font-medium mb-2">Preview:</p>
                        <img src="${e.target.result}" alt="Preview" class="w-32 h-32 object-cover rounded border">
                    `;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>