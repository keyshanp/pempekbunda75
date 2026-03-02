<!DOCTYPE html>
<html>
<head><title>Profil</title></head>
<body>
    <h1>Profil User</h1>
    <p>Nama: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
    <a href="{{ route('dashboard') }}">Kembali ke Dashboard</a>
</body>
</html>