<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola: {{ $course->nama ?? $course->judul }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <p class="mb-4">{{ $course->deskripsi }}</p>

                <hr>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <h4 class="text-lg font-semibold">📘 Daftar Materi</h4>
                    {{-- Tombol ini mengarah ke file create.blade.php --}}
                    <a href="{{ route('guru.materi.create', $course->id) }}" class="btn btn-success btn-sm">
                        + Tambah Materi
                    </a>
                </div>

                @if ($materis->count() > 0)
                    <ul class="list-group list-group-flush mt-3">
                        @foreach ($materis as $materi)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $materi->judul }}</strong>
                                    <p class="mb-0 text-muted">{{ $materi->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                                </div>
                                <div>
                                    {{--
                                        PERBAIKAN BUG:
                                        Link "Tambah Soal" dipindahkan ke sini, di dalam loop.
                                        Mengarah ke route 'guru.soal.create' (SoalController@create).
                                        Ini akan membuka file create.blade (1).php.
                                    --}}
                                    <a href="{{ route('guru.soal.create', ['materi_id' => $materi->id]) }}"
                                       class="btn btn-primary btn-sm">
                                        + Tambah Soal
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="mt-3 text-muted">Belum ada materi untuk course ini.</p>
                @endif

                <hr class="my-4">

                <h4 class="text-lg font-semibold mt-4">🧩 Daftar Soal / Kuis (Semua Materi)</h4>
                @if ($soals->count() > 0)
                    <ul class="list-group list-group-flush mt-3">
                        @foreach ($soals as $soal)
                            <li class="list-group-item">
                                {{ $soal->pertanyaan }}
                                <span class="badge bg-secondary">{{ $soal->materi->judul ?? 'Materi ?' }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="mt-3 text-muted">Belum ada soal untuk course ini.</p>
                @endif

                {{-- Hapus link "Tambah Soal" yang rusak dari sini --}}

            </div>
        </div>
    </div>
</x-app-layout>
