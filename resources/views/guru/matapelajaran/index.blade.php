<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Mata Pelajaran yang Anda Ajar
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">Daftar Mata Pelajaran</h3>
                    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" data-bs-toggle="modal"
                        data-bs-target="#tambahMapelModal">
                        + Tambah Mata Pelajaran
                    </button>
                </div>

                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($courses->isEmpty())
                    <p class="text-gray-500">Belum ada mata pelajaran yang Anda ajar.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($courses as $course)
                            <div class="border rounded-lg shadow-sm bg-white p-4">

                                {{-- 🔹 Tampilkan Gambar --}}
                                @if ($course->gambar)
                                    <img src="{{ asset('storage/' . $course->gambar) }}" alt="Gambar Mata Pelajaran"
                                        class="w-full h-40 object-cover rounded mb-3">
                                @else
                                    <div
                                        class="w-full h-40 bg-gray-200 flex items-center justify-center text-gray-500 rounded mb-3">
                                        Tidak ada gambar
                                    </div>
                                @endif

                                <h4 class="text-lg font-bold text-green-700">{{ $course->nama }}</h4>
                                <p class="text-gray-600 mb-2">{{ $course->deskripsi }}</p>
                                <p class="text-sm text-gray-500">Kelas: {{ $course->kelas->nama_kelas ?? 'N/A' }}</p>

                                <div class="mt-3 flex justify-between">
                                    <a href="{{ route('guru.mata-pelajaran.isi', $course->id) }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                        📚 Lihat / Isi Materi
                                    </a>

                                    <button
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm"
                                        data-bs-toggle="modal" data-bs-target="#editMapelModal{{ $course->id }}">
                                        ✏️ Edit
                                    </button>

                                    <form action="{{ route('guru.mata-pelajaran.destroy', $course->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus mata pelajaran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                            {{-- Modal Edit Mata Pelajaran --}}
                            <div class="modal fade" id="editMapelModal{{ $course->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form action="{{ route('guru.mata-pelajaran.update', $course->id) }}" method="POST"
                                        enctype="multipart/form-data" class="modal-content">
                                        @csrf
                                        @method('PUT') {{-- Gunakan method PUT untuk update --}}
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Mata Pelajaran: {{ $course->nama }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="mb-3">Anda hanya dapat mengubah gambar sampul mata pelajaran.
                                            </p>

                                            {{-- Tampilkan gambar saat ini --}}
                                            @if ($course->gambar)
                                                <div class="mb-3">
                                                    <label>Gambar Saat Ini</label>
                                                    <img src="{{ asset('storage/' . $course->gambar) }}"
                                                        alt="Gambar Mata Pelajaran Saat Ini"
                                                        class="w-full h-32 object-cover rounded">
                                                </div>
                                            @endif

                                            <div class="mb-3">
                                                <label>Ganti Gambar (opsional)</label>
                                                <input type="file" name="gambar" class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- Akhir Modal Edit --}}
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Tambah Mata Pelajaran -->
    <div class="modal fade" id="tambahMapelModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('guru.mata-pelajaran.store') }}" method="POST" enctype="multipart/form-data"
                class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Mata Pelajaran yang Anda Ajar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Mata Pelajaran</label>
                        <select name="mata_pelajaran_id" class="form-select" required>
                            <option value="">-- Pilih Mata Pelajaran --</option>
                            @foreach (\App\Models\MataPelajaran::all() as $mp)
                                <option value="{{ $mp->id }}">{{ $mp->nama_mapel }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('mata_pelajaran_id')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label>Kelas</label>
                        <select name="kelas_id" class="form-select" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach (\App\Models\Kelas::all() as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('kelas_id')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label>Gambar (opsional)</label>
                        <input type="file" name="gambar" class="form-control">
                        <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap Modal JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>

@if ($errors->any())
<script>
    // Membuka modal 'Tambah Mata Pelajaran' jika ada error validasi
    var tambahMapelModal = new bootstrap.Modal(document.getElementById('tambahMapelModal'));
    tambahMapelModal.show();
</script>
@endif
