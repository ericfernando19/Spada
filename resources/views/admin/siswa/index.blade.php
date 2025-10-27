<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Siswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
            min-height: 100vh;
        }

        .header-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(107, 114, 128, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            transition: all 0.3s ease;
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(245, 158, 11, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.4);
        }

        .btn-info {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            transition: all 0.3s ease;
        }

        .btn-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
        }

        .table-header {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
        }

        .table-row:hover {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            transform: scale(1.01);
            transition: all 0.2s ease;
        }

        .success-alert {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            border-left: 4px solid #10b981;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .empty-state {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }

        .action-btn {
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 500;
            font-size: 0.875rem;
            border: none;
            color: white;
            cursor: pointer;
        }

        .pagination-btn {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .pagination-btn:hover {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .pagination-active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }

        .modal-overlay.active .modal-container {
            transform: scale(1);
        }

        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            padding: 1.5rem;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #6b7280;
            transition: color 0.2s;
        }

        .close-modal:hover {
            color: #374151;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            transition: all 0.2s;
            font-size: 0.875rem;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .error-message {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.25rem;
            display: none;
        }

        .error-message.active {
            display: block;
        }

        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .search-filter-container {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e2e8f0;
        }

        .filter-active {
            background: #3b82f6 !important;
            color: white !important;
        }
    </style>
</head>
<body>
    <div class="min-h-screen">
        <!-- Header -->
        <div class="header-gradient text-white py-6 px-4 sm:px-6 lg:px-8 rounded-b-3xl shadow-lg">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-center md:text-left mb-4 md:mb-0">
                        <h1 class="text-3xl font-bold">Kelola Data Siswa</h1>
                        <p class="mt-2 text-blue-100">Manajemen data siswa dan peserta didik</p>
                    </div>
                    <div class="flex items-center space-x-4 bg-white/10 backdrop-blur-sm rounded-xl p-3">
                        <div class="user-avatar bg-gradient-to-r from-cyan-500 to-blue-500 w-10 h-10 rounded-full flex items-center justify-center text-white font-bold">
                            {{ substr($user->nama ?? 'A', 0, 1) }}
                        </div>
                        <div>
                            <p class="font-semibold text-sm">{{ $user->nama ?? 'Admin' }}</p>
                            <div class="flex items-center text-xs text-blue-100">
                                <span class="inline-block w-2 h-2 rounded-full bg-green-400 mr-2"></span>
                                <span>{{ ucfirst($user->role ?? 'Admin') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                <!-- Card Header -->
                <div class="border-b border-gray-100 p-6">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-xl bg-blue-100 text-blue-600 mr-4">
                                <i class="fas fa-user-graduate text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">Data Siswa</h2>
                                <p class="text-gray-600 text-sm">Total {{ $siswas->total() }} siswa terdaftar</p>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ route('admin.dashboard') }}"
                               class="btn-secondary inline-flex items-center px-4 py-3 rounded-xl text-white font-semibold shadow transition duration-150">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali
                            </a>
                            <button id="openCreateModal"
                                    class="btn-primary inline-flex items-center px-4 py-3 rounded-xl text-white font-semibold shadow transition duration-150">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Siswa
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-6">
                    <!-- Notifikasi Sukses -->
                    @if(session('success'))
                        <div class="success-alert mb-6 p-4 rounded-lg flex items-center">
                            <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                            <div>
                                <h4 class="font-semibold text-green-800">Berhasil!</h4>
                                <p class="text-green-700 text-sm mt-1">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Search and Filter Section -->
                    <div class="search-filter-container">
                        <form id="searchFilterForm" method="GET" action="{{ route('siswa.index') }}" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Search Input -->
                                <div class="form-group">
                                    <label for="search" class="form-label">Cari Siswa</label>
                                    <div class="relative">
                                        <input type="text"
                                               id="search"
                                               name="search"
                                               class="form-input pl-10"
                                               placeholder="Cari berdasarkan nama atau NISN..."
                                               value="{{ request('search') }}">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-search text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Kelas Filter -->
                                <div class="form-group">
                                    <label for="kelas_filter" class="form-label">Filter Kelas</label>
                                    <div class="relative">
                                        <input type="text"
                                               id="kelas_filter"
                                               name="kelas"
                                               class="form-input pl-10"
                                               placeholder="Masukkan kelas..."
                                               value="{{ request('kelas') }}">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-filter text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="form-group flex items-end space-x-2">
                                    <button type="submit"
                                            class="btn-info inline-flex items-center px-4 py-2 rounded-lg text-white font-medium flex-1">
                                        <i class="fas fa-search mr-2"></i>
                                        Terapkan
                                    </button>
                                    <a href="{{ route('siswa.index') }}"
                                       class="btn-secondary inline-flex items-center px-4 py-2 rounded-lg text-white font-medium">
                                        <i class="fas fa-refresh mr-2"></i>
                                        Reset
                                    </a>
                                </div>
                            </div>

                            <!-- Active Filters -->
                            @if(request('search') || request('kelas'))
                            <div class="mt-4 p-3 bg-blue-50 rounded-lg border border-blue-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2 text-sm text-blue-800">
                                        <i class="fas fa-info-circle"></i>
                                        <span>Filter aktif:</span>
                                        @if(request('search'))
                                        <span class="bg-blue-100 px-2 py-1 rounded text-blue-700">
                                            Pencarian: "{{ request('search') }}"
                                        </span>
                                        @endif
                                        @if(request('kelas'))
                                        <span class="bg-blue-100 px-2 py-1 rounded text-blue-700">
                                            Kelas: "{{ request('kelas') }}"
                                        </span>
                                        @endif
                                    </div>
                                    <span class="text-blue-600 text-sm">
                                        Menampilkan {{ $siswas->count() }} dari {{ $siswas->total() }} hasil
                                    </span>
                                </div>
                            </div>
                            @endif
                        </form>
                    </div>

                    <!-- Tabel Siswa -->
                    <div class="overflow-x-auto rounded-xl border border-gray-200">
                        <table class="w-full">
                            <thead>
                                <tr class="table-header">
                                    <th class="p-4 text-left text-white font-semibold rounded-tl-xl">
                                        <i class="fas fa-hashtag mr-2"></i>
                                        No
                                    </th>
                                    <th class="p-4 text-left text-white font-semibold">
                                        <i class="fas fa-user mr-2"></i>
                                        Nama Siswa
                                    </th>
                                    <th class="p-4 text-left text-white font-semibold">
                                        <i class="fas fa-id-card mr-2"></i>
                                        NISN
                                    </th>
                                    <th class="p-4 text-left text-white font-semibold">
                                        <i class="fas fa-school mr-2"></i>
                                        Kelas
                                    </th>
                                    <th class="p-4 text-left text-white font-semibold">
                                        <i class="fas fa-phone mr-2"></i>
                                        No HP
                                    </th>
                                    <th class="p-4 text-center text-white font-semibold rounded-tr-xl w-48">
                                        <i class="fas fa-cogs mr-2"></i>
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($siswas as $i => $siswa)
                                    <tr class="table-row group">
                                        <td class="p-4 text-center text-gray-600 font-medium">
                                            {{ $i + $siswas->firstItem() }}
                                        </td>
                                        <td class="p-4">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold mr-3">
                                                    {{ substr($siswa->nama, 0, 1) }}
                                                </div>
                                                <span class="font-medium text-gray-800">{{ $siswa->nama }}</span>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <span class="font-mono text-gray-700 bg-gray-100 px-2 py-1 rounded text-sm">
                                                {{ $siswa->nisn }}
                                            </span>
                                        </td>
                                        <td class="p-4">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-school mr-1"></i>
                                                {{ $siswa->kelas }}
                                            </span>
                                        </td>
                                        <td class="p-4">
                                            @if($siswa->no_hp)
                                                <div class="flex items-center text-gray-700">
                                                    <i class="fas fa-phone text-blue-500 mr-2"></i>
                                                    {{ $siswa->no_hp }}
                                                </div>
                                            @else
                                                <span class="text-gray-400 italic">-</span>
                                            @endif
                                        </td>
                                        <td class="p-4">
                                            <div class="flex justify-center space-x-2">
                                                <button class="btn-warning action-btn inline-flex items-center edit-btn"
                                                        data-id="{{ $siswa->id }}"
                                                        data-nama="{{ $siswa->nama }}"
                                                        data-nisn="{{ $siswa->nisn }}"
                                                        data-kelas="{{ $siswa->kelas }}"
                                                        data-no_hp="{{ $siswa->no_hp }}">
                                                    <i class="fas fa-edit mr-1"></i>
                                                    Edit
                                                </button>
                                                <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn-danger action-btn inline-flex items-center"
                                                            onclick="return confirm('Yakin ingin menghapus siswa {{ $siswa->nama }}?')">
                                                        <i class="fas fa-trash mr-1"></i>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-8 text-center empty-state">
                                            <div class="flex flex-col items-center justify-center py-8">
                                                <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                                    <i class="fas fa-user-graduate text-gray-400 text-2xl"></i>
                                                </div>
                                                <h3 class="text-lg font-semibold text-gray-600 mb-2">
                                                    @if(request('search') || request('kelas'))
                                                        Data tidak ditemukan
                                                    @else
                                                        Belum ada data siswa
                                                    @endif
                                                </h3>
                                                <p class="text-gray-500 text-sm mb-4">
                                                    @if(request('search') || request('kelas'))
                                                        Coba ubah kata kunci pencarian atau filter kelas
                                                    @else
                                                        Mulai dengan menambahkan siswa pertama Anda
                                                    @endif
                                                </p>
                                                @if(request('search') || request('kelas'))
                                                    <a href="{{ route('siswa.index') }}"
                                                       class="btn-secondary inline-flex items-center px-4 py-2 rounded-lg text-white font-semibold">
                                                        <i class="fas fa-refresh mr-2"></i>
                                                        Tampilkan Semua Data
                                                    </a>
                                                @else
                                                    <button id="openCreateModalEmpty"
                                                            class="btn-primary inline-flex items-center px-4 py-2 rounded-lg text-white font-semibold">
                                                        <i class="fas fa-plus mr-2"></i>
                                                        Tambah Siswa Pertama
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($siswas->hasPages())
                        <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="text-sm text-gray-600">
                                Menampilkan {{ $siswas->firstItem() }} - {{ $siswas->lastItem() }} dari {{ $siswas->total() }} siswa
                                @if(request('search') || request('kelas'))
                                    <span class="text-blue-600">(Hasil filter)</span>
                                @endif
                            </div>
                            <div class="flex space-x-2">
                                @if($siswas->onFirstPage())
                                    <span class="pagination-btn opacity-50 cursor-not-allowed">
                                        <i class="fas fa-chevron-left mr-2"></i>Sebelumnya
                                    </span>
                                @else
                                    <a href="{{ $siswas->previousPageUrl() }}{{ request('search') ? '&search=' . request('search') : '' }}{{ request('kelas') ? '&kelas=' . request('kelas') : '' }}"
                                       class="pagination-btn">
                                        <i class="fas fa-chevron-left mr-2"></i>Sebelumnya
                                    </a>
                                @endif

                                @foreach($siswas->getUrlRange(1, $siswas->lastPage()) as $page => $url)
                                    @if($page == $siswas->currentPage())
                                        <span class="pagination-btn pagination-active">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}{{ request('search') ? '&search=' . request('search') : '' }}{{ request('kelas') ? '&kelas=' . request('kelas') : '' }}"
                                           class="pagination-btn">{{ $page }}</a>
                                    @endif
                                @endforeach

                                @if($siswas->hasMorePages())
                                    <a href="{{ $siswas->nextPageUrl() }}{{ request('search') ? '&search=' . request('search') : '' }}{{ request('kelas') ? '&kelas=' . request('kelas') : '' }}"
                                       class="pagination-btn">
                                        Selanjutnya<i class="fas fa-chevron-right ml-2"></i>
                                    </a>
                                @else
                                    <span class="pagination-btn opacity-50 cursor-not-allowed">
                                        Selanjutnya<i class="fas fa-chevron-right ml-2"></i>
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Info Footer -->
                    @if($siswas->count() > 0)
                        <div class="mt-4 flex justify-between items-center text-sm text-gray-500">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                                <span>Menampilkan {{ $siswas->count() }} data siswa</span>
                                @if(request('search') || request('kelas'))
                                    <span class="ml-2 text-blue-600">• Hasil pencarian dan filter</span>
                                @endif
                            </div>
                            <div class="flex items-center space-x-4">
                                <button class="flex items-center text-gray-500 hover:text-blue-600 transition-colors">
                                    <i class="fas fa-download mr-1"></i>
                                    Export
                                </button>
                                <button class="flex items-center text-gray-500 hover:text-blue-600 transition-colors">
                                    <i class="fas fa-print mr-1"></i>
                                    Print
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Siswa -->
    <div id="createModal" class="modal-overlay">
        <div class="modal-container">
            <div class="modal-header">
                <h3 class="text-lg font-semibold text-gray-800">Tambah Data Siswa</h3>
                <button type="button" class="close-modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="createForm" method="POST" action="{{ route('siswa.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama" class="form-label">Nama Siswa</label>
                        <input type="text" id="nama" name="nama" class="form-input" placeholder="Masukkan nama lengkap siswa" required value="{{ old('nama') }}">
                        <div class="error-message" id="nama-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="nisn" class="form-label">NISN</label>
                        <input type="text" id="nisn" name="nisn" class="form-input" placeholder="Masukkan NISN siswa" required value="{{ old('nisn') }}">
                        <div class="error-message" id="nisn-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="kelas" class="form-label">Kelas</label>
                        <input type="text" id="kelas" name="kelas" class="form-input" placeholder="Masukkan kelas siswa" value="{{ old('kelas') }}">
                        <div class="error-message" id="kelas-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="no_hp" class="form-label">No. HP</label>
                        <input type="text" id="no_hp" name="no_hp" class="form-input" placeholder="Masukkan nomor telepon siswa" value="{{ old('no_hp') }}">
                        <div class="error-message" id="no_hp-error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary inline-flex items-center px-4 py-2 rounded-lg text-white font-medium close-modal">
                        Batal
                    </button>
                    <button type="submit" class="btn-primary inline-flex items-center px-4 py-2 rounded-lg text-white font-medium">
                        <i class="fas fa-save mr-2"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Siswa -->
    <div id="editModal" class="modal-overlay">
        <div class="modal-container">
            <div class="modal-header">
                <h3 class="text-lg font-semibold text-gray-800">Edit Data Siswa</h3>
                <button type="button" class="close-modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_nama" class="form-label">Nama Siswa</label>
                        <input type="text" id="edit_nama" name="nama" class="form-input" placeholder="Masukkan nama lengkap siswa" required>
                        <div class="error-message" id="edit_nama-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="edit_nisn" class="form-label">NISN</label>
                        <input type="text" id="edit_nisn" name="nisn" class="form-input" placeholder="Masukkan NISN siswa" required>
                        <div class="error-message" id="edit_nisn-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="edit_kelas" class="form-label">Kelas</label>
                        <input type="text" id="edit_kelas" name="kelas" class="form-input" placeholder="Masukkan kelas siswa">
                        <div class="error-message" id="edit_kelas-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="edit_no_hp" class="form-label">No. HP</label>
                        <input type="text" id="edit_no_hp" name="no_hp" class="form-input" placeholder="Masukkan nomor telepon siswa">
                        <div class="error-message" id="edit_no_hp-error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary inline-flex items-center px-4 py-2 rounded-lg text-white font-medium close-modal">
                        Batal
                    </button>
                    <button type="submit" class="btn-primary inline-flex items-center px-4 py-2 rounded-lg text-white font-medium">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Konfirmasi hapus
            const deleteButtons = document.querySelectorAll('form[action*="destroy"] button[type="submit"]');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (!confirm('Yakin ingin menghapus data ini?')) {
                        e.preventDefault();
                    }
                });
            });

            // Modal functionality
            const createModal = document.getElementById('createModal');
            const editModal = document.getElementById('editModal');
            const openCreateModalBtn = document.getElementById('openCreateModal');
            const openCreateModalEmptyBtn = document.getElementById('openCreateModalEmpty');
            const closeModalBtns = document.querySelectorAll('.close-modal');
            const editBtns = document.querySelectorAll('.edit-btn');
            const editForm = document.getElementById('editForm');
            const createForm = document.getElementById('createForm');

            // Open create modal
            openCreateModalBtn.addEventListener('click', () => {
                createModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            });

            // Open create modal from empty state
            if (openCreateModalEmptyBtn) {
                openCreateModalEmptyBtn.addEventListener('click', () => {
                    createModal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                });
            }

            // Open edit modal
            editBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.getAttribute('data-id');
                    const nama = btn.getAttribute('data-nama');
                    const nisn = btn.getAttribute('data-nisn');
                    const kelas = btn.getAttribute('data-kelas');
                    const no_hp = btn.getAttribute('data-no_hp');

                    document.getElementById('edit_id').value = id;
                    document.getElementById('edit_nama').value = nama;
                    document.getElementById('edit_nisn').value = nisn;
                    document.getElementById('edit_kelas').value = kelas;
                    document.getElementById('edit_no_hp').value = no_hp;

                    // Perbaikan route untuk edit form - menggunakan route name
                    editForm.action = `{{ route('siswa.update', '') }}/${id}`;
                    editModal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                });
            });

            // Close modals
            closeModalBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    createModal.classList.remove('active');
                    editModal.classList.remove('active');
                    document.body.style.overflow = 'auto';
                    clearErrors();
                    resetForms();
                });
            });

            // Close modal when clicking outside
            [createModal, editModal].forEach(modal => {
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        modal.classList.remove('active');
                        document.body.style.overflow = 'auto';
                        clearErrors();
                        resetForms();
                    }
                });
            });

            // Form validation
            function clearErrors() {
                document.querySelectorAll('.error-message').forEach(el => {
                    el.classList.remove('active');
                    el.textContent = '';
                });
            }

            function resetForms() {
                createForm.reset();
                editForm.reset();
            }

            // Handle form submission - SEDERHANA tanpa AJAX
            // Karena controller mengembalikan redirect biasa

            // Hanya validasi client-side sebelum submit
            createForm.addEventListener('submit', function(e) {
                clearErrors();

                let isValid = true;
                const nama = document.getElementById('nama').value.trim();
                const nisn = document.getElementById('nisn').value.trim();

                if (!nama) {
                    document.getElementById('nama-error').textContent = 'Nama siswa harus diisi';
                    document.getElementById('nama-error').classList.add('active');
                    isValid = false;
                }

                if (!nisn) {
                    document.getElementById('nisn-error').textContent = 'NISN harus diisi';
                    document.getElementById('nisn-error').classList.add('active');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });

            editForm.addEventListener('submit', function(e) {
                clearErrors();

                let isValid = true;
                const nama = document.getElementById('edit_nama').value.trim();
                const nisn = document.getElementById('edit_nisn').value.trim();

                if (!nama) {
                    document.getElementById('edit_nama-error').textContent = 'Nama siswa harus diisi';
                    document.getElementById('edit_nama-error').classList.add('active');
                    isValid = false;
                }

                if (!nisn) {
                    document.getElementById('edit_nisn-error').textContent = 'NISN harus diisi';
                    document.getElementById('edit_nisn-error').classList.add('active');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });

            // Search and Filter functionality
            const searchInput = document.getElementById('search');
            const kelasFilterInput = document.getElementById('kelas_filter');
            const searchFilterForm = document.getElementById('searchFilterForm');

            // Auto submit form ketika menekan enter di input search
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    searchFilterForm.submit();
                }
            });

            // Auto submit form ketika menekan enter di input kelas filter
            kelasFilterInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    searchFilterForm.submit();
                }
            });

            // Jika ada error validasi dari server, tampilkan di modal
            @if($errors->any())
                @if(old('_token'))
                    // Jika ada error dan form sudah disubmit, buka modal yang sesuai
                    document.addEventListener('DOMContentLoaded', function() {
                        @if(request()->is('*siswa/create*') || request()->routeIs('siswa.create'))
                            createModal.classList.add('active');
                            document.body.style.overflow = 'hidden';

                            // Tampilkan error
                            @error('nama')
                                document.getElementById('nama-error').textContent = '{{ $message }}';
                                document.getElementById('nama-error').classList.add('active');
                            @enderror
                            @error('nisn')
                                document.getElementById('nisn-error').textContent = '{{ $message }}';
                                document.getElementById('nisn-error').classList.add('active');
                            @enderror
                            @error('kelas')
                                document.getElementById('kelas-error').textContent = '{{ $message }}';
                                document.getElementById('kelas-error').classList.add('active');
                            @enderror
                            @error('no_hp')
                                document.getElementById('no_hp-error').textContent = '{{ $message }}';
                                document.getElementById('no_hp-error').classList.add('active');
                            @enderror
                        @elseif(request()->is('*siswa/*/edit*') || request()->routeIs('siswa.edit'))
                            editModal.classList.add('active');
                            document.body.style.overflow = 'hidden';

                            // Tampilkan error
                            @error('nama')
                                document.getElementById('edit_nama-error').textContent = '{{ $message }}';
                                document.getElementById('edit_nama-error').classList.add('active');
                            @enderror
                            @error('nisn')
                                document.getElementById('edit_nisn-error').textContent = '{{ $message }}';
                                document.getElementById('edit_nisn-error').classList.add('active');
                            @enderror
                            @error('kelas')
                                document.getElementById('edit_kelas-error').textContent = '{{ $message }}';
                                document.getElementById('edit_kelas-error').classList.add('active');
                            @enderror
                            @error('no_hp')
                                document.getElementById('edit_no_hp-error').textContent = '{{ $message }}';
                                document.getElementById('edit_no_hp-error').classList.add('active');
                            @enderror
                        @endif
                    });
                @endif
            @endif
        });
    </script>
</body>
</html>
