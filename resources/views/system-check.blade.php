<!DOCTYPE html>
<html>
<head>
    <title>System Check</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .success { color: green; }
        .error { color: red; }
        table { border-collapse: collapse; width: 100%; }
        td, th { border: 1px solid #ddd; padding: 8px; }
        tr:nth-child(even) { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>System Check - Pempek Bunda 75</h1>
    
    <h2>Basic Checks</h2>
    <table>
        @foreach($checks as $key => $value)
        <tr>
            <td><strong>{{ $key }}</strong></td>
            <td class="{{ strpos($value, '✅') !== false ? 'success' : (strpos($value, '❌') !== false ? 'error' : '') }}">
                {{ $value }}
            </td>
        </tr>
        @endforeach
    </table>
    
    <h2>Filament Classes</h2>
    <table>
        @foreach($filamentClasses as $class => $exists)
        <tr>
            <td><strong>{{ $class }}</strong></td>
            <td class="{{ $exists ? 'success' : 'error' }}">
                {{ $exists ? '✅ Found' : '❌ Not Found' }}
            </td>
        </tr>
        @endforeach
    </table>
    
    <h2>User Details</h2>
    @if($user)
    <table>
        <tr><td>Name</td><td>{{ $user->name }}</td></tr>
        <tr><td>Email</td><td>{{ $user->email }}</td></tr>
        <tr><td>Is Admin</td><td>{{ $user->is_admin ? 'Yes' : 'No' }}</td></tr>
        <tr><td>Created</td><td>{{ $user->created_at }}</td></tr>
    </table>
    @else
    <p class="error">User not found!</p>
    @endif
    
    <h2>Test Links</h2>
    <ul>
        <li><a href="/admin" target="_blank">/admin (Filament Panel)</a></li>
        <li><a href="/admin/login" target="_blank">/admin/login (Filament Login)</a></li>
        <li><a href="/" target="_blank">Home Page</a></li>
        <li><a href="/register" target="_blank">Register Page</a></li>
    </ul>
    
    <h2>Quick Fixes</h2>
    <pre>
# Clear cache:
php artisan optimize:clear

# Reinstall Filament:
composer require filament/filament:"^3.2" -W

# Create admin user:
php artisan tinker
>>> \App\Models\User::create([
...     'name' => 'Admin',
...     'email' => 'admin@test.com',
...     'password' => Hash::make('password'),
...     'is_admin' => true,
... ]);
    </pre>
</body>
</html>