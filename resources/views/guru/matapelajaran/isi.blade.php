<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->nama }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="p-4 bg-light">

    {{-- Script untuk notifikasi --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    <div class="container">
        <h1 class="mb-3">{{ $course->nama }}</h1>
        <p>{{ $course->deskripsi }}</p>

        <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
            <h2>Daftar Materi</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahMateriModal">
                + Tambah Materi
            </button>
        </div>

        <div class="accordion" id="materiAccordion">
            @forelse ($materi as $item)
                <div class="accordion-item mb-2 shadow-sm">
                    <h2 class="accordion-header" id="heading{{ $item->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $item->id }}" aria-expanded="false"
                            aria-controls="collapse{{ $item->id }}">
                            <strong>{{ $item->judul }}</strong>
                        </button>
                    </h2>
                    <div id="collapse{{ $item->id }}" class="accordion-collapse collapse"
                        aria-labelledby="heading{{ $item->id }}" data-bs-parent="#materiAccordion">
                        <div class="accordion-body">

                            {{-- =================================== --}}
                            {{-- KODE PREVIEW FILE (DENGAN PDF EMBED) --}}
                            {{-- =================================== --}}
                            @if ($item->file)
                                @php
                                    $path = asset('storage/' . $item->file);
                                    $extension = strtolower(pathinfo($item->file, PATHINFO_EXTENSION));
                                @endphp

                                <div class="mb-3 p-3 border rounded bg-light">
                                    <p class="fw-bold">Lampiran File:</p>

                                    @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                        {{-- Jika GAMBAR --}}
                                        <img src="{{ $path }}" class="img-fluid rounded"
                                            style="max-height: 400px; object-fit: contain;" alt="Preview Gambar">

                                    @elseif (in_array($extension, ['mp4', 'webm', 'ogg']))
                                        {{-- Jika VIDEO --}}
                                        <video controls class="img-fluid rounded" style="max-width: 100%;">
                                            <source src="{{ $path }}" type="video/{{ $extension }}">
                                            Browser Anda tidak mendukung tag video.
                                        </video>

                                    @elseif ($extension == 'pdf')
                                        {{--
                                          PERUBAHAN DI SINI:
                                          Menggunakan <iframe> untuk embed PDF
                                        --}}
                                        <iframe src="{{ $path }}"
                                                width="100%"
                                                height="600px"
                                                class="rounded border"
                                                style="background: #eee;">
                                            Browser Anda tidak mendukung iframe,
                                            <a href="{{ $path }}" target="_blank">klik di sini untuk melihat PDF</a>.
                                        </iframe>

                                    @else
                                        {{-- File Tipe Lain (docx, zip, dll) --}}
                                        <a href="{{ $path }}" target="_blank" class="btn btn-secondary">
                                            <i class="bi bi-download"></i> Download File ({{ $extension }})
                                        </a>
                                    @endif
                                </div>
                                <hr>
                            @endif
                            {{-- AKHIR KODE PREVIEW --}}


                            <p><strong>Deskripsi/Konten:</strong></p>
                            <div>{!! $item->konten !!}</div>

                            <hr class="my-3">

                            {{-- Tombol Aksi --}}
                            <div class="d-flex flex-wrap gap-2 mt-3">
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editMateriModal{{ $item->id }}">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>

                                <button class="btn btn-danger btn-sm"
                                    onclick="hapusMateri('{{ route('materi.hapus', $item->id) }}')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>

                                <a href="{{ route('guru.soal.create', ['materi_id' => $item->id]) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-circle"></i> Tambah Soal
                                </a>

                                <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#tambahSubmateriModal{{ $item->id }}">
                                    <i class="bi bi-journal-plus"></i> Tambah Sub Materi
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-secondary">
                    Belum ada materi yang ditambahkan. Silakan klik tombol "+ Tambah Materi".
                </div>
            @endforelse
        </div>
    </div>


    {{--
      ================================================
      MODAL-MODAL (Sama seperti sebelumnya)
      ================================================
    --}}

    <div class="modal fade" id="tambahMateriModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('materi.tambah', $course->id) }}" method="POST" class="modal-content"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Materi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Konten Materi</label>
                        <textarea name="konten" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>File (Gambar, Video, PDF) - Maks 10MB</label>
                        <input type="file" name="file" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>


    {{-- Modal Edit Materi & Tambah Submateri (Loop) --}}
    @foreach ($materi as $item)
        <div class="modal fade" id="editMateriModal{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog">
                <form action="{{ route('materi.update', $item->id) }}" method="POST" class="modal-content"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Materi: {{ $item->judul }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" value="{{ $item->judul }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Konten Materi</label>
                            <textarea name="konten" class="form-control" rows="5" required>{{ $item->konten }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Ganti File (Opsional) - Maks 10MB</label>
                            @if ($item->file)
                                <p class="text-muted small">File saat ini: {{ $item->file }}</p>
                            @endif
                            <input type="file" name="file" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="tambahSubmateriModal{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog">
                <form action="{{ route('submateri.store', $item->id) }}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Sub Materi (di bawah {{ $item->judul }})</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Judul Sub Materi</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
    {{-- Akhir Loop Modal --}}


    {{-- SCRIPT HAPUS --}}
    <script>
        function hapusMateri(url) {
            Swal.fire({
                title: 'Hapus Materi?',
                text: 'Semua submateri dan tugas di dalamnya juga akan terhapus!',
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
                    form.innerHTML = '@csrf @method('DELETE')';
                    document.body.append(form);
                    form.submit();
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
                    form.innerHTML = '@csrf @method('DELETE')';
                    document.body.append(form);
                    form.submit();
                }
            });
        }
    </script>

</body>

</html>
