<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Soal untuk: {{ $materi->judul }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <form action="{{ route('guru.soal.store', $materi->id) }}" method="POST" class="mb-6">
                    @csrf
                    <div class="mb-3">
                        <label class="block text-sm font-medium">Pertanyaan</label>
                        <textarea name="pertanyaan" class="form-control w-full" rows="3" required></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label>Pilihan A</label>
                            <input type="text" name="pilihan_a" class="form-control w-full">
                        </div>
                        <div>
                            <label>Pilihan B</label>
                            <input type="text" name="pilihan_b" class="form-control w-full">
                        </div>
                        <div>
                            <label>Pilihan C</label>
                            <input type="text" name="pilihan_c" class="form-control w-full">
                        </div>
                        <div>
                            <label>Pilihan D</label>
                            <input type="text" name="pilihan_d" class="form-control w-full">
                        </div>
                    </div>

                    <div class="mt-3">
                        <label>Jawaban Benar</label>
                        <select name="jawaban_benar" class="form-select" required>
                            <option value="">-- Pilih Jawaban Benar --</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>

                    <button class="btn btn-primary mt-4" type="submit">Tambah Soal</button>
                </form>

                <hr class="my-4">

                <h3 class="text-lg font-semibold mb-2">Daftar Soal</h3>
                @forelse ($soals as $soal)
                    <div class="border p-3 mb-3 rounded">
                        <strong>{{ $soal->pertanyaan }}</strong>
                        <ul class="mt-2">
                            <li>A. {{ $soal->pilihan_a }}</li>
                            <li>B. {{ $soal->pilihan_b }}</li>
                            <li>C. {{ $soal->pilihan_c }}</li>
                            <li>D. {{ $soal->pilihan_d }}</li>
                        </ul>
                        <p class="mt-2 text-green-600">Jawaban benar: {{ $soal->jawaban_benar }}</p>

                        <form action="{{ route('guru.soal.destroy', $soal->id) }}" method="POST" onsubmit="return confirm('Hapus soal ini?')" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                @empty
                    <p>Tidak ada soal untuk materi ini.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
