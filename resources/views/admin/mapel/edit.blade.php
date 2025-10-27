<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Card -->
            <div class="bg-white shadow-xl rounded-2xl p-6 mb-8 transition transform hover:-translate-y-1 hover:shadow-2xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 rounded-xl bg-yellow-100 text-yellow-600">
                            <i class="fas fa-edit text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Edit Mata Pelajaran</h2>
                            <p class="text-gray-600 text-sm">Memperbarui data {{ $mapel->nama_mapel }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 bg-purple-50 px-4 py-2 rounded-lg">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-500 to-pink-600 flex items-center justify-center text-white font-bold">
                            {{ substr($mapel->nama_mapel, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-medium text-purple-800">{{ $mapel->nama_mapel }}</p>
                            <p class="text-xs text-purple-600">Kode: {{ $mapel->kode_mapel }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white shadow-xl rounded-2xl p-8 transition transform hover:-translate-y-1 hover:shadow-2xl">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center border-b pb-3">
                    ✏️ Edit Mata Pelajaran
                </h2>

                <!-- Alert sukses atau error -->
                @if (session('success'))
                    <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-700 border border-green-300">
                        {{ session('success') }}
                    </div>
                @elseif (session('error'))
                    <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-700 border border-red-300">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-700 border border-red-300">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.mapel.update', $mapel->id) }}" method="POST" class="space-y-6" id="editForm">
                    @csrf
                    @method('PUT')

                    <!-- Informasi Mata Pelajaran Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-book text-purple-500 mr-2"></i>
                            Informasi Mata Pelajaran
                        </h3>

                        <!-- Kode Mapel -->
                        <div class="mb-5">
                            <label class="block text-gray-700 font-medium mb-2">
                                <i class="fas fa-code mr-2"></i>
                                Kode Mata Pelajaran
                            </label>
                            <input type="text"
                                   name="kode_mapel"
                                   id="kode_mapel"
                                   value="{{ old('kode_mapel', $mapel->kode_mapel) }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-400 focus:border-purple-400 focus:outline-none transition"
                                   placeholder="Masukkan kode mata pelajaran">
                        </div>

                        <!-- Nama Mapel -->
                        <div class="mb-5">
                            <label class="block text-gray-700 font-medium mb-2">
                                <i class="fas fa-book-open mr-2"></i>
                                Nama Mata Pelajaran
                            </label>
                            <input type="text"
                                   name="nama_mapel"
                                   id="nama_mapel"
                                   value="{{ old('nama_mapel', $mapel->nama_mapel) }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-400 focus:border-purple-400 focus:outline-none transition"
                                   placeholder="Masukkan nama mata pelajaran">
                        </div>
                    </div>

                    <!-- Kelas Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-school text-green-500 mr-2"></i>
                            Penempatan Kelas
                        </h3>

                        <!-- Pilih Kelas -->
                        <div class="mb-5">
                            <label class="block text-gray-700 font-medium mb-2">
                                <i class="fas fa-graduation-cap mr-2"></i>
                                Kelas
                            </label>
                            <select name="kelas_id"
                                    id="kelas_id"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-400 focus:border-purple-400 focus:outline-none transition appearance-none bg-white">
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}" {{ $mapel->kelas_id == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Info Status -->
                    <div class="p-4 bg-purple-50 rounded-lg border border-purple-200">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-purple-500 mt-1 mr-3"></i>
                            <div>
                                <h4 class="font-medium text-purple-800 text-sm">Status Pengeditan</h4>
                                <p class="text-purple-700 text-sm mt-1">
                                    Anda sedang mengedit mata pelajaran <strong>{{ $mapel->nama_mapel }}</strong> dengan kode <strong>{{ $mapel->kode_mapel }}</strong>.
                                    Perubahan akan langsung tersimpan setelah Anda menekan tombol "Perbarui Data".
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex flex-col sm:flex-row justify-between gap-4 pt-6 border-t">
                        <a href="{{ route('admin.mapel.index') }}"
                           class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition text-center flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Daftar
                        </a>
                        <button type="submit"
                                class="px-5 py-2 bg-purple-600 text-white rounded-lg shadow hover:bg-purple-700 transition flex items-center justify-center"
                                id="submitBtn">
                            <i class="fas fa-save mr-2"></i>
                            <span id="btnText">Perbarui Data</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Quick Info -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Data Saat Ini -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 transition transform hover:-translate-y-1 hover:shadow-lg">
                    <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-history text-yellow-500 mr-2"></i>
                        Data Saat Ini
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Kode:</span>
                            <span class="font-mono text-gray-800">{{ $mapel->kode_mapel }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Nama Mapel:</span>
                            <span class="font-medium text-gray-800">{{ $mapel->nama_mapel }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600">Kelas:</span>
                            <span class="font-medium text-gray-800">
                                @foreach ($kelas as $k)
                                    @if ($k->id == $mapel->kelas_id)
                                        {{ $k->nama_kelas }}
                                    @endif
                                @endforeach
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Statistik Cepat -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 transition transform hover:-translate-y-1 hover:shadow-lg">
                    <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-chart-bar text-green-500 mr-2"></i>
                        Statistik
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="p-2 rounded-lg bg-yellow-100 text-yellow-600 mr-3">
                                    <i class="fas fa-sync-alt"></i>
                                </div>
                                <span class="text-sm text-gray-600">Proses Edit</span>
                            </div>
                            <span class="font-bold text-gray-800">1</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }
    </style>

    <script>
        // Form submission loading state
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('editForm');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');

            form.addEventListener('submit', function(e) {
                // Prevent double submission
                if (submitBtn.disabled) {
                    e.preventDefault();
                    return;
                }

                // Change button state
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
                btnText.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memperbarui...';
            });
        });
    </script>
</x-app-layout>
