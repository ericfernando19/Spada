<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body { background-color: #f8f9fa; }
        .card { border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        table th { background-color: #0d6efd; color: white; }
        .badge-status { padding: 0.5em 0.75em; font-size: 0.9rem; }
    </style>
</head>
<body>
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📋 Rekap Absensi</h2>
        <a href="{{ route('guru.absensi.index') }}" class="btn btn-secondary">← Kembali ke Absensi</a>
    </div>

    <!-- Filter -->
    <form method="GET" class="row g-3 mb-3">
        <div class="col-md-5">
            <select name="kelas" class="form-select" onchange="this.form.submit()">
                <option value="">-- Pilih Kelas --</option>
                @foreach($kelasList ?? [] as $kelas)
                    <option value="{{ $kelas }}" {{ request('kelas') == $kelas ? 'selected' : '' }}>{{ $kelas }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-5">
            <input type="text" name="mapel" class="form-control" placeholder="Ketik Mata Pelajaran..." value="{{ request('mapel') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>


    <div class="card p-4">
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th>Status</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekap ?? [] as $index => $absen)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $absen->siswa->nama ?? '-' }}</td>
                            <td>{{ $absen->siswa->kelas ?? '-' }}</td>
                            <td>{{ $absen->mapel ?? '-' }}</td>
                            <td>
                                @php
                                    $status = $absen->status;
                                    $badge = match($status) {
                                        'Hadir' => 'bg-success',
                                        'Izin' => 'bg-warning text-dark',
                                        'Sakit' => 'bg-info text-dark',
                                        default => 'bg-danger'
                                    };
                                @endphp
                                <span class="badge badge-status {{ $badge }}">{{ $status }}</span>
                            </td>
                            <td>{{ $absen->jam_mulai ?? '-' }}</td>
                            <td>{{ $absen->jam_selesai ?? '-' }}</td>
                            <td>{{ $absen->keterangan ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($absen->tanggal)->format('d M Y') }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $absen->id }}">Edit</button>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $absen->id }}">Hapus</button>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $absen->id }}" tabindex="-1">
                          <div class="modal-dialog">
                            <form method="POST" action="{{ route('guru.absensi.update', $absen->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Edit Absensi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Status</label>
                                        <select name="status" class="form-select" required>
                                            <option value="Hadir" {{ $absen->status=='Hadir'?'selected':'' }}>Hadir</option>
                                            <option value="Izin" {{ $absen->status=='Izin'?'selected':'' }}>Izin</option>
                                            <option value="Sakit" {{ $absen->status=='Sakit'?'selected':'' }}>Sakit</option>
                                            <option value="Alpa" {{ $absen->status=='Alpa'?'selected':'' }}>Alpa</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Jam Mulai</label>
                                        <input type="time" name="jam_mulai" class="form-control" value="{{ $absen->jam_mulai }}">
                                    </div>
                                    <div class="mb-3">
                                        <label>Jam Selesai</label>
                                        <input type="time" name="jam_selesai" class="form-control" value="{{ $absen->jam_selesai }}">
                                    </div>
                                    <div class="mb-3">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan" class="form-control">{{ $absen->keterangan }}</textarea>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                  </div>
                                </div>
                            </form>
                          </div>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $absen->id }}" tabindex="-1">
                          <div class="modal-dialog">
                            <form method="POST" action="{{ route('guru.absensi.destroy', $absen->id) }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Hapus Absensi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                  </div>
                                  <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus absensi {{ $absen->siswa->nama ?? '-' }}?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                  </div>
                                </div>
                            </form>
                          </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="10" class="text-muted">Belum ada data absensi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
