<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: #f4fff6;
            color: #333;
            margin: 0;
            padding: 40px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }
        h1 {
            color: #2e7d32;
            margin-bottom: 10px;
        }
        .summary {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
        }
        .card {
            background: #e8f5e9;
            border-radius: 10px;
            padding: 20px;
            width: 30%;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .card h2 {
            margin: 0;
            color: #1b5e20;
            font-size: 2em;
        }
        .card p {
            margin-top: 5px;
            color: #555;
        }
        .menu {
            margin-top: 40px;
            text-align: left;
        }
        .menu a {
            display: block;
            background: #dcedc8;
            color: #2e7d32;
            padding: 12px 20px;
            margin-bottom: 10px;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.2s ease;
            font-weight: 500;
        }
        .menu a:hover {
            background: #c5e1a5;
        }
        .logout-btn {
            display: inline-block;
            margin-top: 30px;
            background: #e74c3c;
            color: white;
            padding: 10px 25px;
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

    <div class="container">
        <h1>Selamat Datang, Pak/Bu {{ $user->nama }}</h1>
        <p>Role: {{ $user->role }}</p>

        <div class="summary">
            <div class="card">
                <h2>{{ $jumlahPelajaran ?? 0 }}</h2>
                <p>Pelajaran yang Diajar</p>
            </div>
            <div class="card">
                <h2>{{ $jumlahSiswa ?? 0 }}</h2>
                <p>Jumlah Siswa</p>
            </div>
        </div>

        <!-- Menu Mata Pelajaran -->
        <div class="menu">
           <a href="{{ route('guru.mata-pelajaran') }}">📘 Kelola Mata Pelajaran</a>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

</body>
</html>
