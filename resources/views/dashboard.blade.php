<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Dashboard User</h1>
        
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Selamat datang, {{ $user->name }}!</h2>
            <p class="text-gray-600 mb-4">Email: {{ $user->email }}</p>
            <p class="text-gray-600">Status: {{ $user->is_admin ? 'Administrator' : 'User Biasa' }}</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold mb-2">Aksi Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('produk.index') }}" class="text-blue-600 hover:underline">Lihat Produk</a></li>
                    <li><a href="{{ route('profile') }}" class="text-blue-600 hover:underline">Profil Saya</a></li>
                    <li><a href="{{ route('about') }}" class="text-blue-600 hover:underline">Tentang Kami</a></li>
                </ul>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold mb-2">Admin Panel</h3>
                @if($user->is_admin)
                    <a href="/admin" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        🚀 Buka Admin Panel
                    </a>
                @else
                    <p class="text-gray-500">Anda bukan administrator</p>
                @endif
            </div>
        </div>
        
        <div class="mt-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Logout
                </button>
            </form>
        </div>
    </div>
</body>
</html>