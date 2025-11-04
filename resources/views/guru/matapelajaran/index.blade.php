<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Mata Pelajaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f4fff6;
            font-family: 'Poppins', sans-serif;
        }
        .course-card {
            position: relative;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .course-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 18px rgba(0,0,0,0.1);
        }
        .course-image {
            width: 100%;
            height: 130px;
            object-fit: cover;
            background: #e0f2f1;
        }
        .course-content {
            padding: 15px;
        }
        .course-title {
            color: #2e7d32;
            font-weight: 600;
            font-size: 1rem;
        }
        .course-desc {
            color: #555;
            font-size: 0.9rem;
            min-height: 50px;
        }
        .dropdown-toggle::after {
            display: none;
        }
        .badge-semester {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #1565c0;
            color: #fff;
            font-size: 0.8rem;
            border-radius: 5px;
            padding: 4px 8px;
        }
    </style>
</head>
<body class="py-5">

<div class="container">
    <h2 class="mb-4 text-success fw-bold text-center">📘 Kelola Mata Pelajaran</h2>

    <!-- Tombol Tambah -->
    <div class="text-center mb-4">
        <button class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahModal">
            + Tambah Mata Pelajaran
        </button>
    </div>

    <!-- Pesan Sukses -->
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <!-- Grid Course -->
    <div class="row g-4">
        @forelse($courses as $course)
            <div class="col-md-4 col-sm-6">
                <div class="course-card">
                    <!-- Dropdown (Pindah ke luar link) -->
                    <div class="dropdown position-absolute top-0 end-0 p-2">
                        <button class="btn btn-sm btn-light border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li>
                                <a class="dropdown-item text-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $course->id }}">✏️ Edit</a>
                            </li>
                            <li>
                                <form action="{{ route('guru.mata-pelajaran.destroy', $course->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="dropdown-item text-danger" onclick="return confirm('Yakin ingin menghapus mata pelajaran ini?')">🗑 Hapus</button>
                                </form>
                            </li>
                        </ul>
                    </div>

                    <!-- Link ke halaman isi -->
                    <a href="{{ route('guru.mata-pelajaran.isi', $course->id) }}" class="text-decoration-none text-dark d-block">
                        <!-- Gambar -->
                        @if($course->gambar)
                            <img src="{{ asset('storage/' . $course->gambar) }}" class="course-image" alt="{{ $course->nama }}">
                        @else
                            <img src="https://via.placeholder.com/400x150?text=Tidak+Ada+Gambar" class="course-image" alt="default">
                        @endif

                        <div class="course-content">
                            <h5 class="course-title">{{ $course->nama }}</h5>
                            <p class="course-desc">{{ $course->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                            <div class="progress mt-2" style="height: 6px;">
                                <div class="progress-bar bg-primary" style="width: 100%"></div>
                            </div>
                            <small class="text-muted">100% complete</small>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal{{ $course->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('guru.mata-pelajaran.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Mata Pelajaran</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Nama Mata Pelajaran</label>
                                    <input type="text" name="nama" class="form-control" value="{{ $course->nama }}" required>
                                </div>
                                <div class="mb-3">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control">{{ $course->deskripsi }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label>Gambar</label>
                                    <input type="file" name="gambar" class="form-control">
                                    @if($course->gambar)
                                        <small class="text-muted">Gambar saat ini: {{ basename($course->gambar) }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-muted mt-4">
                <p>Belum ada mata pelajaran yang ditambahkan.</p>
            </div>
        @endforelse
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('guru.mata-pelajaran.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Mata Pelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama Mata Pelajaran</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Gambar (Thumbnail)</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Cegah klik dropdown membuka link <a>
    document.querySelectorAll('.dropdown').forEach(dropdown => {
        dropdown.addEventListener('click', e => e.stopPropagation());
    });
</script>
</body>
</html>
