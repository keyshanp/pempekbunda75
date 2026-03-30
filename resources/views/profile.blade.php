<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - PempekBunda 75</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-orange-600">
                        <i class="fas fa-fish"></i> PempekBunda 75
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-orange-600">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <span class="text-gray-700">{{ $user->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center mb-6">
                <div class="bg-orange-100 rounded-full p-3 mr-4">
                    <i class="fas fa-user text-orange-600 text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-800">Profil Pengguna</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user mr-2 text-orange-600"></i>Nama Lengkap
                        </label>
                        <p class="text-lg font-semibold text-gray-900 bg-gray-50 px-4 py-2 rounded-lg">
                            {{ $user->name }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-envelope mr-2 text-orange-600"></i>Alamat Email
                        </label>
                        <p class="text-lg text-gray-900 bg-gray-50 px-4 py-2 rounded-lg">
                            {{ $user->email }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar mr-2 text-orange-600"></i>Bergabung Sejak
                        </label>
                        <p class="text-lg text-gray-900 bg-gray-50 px-4 py-2 rounded-lg">
                            {{ $user->created_at->format('d M Y') }}
                        </p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user-tag mr-2 text-orange-600"></i>Status Akun
                        </label>
                        <p class="text-lg font-semibold {{ $user->is_admin ? 'text-red-600' : 'text-green-600' }} bg-gray-50 px-4 py-2 rounded-lg">
                            {{ $user->is_admin ? 'Administrator' : 'User Biasa' }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-clock mr-2 text-orange-600"></i>Terakhir Login
                        </label>
                        <p class="text-lg text-gray-900 bg-gray-50 px-4 py-2 rounded-lg">
                            {{ $user->updated_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('dashboard') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg transition text-center">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Dashboard
                    </a>
                    <a href="{{ route('profile.edit') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition text-center">
                        <i class="fas fa-edit mr-2"></i>Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
