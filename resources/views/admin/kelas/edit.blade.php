<x-app-layout>
    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Kelas</h2>

            {{-- Notifikasi error --}}
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 border border-red-300 text-red-700 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('kelas.update', $kelas->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                {{-- Nama Kelas --}}
                <div>
                    <label for="nama_kelas" class="block font-medium text-gray-700">Nama Kelas</label>
                    <input type="text" name="nama_kelas" id="nama_kelas"
                           value="{{ old('nama_kelas', $kelas->nama_kelas) }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500"
                           required>
                </div>

                {{-- Tingkat --}}
                <div>
                    <label for="tingkat" class="block font-medium text-gray-700">Tingkat</label>
                    <input type="text" name="tingkat" id="tingkat"
                           value="{{ old('tingkat', $kelas->tingkat) }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500"
                           required>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end gap-3">
                    <a href="{{ route('kelas.index') }}"
                       class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                       Kembali
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                       Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
