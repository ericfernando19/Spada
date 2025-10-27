<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-10">
        <div class="max-w-lg mx-auto">
            <div class="bg-white shadow-xl rounded-2xl p-8 transition transform hover:-translate-y-1 hover:shadow-2xl">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center border-b pb-3">
                    ✏️ Edit Data Pengguna
                </h2>

                <!-- Alert sukses atau error -->
                @if (session('success'))
                    <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-700 border border-green-300">
                        {{ session('success') }}
                    </div>
                @elseif (session('error'))
                    <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 border border-red-300">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('user.update', $user->id) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Nama</label>
                        <input type="text" name="nama" value="{{ $user->nama }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition"
                            placeholder="Masukkan nama lengkap">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Username</label>
                        <input type="text" name="username" value="{{ $user->username }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition"
                            placeholder="Masukkan username / NIP / NISN">
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <a href="{{ route('import.form') }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-5 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
