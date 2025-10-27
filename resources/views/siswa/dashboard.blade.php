<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9fff9;
            color: #333;
            text-align: center;
            padding: 50px;
        }
        .logout-btn {
            display: inline-block;
            margin-top: 20px;
            background: #e74c3c;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
            transition: background 0.2s ease;
        }
        .logout-btn:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>

    <h1>Dashboard Siswa</h1>
    <p>Halo, {{ $user->nama ?? $user->email }}!</p>
    <p>Role: {{ $user->role }}</p>

    <!-- Tombol Logout -->
    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
    </form>

</body>
</html>
