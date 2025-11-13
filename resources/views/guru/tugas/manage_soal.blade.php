<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Soal Posttest: {{ $tugas->judul }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row g-4">
                {{-- KOLOM KIRI: FORM TAMBAH SOAL (BISA PILGAN/ESAI) --}}
                <div class="col-lg-5">

                    {{-- Form Pilihan Ganda --}}
                    <div class="bg-white shadow-sm rounded-lg p-6 mb-4">
                        <h3 class="text-lg font-semibold mb-3">Tambah Soal Pilihan Ganda</h3>

                        <form method="POST" action="{{ route('guru.soal.storeForTugas', $tugas->id) }}">
                            @csrf
                            <input type="hidden" name="tipe_soal" value="pilgan">

                            <div class="mb-3">
                                <label class="form-label" for="pertanyaan_pilgan">Pertanyaan</label>
                                <textarea name="pertanyaan" id="pertanyaan_pilgan" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-2"><input type="text" name="opsi_a" class="form-control" placeholder="Opsi A" required></div>
                                <div class="col-md-6 mb-2"><input type="text" name="opsi_b" class="form-control" placeholder="Opsi B" required></div>
                                <div class="col-md-6 mb-2"><input type="text" name="opsi_c" class="form-control" placeholder="Opsi C" required></div>
                                <div class="col-md-6 mb-2"><input type="text" name="opsi_d" class="form-control" placeholder="Opsi D" required></div>
                            </div>
                            <div class="mt-2 mb-3">
                                <label class="form-label" for="jawaban_benar">Kunci Jawaban</label>
                                <select name="jawaban_benar" id="jawaban_benar" class="form-select" required>
                                    <option value="">Pilih</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Simpan Soal Pilgan</button>
                        </form>
                    </div>

                    {{-- Form Esai --}}
                    <div class="bg-white shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-3">Tambah Soal Esai</h3>

                        <form method="POST" action="{{ route('guru.soal.storeForTugas', $tugas->id) }}">
                            @csrf
                            <input type="hidden" name="tipe_soal" value="esai">

                            <div class="mb-3">
                                <label class="form-label" for="pertanyaan_esai">Pertanyaan Esai</label>
                                <textarea name="pertanyaan" id="pertanyaan_esai" class="form-control" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-info w-100">Simpan Soal Esai</button>
                        </form>
                    </div>
                </div>

                {{-- KOLOM KANAN: DAFTAR SOAL YANG SUDAH ADA --}}
                <div class="col-lg-7">
                    <div class="bg-white shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-3">Daftar Soal (Total: {{ $soals->count() }})</h3>

                        <ul class="list-group list-group-flush">
                            @forelse ($soals as $index => $soal)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">
                                            {{ $index + 1 }}.
                                            @if($soal->tipe_soal == 'pilgan')
                                                <span class="badge bg-primary">Pilgan</span>
                                            @else
                                                <span class="badge bg-info">Esai</span>
                                            @endif
                                        </div>
                                        {{ $soal->pertanyaan }}
                                        {{-- Tampilkan detail jawaban pilgan --}}
                                        @if($soal->tipe_soal == 'pilgan')
                                            <ul class="text-muted small mt-2" style="list-style-type: lower-alpha;">
                                                <li class="{{ $soal->jawaban_benar == 'A' ? 'fw-bold text-success' : '' }}">A. {{ $soal->pilihan_a }}</li>
                                                <li class="{{ $soal->jawaban_benar == 'B' ? 'fw-bold text-success' : '' }}">B. {{ $soal->pilihan_b }}</li>
                                                <li class="{{ $soal->jawaban_benar == 'C' ? 'fw-bold text-success' : '' }}">C. {{ $soal->pilihan_c }}</li>
                                                <li class="{{ $soal->jawaban_benar == 'D' ? 'fw-bold text-success' : '' }}">D. {{ $soal->pilihan_d }}</li>
                                            </ul>
                                        @endif
                                    </div>
                                    <form action="{{ route('guru.soal.destroy', $soal->id) }}" method="POST" onsubmit="return confirm('Hapus soal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </li>
                            @empty
                                <li class="list-group-item text-muted">Belum ada soal yang ditambahkan.</li>
                            @endforelse
                        </ul>

                        <a href="{{ route('guru.mata-pelajaran.isi', $tugas->subMateri->materi->course_id) }}" class="btn btn-secondary mt-4">
                            Selesai & Kembali ke Materi
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
