<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Mata Pelajaran yang Diajar') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-6">
                    Daftar Mata Pelajaran Anda
                </h3>

                {{-- Alert Sukses --}}
                @if (session('success'))
                    <div class="mb-4 p-4 rounded-md bg-green-100 border border-green-300 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Tombol Kembali --}}
                <a href="{{ route('guru.dashboard') }}"
                   class="inline-flex items-center px-4 py-2 mb-6 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">
                    ← Kembali ke Dashboard
                </a>

                {{-- Form Tambah Mata Pelajaran --}}
                <form action="{{ route('guru.mata-pelajaran.store') }}" method="POST" enctype="multipart/form-data"
                      class="space-y-5 mb-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="mata_pelajaran_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Pilih Mata Pelajaran
                            </label>
                            <select name="mata_pelajaran_id" id="mata_pelajaran_id"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">-- Pilih Mata Pelajaran --</option>
                                @foreach ($mataPelajaran as $mapel)
                                    <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="kelas_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Pilih Kelas
                            </label>
                            <select name="kelas_id" id="kelas_id"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">
                                Gambar (opsional)
                            </label>
                            <input type="file" name="gambar" id="gambar"
                                   class="w-full text-sm border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>

                    <button type="submit"
                            class="px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                        Tambah Mata Pelajaran
                    </button>
                </form>

                {{-- Daftar Mata Pelajaran --}}
                @if ($courses->isEmpty())
                    <p class="text-gray-600 text-center py-6 border-t">
                        Belum ada mata pelajaran yang Anda ajar.
                    </p>
                @else
                    <div class="overflow-x-auto border-t pt-4">
                        <table class="min-w-full border border-gray-200 divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50 text-gray-700 uppercase text-xs font-semibold">
                                <tr>
                                    <th class="px-6 py-3 text-left">No</th>
                                    <th class="px-6 py-3 text-left">Nama</th>
                                    <th class="px-6 py-3 text-left">Deskripsi</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach ($courses as $index => $course)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-3">{{ $index + 1 }}</td>
                                        <td class="px-6 py-3 font-medium text-gray-900">{{ $course->nama }}</td>
                                        <td class="px-6 py-3 text-gray-700">{{ $course->deskripsi }}</td>
                                        <td class="px-6 py-3 text-center">
                                            <form action="{{ route('guru.mata-pelajaran.destroy', $course->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus mata pelajaran ini?')"
                                                  class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 text-xs transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
