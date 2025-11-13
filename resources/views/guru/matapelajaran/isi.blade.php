<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->nama }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="p-4 bg-light">
<div class="container">
    <h1 class="mb-3">{{ $course->nama }}</h1>
    <p>{{ $course->deskripsi }}</p>

    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h2>Daftar Materi</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahMateriModal">
            + Tambah Materi
        </button>
    </div>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    @foreach($materi->sortBy('id') as $m)
        <div class="card mb-3 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <button class="btn btn-link text-decoration-none text-start w-100" data-bs-toggle="collapse" data-bs-target="#materi-{{ $m->id }}">
                    <strong>{{ $m->judul }}</strong>
                </button>

                <div class="dropdown">
                    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editMateriModal{{ $m->id }}">
                                ✏️ Edit Materi
                            </button>
                        </li>
                        <li>
                            <button class="dropdown-item text-danger" onclick="hapusMateri('{{ route('materi.hapus', $m->id) }}')">
                                🗑️ Hapus Materi
                            </button>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#tambahSubMateriModal{{ $m->id }}">
                                ➕ Tambah Submateri
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Modal Edit Materi --}}
            <div class="modal fade" id="editMateriModal{{ $m->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('materi.update', $m->id) }}" method="POST" class="modal-content" onsubmit="return showLoading(event)">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Materi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Judul Materi</label>
                                <input type="text" name="judul" class="form-control" value="{{ $m->judul }}" required>
                            </div>
                            <div class="mb-3">
                                <label>Konten</label>
                                <textarea name="konten" class="form-control" rows="3" required>{{ $m->konten }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-success">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="materi-{{ $m->id }}" class="collapse">
                <div class="card-body">
                    @if(!empty($m->konten))
                        <p class="text-secondary mb-3">{{ $m->konten }}</p>
                        <hr>
                    @endif

                    {{-- Daftar Submateri --}}
                    @forelse($m->submateris as $sub)
                        <div class="border rounded p-3 mb-3 bg-white">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5>{{ $sub->judul }}</h5>
                                    <p>{{ $sub->konten }}</p>

                                    {{-- File Preview --}}
                                    @if($sub->file)
                                        @php
                                            $ext = pathinfo($sub->file, PATHINFO_EXTENSION);
                                        @endphp
                                        <div class="mt-2">
                                            @if(in_array($ext, ['jpg', 'jpeg', 'png', 'gif']))
                                                <img src="{{ asset('storage/' . $sub->file) }}" class="img-fluid rounded" style="max-height:200px;">
                                            @elseif($ext === 'pdf')
                                                <iframe src="{{ asset('storage/' . $sub->file) }}" class="w-100 rounded" style="height:300px;"></iframe>
                                            @elseif(in_array($ext, ['mp4', 'webm']))
                                                <video controls class="w-100 rounded">
                                                    <source src="{{ asset('storage/' . $sub->file) }}" type="video/{{ $ext }}">
                                                </video>
                                            @else
                                                <a href="{{ asset('storage/' . $sub->file) }}" target="_blank">📎 Lihat File</a>
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editSubMateriModal{{ $sub->id }}">
                                                ✏️ Edit Submateri
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item text-danger" onclick="hapusSubMateri('{{ route('submateri.destroy', $sub->id) }}')">
                                                🗑️ Hapus Submateri
                                            </button>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#tambahTugasModal{{ $sub->id }}">
                                                📝 Tambah Tugas
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            {{-- Modal Edit Submateri --}}
                            <div class="modal fade" id="editSubMateriModal{{ $sub->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form action="{{ route('submateri.update', $sub->id) }}" method="POST" enctype="multipart/form-data" class="modal-content" onsubmit="return showLoading(event)">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Submateri</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label>Judul Submateri</label>
                                                <input type="text" name="judul" value="{{ $sub->judul }}" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Konten</label>
                                                <textarea name="konten" class="form-control" rows="3" required>{{ $sub->konten }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label>File (opsional)</label>
                                                <input type="file" name="file" class="form-control">
                                                @if($sub->file)
                                                    <small class="text-muted">File saat ini: {{ basename($sub->file) }}</small>
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

                            {{-- Modal Tambah Tugas --}}
                            <div class="modal fade" id="tambahTugasModal{{ $sub->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form action="{{ route('tugas.store', $sub->id) }}" method="POST" enctype="multipart/form-data" class="modal-content" onsubmit="return showLoading(event)">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Tugas</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label>Judul Tugas</label>
                                                <input type="text" name="judul" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label>Deadline</label>
                                                <input type="date" name="deadline" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label>File (opsional)</label>
                                                <input type="file" name="file" class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            {{-- Daftar Tugas --}}
                            <div class="mt-3">
                                <h6>Daftar Tugas</h6>
                                @forelse($sub->tugas as $t)
                                    @php
                                        $deadline = \Carbon\Carbon::parse($t->deadline);
                                        $isOverdue = now()->gt($deadline);
                                    @endphp
                                    <div class="border p-3 mb-3 rounded bg-light">
                                        <div class="d-flex justify-content-between">
                                            <div class="w-100 me-3">
                                                <strong>{{ $t->judul }}</strong>
                                                <p class="mb-1">{{ $t->deskripsi }}</p>

                                                {{-- 🔹 Preview File jika ada --}}
                                                @if($t->file)
                                                    @php
                                                        $ext = pathinfo($t->file, PATHINFO_EXTENSION);
                                                    @endphp
                                                    <div class="mt-2">
                                                        @if(in_array($ext, ['jpg', 'jpeg', 'png', 'gif']))
                                                            <img src="{{ asset('storage/' . $t->file) }}" class="img-fluid rounded" style="max-height:200px;">
                                                        @elseif($ext === 'pdf')
                                                            <iframe src="{{ asset('storage/' . $t->file) }}" class="w-100 rounded" style="height:300px;"></iframe>
                                                        @elseif(in_array($ext, ['mp4', 'webm']))
                                                            <video controls class="w-100 rounded">
                                                                <source src="{{ asset('storage/' . $t->file) }}" type="video/{{ $ext }}">
                                                            </video>
                                                        @else
                                                            <a href="{{ asset('storage/' . $t->file) }}" target="_blank">📎 Lihat File</a>
                                                        @endif
                                                    </div>
                                                @endif

                                                {{-- 🔹 Deadline --}}
                                                @if($t->deadline)
                                                    @php
                                                        $deadline = \Carbon\Carbon::parse($t->deadline);
                                                        $isOverdue = now()->gt($deadline);
                                                    @endphp
                                                    <p class="small mt-2 {{ $isOverdue ? 'text-danger' : 'text-success' }}">
                                                        <i class="bi {{ $isOverdue ? 'bi-exclamation-circle' : 'bi-clock' }}"></i>
                                                        Deadline: {{ $deadline->format('d M Y') }}
                                                        @if($isOverdue)
                                                            (Sudah Lewat)
                                                        @endif
                                                    </p>
                                                @endif
                                            </div>

                                            <div class="d-flex flex-column align-items-end">
                                                <button class="btn btn-sm btn-warning mb-1" data-bs-toggle="modal" data-bs-target="#editTugasModal{{ $t->id }}">Edit</button>
                                                <button class="btn btn-sm btn-danger" onclick="hapusTugas('{{ route('tugas.destroy', $t->id) }}')">Hapus</button>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- Modal Edit Tugas --}}
                                    <div class="modal fade" id="editTugasModal{{ $t->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <form action="{{ route('tugas.update', $t->id) }}" method="POST" enctype="multipart/form-data" class="modal-content" onsubmit="return showLoading(event)">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Tugas</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label>Judul</label>
                                                        <input type="text" name="judul" value="{{ $t->judul }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Deskripsi</label>
                                                        <textarea name="deskripsi" class="form-control" rows="3">{{ $t->deskripsi }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Deadline</label>
                                                        <input type="date" name="deadline" value="{{ $t->deadline }}" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>File (opsional)</label>
                                                        <input type="file" name="file" class="form-control">
                                                        @if($t->file)
                                                            <small class="text-muted">File saat ini: {{ basename($t->file) }}</small>
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
                                @empty
                                    <p class="text-muted">Belum ada tugas.</p>
                                @endforelse
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Belum ada submateri.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Modal Tambah Submateri --}}
        <div class="modal fade" id="tambahSubMateriModal{{ $m->id }}" tabindex="-1">
            <div class="modal-dialog">
                <form action="{{ route('submateri.store', $m->id) }}" method="POST" enctype="multipart/form-data" class="modal-content" onsubmit="return showLoading(event)">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Submateri</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Judul Submateri</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Konten</label>
                            <textarea name="konten" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>File (opsional)</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
