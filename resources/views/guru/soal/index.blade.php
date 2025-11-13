<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Soal - {{ $materi->judul }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                {{-- Pesan sukses --}}
                @if(session('success'))
                    <div class="alert alert-success mb-3">{{ session('success') }}</div>
                @endif

                <h3 class="text-lg font-semibold mb-4">Tambah Soal Baru</h3>
                <form action="{{ route('guru.soal.store', $materi->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Pertanyaan</label>
                        <textarea name="pertanyaan" class="form-control" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><input type="text" name="opsi_a" class="form-control mb-2" placeholder="Opsi A" required></div>
                        <div class="col-md-6"><input type="text" name="opsi_b" class="form-control mb-2" placeholder="Opsi B" required></div>
                        <div class="col-md-6"><input type="text" name="opsi_c" class="form-control mb-2" placeholder="Opsi C" required></div>
                        <div class="col-md-6"><input type="text" name="opsi_d" class="form-control mb-2" placeholder="Opsi D" required></div>
                    </div>
                    <div class="mb-3">
                        <label>Jawaban Benar</label>
                        <select name="jawaban_benar" class="form-select">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                    <button class="btn btn-success">+ Tambah Soal</button>
                </form>

                <hr class="my-4">

                <h3 class="text-lg font-semibold mb-3">Daftar Soal</h3>
                @if($soals->isEmpty())
                    <p class="text-muted">Belum ada soal.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pertanyaan</th>
                                <th>Jawaban Benar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($soals as $index => $soal)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $soal->pertanyaan }}</td>
                                    <td><strong>{{ $soal->jawaban_benar }}</strong></td>
                                    <td>
                                        <form action="{{ route('guru.soal.destroy', $soal->id) }}" method="POST" onsubmit="return confirm('Hapus soal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
