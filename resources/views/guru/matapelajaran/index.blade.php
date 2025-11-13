<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Mata Pelajaran yang Anda Ajar
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                {{-- Header dan Tombol Tambah --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-700 mb-0">Daftar Mata Pelajaran</h3>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahMapelModal">
                        Tambah Mata Pelajaran
                    </button>
                </div>

                {{-- Notifikasi Sukses --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Jika Belum Ada Data --}}
                @if ($courses->isEmpty())
                    <p class="text-gray-500">Belum ada mata pelajaran yang Anda ajar.</p>
                @else
                    {{-- Grid Card --}}
                    <div class="row g-4">
                        @foreach ($courses as $course)
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border-0 shadow-sm">

                                    {{-- Gambar --}}
                                    @if ($course->gambar)
                                        <img src="{{ asset('storage/' . $course->gambar) }}"
                                             alt="Gambar Mata Pelajaran"
                                             class="card-img-top rounded-top"
                                             style="height: 180px; object-fit: cover;">
                                    @else
                                        <div class="bg-light d-flex justify-content-center align-items-center rounded-top"
                                             style="height: 180px;">
                                            <span class="text-muted">Tidak ada gambar</span>
                                        </div>
                                    @endif

                                    <div class="card-body d-flex flex-column">
                                        <h5 class="fw-bold text-primary">{{ $course->nama }}</h5>
                                        <p class="text-muted small mb-2">{{ $course->deskripsi }}</p>
                                        <p class="text-sm text-secondary mb-3">Kelas: {{ $course->kelas->nama_kelas ?? '-' }}</p>

                                        <div class="mt-auto d-flex justify-content-between">
                                            <a href="{{ route('guru.mata-pelajaran.isi', $course->id) }}"
                                               class="btn btn-outline-primary btn-sm">
                                                Lihat / Isi Materi
                                            </a>
                                            <button class="btn btn-outline-warning btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editMapelModal{{ $course->id }}">
                                                Edit
                                            </button>
                                            <form action="{{ route('guru.mata-pelajaran.destroy', $course->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus mata pelajaran ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger btn-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal Edit Mata Pelajaran --}}
                            <div class="modal fade" id="editMapelModal{{ $course->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('guru.mata-pelajaran.update', $course->id) }}"
                                          method="POST"
                                          enctype="multipart/form-data"
                                          class="modal-content">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Mata Pelajaran</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($course->gambar)
                                                <div class="mb-3">
                                                    <label class="form-label">Gambar Saat Ini</label>
                                                    <img src="{{ asset('storage/' . $course->gambar) }}"
                                                         class="w-100 rounded mb-2"
                                                         style="height: 150px; object-fit: cover;">
                                                </div>
                                            @endif

                                            <div class="mb-3">
                                                <label class="form-label">Ganti Gambar (opsional)</label>
                                                <input type="file" name="gambar" class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Modal Tambah Mata Pelajaran --}}
    <div class="modal fade" id="tambahMapelModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('guru.mata-pelajaran.store') }}" method="POST" enctype="multipart/form-data"
                  class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Mata Pelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Mata Pelajaran</label>
                        <select name="mata_pelajaran_id" class="form-select" required>
                            <option value="">Pilih Mata Pelajaran</option>
                            @foreach (\App\Models\MataPelajaran::all() as $mp)
                                <option value="{{ $mp->id }}">{{ $mp->nama_mapel }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kelas</label>
                        <select name="kelas_id" class="form-select" required>
                            <option value="">Pilih Kelas</option>
                            @foreach (\App\Models\Kelas::all() as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar (opsional)</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>

@if ($errors->any())
<script>
    const tambahMapelModal = new bootstrap.Modal(document.getElementById('tambahMapelModal'));
    tambahMapelModal.show();
</script>
@endif
