<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Soal untuk Materi: {{ $materi->judul }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                {{-- Menampilkan Error Validasi (Penting) --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <p class="fw-bold">Gagal menyimpan, periksa error berikut:</p>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{--
                  Form ini mengarah ke route('guru.soal.store', $materi->id)
                  dan akan ditangani oleh SoalController@store
                --}}
                <form method="POST" action="{{ route('guru.soal.store', $materi->id) }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="pertanyaan">Pertanyaan</label>
                        <textarea name="pertanyaan" id="pertanyaan" class="form-control" rows="4" required>{{ old('pertanyaan') }}</textarea>
                    </div>

                    <hr class="my-4">
                    <p class="fw-bold">Pilihan Jawaban:</p>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="opsi_a">Opsi A</label>
                            <input type="text" name="opsi_a" id="opsi_a" class="form-control" value="{{ old('opsi_a') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="opsi_b">Opsi B</label>
                            <input type="text" name="opsi_b" id="opsi_b" class="form-control" value="{{ old('opsi_b') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="opsi_c">Opsi C</label>
                            <input type="text" name="opsi_c" id="opsi_c" class="form-control" value="{{ old('opsi_c') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="opsi_d">Opsi D</label>
                            <input type="text" name="opsi_d" id="opsi_d" class="form-control" value="{{ old('opsi_d') }}" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="jawaban_benar">Kunci Jawaban</label>
                        <select name="jawaban_benar" id="jawaban_benar" class="form-select" required>
                            <option value="">Pilih jawaban yang benar</option>
                            <option value="A" {{ old('jawaban_benar') == 'A' ? 'selected' : '' }}>Opsi A</option>
                            <option value="B" {{ old('jawaban_benar') == 'B' ? 'selected' : '' }}>Opsi B</option>
                            <option value="C" {{ old('jawaban_benar') == 'C' ? 'selected' : '' }}>Opsi C</option>
                            <option value="D" {{ old('jawaban_benar') == 'D' ? 'selected' : '' }}>Opsi D</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan Soal</button>
                    {{-- Tombol kembali ke halaman 'isi' --}}
                    <a href="{{ route('guru.mata-pelajaran.isi', $materi->course_id) }}" class="btn btn-secondary">
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