</div>

{{-- Modal Tambah Materi --}}
<div class="modal fade" id="tambahMateriModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('materi.tambah', $course->id) }}" method="POST" class="modal-content" onsubmit="return showLoading(event)">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Judul Materi</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Konten Materi</label>
                    <textarea name="konten" class="form-control" rows="3" placeholder="Tuliskan isi materi..." required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showLoading(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Memproses...',
            text: 'Tunggu sebentar ya...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
        e.target.submit();
    }

    function hapusMateri(url) {
        Swal.fire({
            title: 'Hapus Materi?',
            text: "Data materi dan submateri akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then(result => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.action = url;
                form.method = 'POST';
                form.innerHTML = '@csrf @method("DELETE")';
                document.body.append(form);
                form.submit();
            }
        });
    }

    function hapusSubMateri(url) {
        Swal.fire({
            title: 'Hapus Submateri?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then(r => {
            if (r.isConfirmed) {
                const f = document.createElement('form');
                f.action = url;
                f.method = 'POST';
                f.innerHTML = '@csrf @method("DELETE")';
                document.body.append(f);
                f.submit();
            }
        });
    }

    function hapusTugas(url) {
        Swal.fire({
            title: 'Hapus Tugas?',
            text: 'Tugas ini akan dihapus permanen.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then(res => {
            if (res.isConfirmed) {
                const form = document.createElement('form');
                form.action = url;
                form.method = 'POST';
                form.innerHTML = '@csrf @method("DELETE")';
                document.body.append(form);
                form.submit();
            }
        });
    }
</script>

</body>
</html>
