<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Guru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 text-gray-900">
                <h1 class="text-2xl font-semibold text-green-700 mb-1">
                    Selamat Datang, {{ $user->nama }}
                </h1>
                <p class="text-gray-600 mb-6">Role: {{ ucfirst($user->role) }}</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                    <div class="bg-green-50 rounded-xl p-6 text-center shadow">
                        <h2 class="text-4xl font-bold text-green-800">{{ $jumlahPelajaran ?? 0 }}</h2>
                        <p class="text-gray-600 mt-2">Mata Pelajaran yang Anda Ajar</p>
                    </div>
                    <div class="bg-green-50 rounded-xl p-6 text-center shadow">
                        <h2 class="text-4xl font-bold text-green-800">{{ $jumlahSiswa ?? 0 }}</h2>
                        <p class="text-gray-600 mt-2">Jumlah Siswa (Coming Soon)</p>
                    </div>
                </div>

                <div class="flex flex-col gap-3">
                    <a href="{{ route('guru.mata-pelajaran') }}" class="bg-green-100 hover:bg-green-200 text-green-800 font-medium px-4 py-3 rounded-md">
                        📘 Kelola Mata Pelajaran
                    </a>
                    <a href="{{ route('guru.absensi.index') }}" class="bg-green-100 hover:bg-green-200 text-green-800 font-medium px-4 py-3 rounded-md">
                        📋 Absensi Kelas
                    </a>
                    <a href="{{ route('guru.siswa-diajar.index') }}" class="bg-green-100 hover:bg-green-200 text-green-800 font-medium px-4 py-3 rounded-md">
                        🧑‍🎓 Daftar Siswa yang Diajar
                    </a>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="mt-8">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-5 py-2 rounded-md">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
