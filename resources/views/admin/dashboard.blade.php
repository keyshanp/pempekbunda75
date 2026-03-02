<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Pempek Bunda 75</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>
        <p>Selamat datang, Administrator!</p>
        
        <form method="POST" action="{{ route('admin.logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">
                Logout Admin
            </button>
        </form>
    </div>
</body>
</html>