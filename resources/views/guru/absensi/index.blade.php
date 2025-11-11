<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Kelas</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4fff6; padding: 40px; color: #333; }
        .container { max-width: 900px; margin: 0 auto; background: #fff; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 30px; }
        h1 { color: #2e7d32; margin-bottom: 20px; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: center; }
        th { background: #e8f5e9; color: #1b5e20; }
        .btn-simpan { background: #2e7d32; color: white; border: none; padding: 10px 25px; border-radius: 8px; cursor: pointer; margin-top: 20px; }
        .btn-simpan:hover { background: #1b5e20; }
        .btn-rekap { background: #1b5e20; color: #fff; border: none; padding: 8px 20px; border-radius: 8px; cursor: pointer; float: right; text-decoration: none; }
        .btn-rekap:hover { background: #145a1a; }
        .alert { background: #c8e6c9; color: #1b5e20; padding: 10px; border-radius: 6px; margin-bottom: 15px; text-align: center; }
        .filter { margin-bottom: 15px; text-align: center; }
        .filter select { padding: 8px; border-radius: 8px; border: 1px solid #ccc; }
        textarea { width: 95%; border-radius: 6px; border: 1px solid #ccc; padding: 8px; font-family: 'Poppins', sans-serif; resize: none; }
        textarea:focus, select:focus, input:focus { outline: 2px solid #2e7d32; }
        .time-inputs { display: flex; gap: 20px; justify-content: center; margin-top: 15px; }
        .time-inputs label { font-weight: 500; }
        .mapel-input { text-align: center; margin-top: 15px; }
        .mapel-input input { width: 50%; padding: 8px; border-radius: 6px; border: 1px solid #ccc; }
        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
        .btn-kembali {display: inline-flex;align-items: center;gap: 12px;padding: 6px 20px 6px 6px;background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%);color: white;text-decoration: none;border-radius: 50px;font-weight: 600;transition: all 0.3s ease;box-shadow: 0 4px 15px rgba(46, 125, 50, 0.3);font-size: 0.9em;}
        .btn-kembali .icon-circle { width: 35px; height: 35px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.1em; transition: all 0.3s ease; }
        .btn-kembali:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(46, 125, 50, 0.5);}
        .btn-kembali:hover .icon-circle {background: rgba(255, 255, 255, 0.3);transform: rotate(-360deg);}
    </style>
</head>
<body>
    <div class="container">
        <div class="top-bar">
            <div class="left-buttons">
                <a href="{{ url()->previous() }}" class="btn-kembali">
                    <span class="icon-circle">⬅</span>
                    <span>Kembali</span>
                </a>
            </div>
            <h1>📋 Absensi Kelas</h1>
            <a href="{{ route('guru.absensi.rekap') }}" class="btn-rekap">📊 Lihat Rekap</a>
        </div>

        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <!-- 🔽 Filter Kelas -->
        <form method="GET" action="{{ route('guru.absensi.index') }}" class="filter">
            <label for="kelas">Filter Kelas:</label>
            <select name="kelas" id="kelas" onchange="this.form.submit()">
                <option value="">Semua Kelas</option>
                @foreach ($kelasList as $kelas)
                    <option value="{{ $kelas }}" {{ request('kelas') == $kelas ? 'selected' : '' }}>
                        {{ $kelas }}
                    </option>
                @endforeach
            </select>
        </form>

        <!-- 🧾 Form Absensi -->
        <form action="{{ route('guru.absensi.store') }}" method="POST">
            @csrf

            <!-- Input Mata Pelajaran -->
            <div class="mapel-input">
                <label for="mapel">Mata Pelajaran:</label><br>
                <input type="text" name="mapel" id="mapel" placeholder="Contoh: Matematika" required>
            </div>

            <!-- Input Jam -->
            <div class="time-inputs">
                <div>
                    <label for="jam_mulai">Jam Mulai:</label><br>
                    <input type="time" name="jam_mulai" id="jam_mulai" required>
                </div>
                <div>
                    <label for="jam_selesai">Jam Selesai:</label><br>
                    <input type="time" name="jam_selesai" id="jam_selesai" required>
                </div>
            </div>

            <!-- Tabel Absensi -->
            <table>
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Kehadiran</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswas as $siswa)
                        <tr>
                            <td>{{ $siswa->nama }}</td>
                            <td>{{ $siswa->kelas ?? '-' }}</td>
                            <td>
                                <select name="absensi[{{ $siswa->id }}][status]" required>
                                    <option value="Hadir">Hadir</option>
                                    <option value="Izin">Izin</option>
                                    <option value="Sakit">Sakit</option>
                                    <option value="Alpha">Alpha</option>
                                </select>
                            </td>
                            <td>
                                <textarea name="absensi[{{ $siswa->id }}][keterangan]" rows="2" placeholder="Tulis keterangan jika perlu..."></textarea>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Tidak ada siswa ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div style="text-align:center;">
                <button type="submit" class="btn-simpan">💾 Simpan Absensi</button>
            </div>
        </form>
    </div>
</body>
</html>
