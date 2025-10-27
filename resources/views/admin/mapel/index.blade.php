<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Mata Pelajaran</title>
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
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(139, 92, 246, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(107, 114, 128, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
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

        .table-header {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
        }

        .table-row:hover {
            background-color: #faf5ff;
            transition: all 0.2s ease;
        }

        .success-alert {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            border-left: 4px solid #10b981;
        }

        .error-alert {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border-left: 4px solid #ef4444;
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
            transition: all 0.3s ease;
        }

        .kelas-badge {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
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

        .modal-content {
            background: white;
            border-radius: 16px;
            width: 90%;
            max-width: 500px;
            transform: translateY(-20px);
            transition: transform 0.3s ease;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-overlay.active .modal-content {
            transform: translateY(0);
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
            font-size: 1.25rem;
            color: #6b7280;
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .close-modal:hover {
            background-color: #f3f4f6;
            color: #374151;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        }

        .form-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            background-color: white;
            transition: all 0.2s;
        }

        .form-select:focus {
            outline: none;
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        }

        .error-message {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        .search-box {
            background: white;
            border: 1px solid #e2e8f0;
        }

        .search-box:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        }

        .loading-spinner {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border: 2px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="header-gradient text-white py-6 px-4 sm:px-6 lg:px-8 rounded-b-3xl shadow-lg">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-center md:text-left mb-4 md:mb-0">
                        <h1 class="text-3xl font-bold">Kelola Mata Pelajaran</h1>
                        <p class="mt-2 text-blue-100">Manajemen data mata pelajaran dan kurikulum</p>
                    </div>
                    <div class="flex items-center space-x-4 bg-white/10 backdrop-blur-sm rounded-xl p-3">
                        <div class="user-avatar bg-gradient-to-r from-cyan-500 to-blue-500 w-10 h-10 rounded-full flex items-center justify-center text-white font-bold">
                            {{ substr(Auth::user()->nama ?? 'A', 0, 1) }}
                        </div>
                        <div>
                            <p class="font-semibold text-sm">{{ Auth::user()->nama ?? 'Admin' }}</p>
                            <div class="flex items-center text-xs text-blue-100">
                                <span class="inline-block w-2 h-2 rounded-full bg-green-400 mr-2"></span>
                                <span>{{ ucfirst(Auth::user()->role ?? 'Admin') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <!-- Card Header -->
                    <div class="border-b border-gray-100 p-6">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div class="flex items-center">
                                <div class="p-3 rounded-xl bg-purple-100 text-purple-600 mr-4">
                                    <i class="fas fa-book text-xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-800">Data Mata Pelajaran</h2>
                                    <p class="text-gray-600 text-sm">Total {{ $mapel->count() }} mata pelajaran terdaftar</p>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('admin.dashboard') }}"
                                   class="btn-secondary inline-flex items-center px-4 py-3 rounded-xl text-white font-semibold shadow transition duration-150">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    Kembali
                                </a>
                                <button id="btnTambahMapel"
                                   class="btn-primary inline-flex items-center px-4 py-3 rounded-xl text-white font-semibold shadow transition duration-150">
                                    <i class="fas fa-plus mr-2"></i>
                                    Tambah Mapel
                                </button>
                                <a href="{{ route('kelas.index') }}"
                                   class="btn-success inline-flex items-center px-4 py-3 rounded-xl text-white font-semibold shadow transition duration-150">
                                    <i class="fas fa-school mr-2"></i>
                                    Kelola Kelas
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Search and Filter Section -->
                    <div class="p-6 border-b border-gray-100 bg-gray-50">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Search Input -->
                            <div>
                                <label for="searchInput" class="form-label">Cari Mata Pelajaran</label>
                                <div class="relative">
                                    <input type="text"
                                           id="searchInput"
                                           class="form-input search-box pl-10"
                                           placeholder="Cari nama mapel, kode, atau kelas...">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Filter Kelas -->
                            <div>
                                <label for="filterKelas" class="form-label">Filter Kelas</label>
                                <select id="filterKelas" class="form-select">
                                    <option value="">Semua Kelas</option>
                                    @foreach($mapel->pluck('kelas')->unique() as $kelasItem)
                                        @if($kelasItem)
                                            <option value="{{ $kelasItem->id }}">
                                                {{ $kelasItem->tingkat }} - {{ $kelasItem->nama_kelas }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-end space-x-2">
                                <button type="button" id="btnResetFilter"
                                        class="btn-secondary inline-flex items-center px-4 py-2.5 rounded-lg text-white font-semibold">
                                    <i class="fas fa-refresh mr-2"></i>
                                    Reset
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6">
                        <!-- Notifikasi -->
                        @if(session('success'))
                            <div class="success-alert mb-6 p-4 rounded-lg flex items-center">
                                <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                                <div>
                                    <h4 class="font-semibold text-green-800">Berhasil!</h4>
                                    <p class="text-green-700 text-sm mt-1">{{ session('success') }}</p>
                                </div>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="error-alert mb-6 p-4 rounded-lg flex items-center">
                                <i class="fas fa-exclamation-circle text-red-600 text-xl mr-3"></i>
                                <div>
                                    <h4 class="font-semibold text-red-800">Error!</h4>
                                    <p class="text-red-700 text-sm mt-1">{{ session('error') }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Tabel Mata Pelajaran -->
                        <div class="overflow-x-auto rounded-xl border border-gray-200">
                            <table class="w-full min-w-full">
                                <thead>
                                    <tr class="table-header">
                                        <th class="p-4 text-left text-white font-semibold">
                                            <i class="fas fa-code mr-2"></i>
                                            Kode Mapel
                                        </th>
                                        <th class="p-4 text-left text-white font-semibold">
                                            <i class="fas fa-book-open mr-2"></i>
                                            Nama Mata Pelajaran
                                        </th>
                                        <th class="p-4 text-left text-white font-semibold">
                                            <i class="fas fa-school mr-2"></i>
                                            Kelas
                                        </th>
                                        <th class="p-4 text-center text-white font-semibold w-48">
                                            <i class="fas fa-cogs mr-2"></i>
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100" id="tableBody">
                                    @forelse($mapel as $m)
                                        <tr class="table-row group" data-id="{{ $m->id }}" data-kelas="{{ $m->kelas_id }}">
                                            <td class="p-4">
                                                <span class="font-mono text-gray-700 bg-gray-100 px-3 py-1.5 rounded-lg text-sm font-medium">
                                                    {{ $m->kode_mapel }}
                                                </span>
                                            </td>
                                            <td class="p-4">
                                                <div class="flex items-center">
                                                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-500 to-pink-600 flex items-center justify-center text-white font-bold mr-3">
                                                        {{ substr($m->nama_mapel, 0, 1) }}
                                                    </div>
                                                    <span class="font-medium text-gray-800">{{ $m->nama_mapel }}</span>
                                                </div>
                                            </td>
                                            <td class="p-4">
                                                <span class="kelas-badge">
                                                    <i class="fas fa-graduation-cap mr-1.5 text-xs"></i>
                                                    {{ $m->kelas->tingkat }} - {{ $m->kelas->nama_kelas }}
                                                </span>
                                            </td>
                                            <td class="p-4">
                                                <div class="flex justify-center space-x-2">
                                                    <button class="btn-edit btn-warning action-btn inline-flex items-center"
                                                            data-id="{{ $m->id }}"
                                                            data-nama="{{ $m->nama_mapel }}"
                                                            data-kode="{{ $m->kode_mapel }}"
                                                            data-kelas="{{ $m->kelas_id }}">
                                                        <i class="fas fa-edit mr-1"></i>
                                                        Edit
                                                    </button>
                                                    <button type="button"
                                                            class="btn-delete btn-danger action-btn inline-flex items-center"
                                                            data-id="{{ $m->id }}"
                                                            data-nama="{{ $m->nama_mapel }}">
                                                        <i class="fas fa-trash mr-1"></i>
                                                        Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="p-8 text-center empty-state">
                                                <div class="flex flex-col items-center justify-center py-8">
                                                    <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                                        <i class="fas fa-book text-gray-400 text-2xl"></i>
                                                    </div>
                                                    <h3 class="text-lg font-semibold text-gray-600 mb-2">Belum ada data mata pelajaran</h3>
                                                    <p class="text-gray-500 text-sm mb-4">Mulai dengan menambahkan mata pelajaran pertama</p>
                                                    <button id="btnTambahPertama" class="btn-primary inline-flex items-center px-4 py-2 rounded-lg text-white font-semibold">
                                                        <i class="fas fa-plus mr-2"></i>
                                                        Tambah Mapel Pertama
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Info Footer -->
                        @if($mapel->count() > 0)
                            <div class="mt-4 flex flex-col sm:flex-row justify-between items-center gap-4 text-sm text-gray-500">
                                <div class="flex items-center">
                                    <i class="fas fa-info-circle mr-2 text-purple-500"></i>
                                    <span id="totalInfo">Menampilkan {{ $mapel->count() }} data mata pelajaran</span>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <button class="flex items-center text-gray-500 hover:text-purple-600 transition-colors">
                                        <i class="fas fa-download mr-1"></i>
                                        Export
                                    </button>
                                    <button class="flex items-center text-gray-500 hover:text-purple-600 transition-colors">
                                        <i class="fas fa-print mr-1"></i>
                                        Print
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Tambah/Edit Mapel -->
    <div id="modalMapel" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-lg font-semibold text-gray-800" id="modalTitle">Tambah Mata Pelajaran</h3>
                <button type="button" class="close-modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="formMapel" method="POST">
                @csrf
                <input type="hidden" id="mapel_id" name="id">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_mapel" class="form-label">Nama Mata Pelajaran <span class="text-red-500">*</span></label>
                        <input type="text" id="nama_mapel" name="nama_mapel" class="form-input" required>
                        <div id="error_nama_mapel" class="error-message"></div>
                    </div>

                    <div class="form-group">
                        <label for="kode_mapel" class="form-label">Kode Mata Pelajaran <span class="text-red-500">*</span></label>
                        <input type="text" id="kode_mapel" name="kode_mapel" class="form-input" required>
                        <div id="error_kode_mapel" class="error-message"></div>
                    </div>

                    <div class="form-group">
                        <label for="kelas_id" class="form-label">Kelas <span class="text-red-500">*</span></label>
                        <select id="kelas_id" name="kelas_id" class="form-select" required>
                            <option value="">Pilih Kelas</option>
                            @php
                                $kelasList = \App\Models\Kelas::all();
                            @endphp
                            @foreach($kelasList as $k)
                                <option value="{{ $k->id }}">{{ $k->tingkat }} - {{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                        <div id="error_kelas_id" class="error-message"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-secondary inline-flex items-center px-4 py-2 rounded-lg text-white font-semibold shadow transition duration-150 close-modal">
                        Batal
                    </button>
                    <button type="submit" id="btnSubmit" class="btn-primary inline-flex items-center px-4 py-2 rounded-lg text-white font-semibold shadow transition duration-150">
                        <i class="fas fa-save mr-2"></i>
                        <span id="submitText">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Form Delete Hidden -->
    <form id="formDelete" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('modalMapel');
            const modalTitle = document.getElementById('modalTitle');
            const formMapel = document.getElementById('formMapel');
            const mapelId = document.getElementById('mapel_id');
            const namaMapel = document.getElementById('nama_mapel');
            const kodeMapel = document.getElementById('kode_mapel');
            const kelasId = document.getElementById('kelas_id');
            const btnSubmit = document.getElementById('btnSubmit');
            const submitText = document.getElementById('submitText');
            const formDelete = document.getElementById('formDelete');

            // Elements untuk search dan filter
            const searchInput = document.getElementById('searchInput');
            const filterKelas = document.getElementById('filterKelas');
            const btnResetFilter = document.getElementById('btnResetFilter');
            const tableBody = document.getElementById('tableBody');
            const totalInfo = document.getElementById('totalInfo');

            // Tombol untuk membuka modal tambah
            const btnTambahMapel = document.getElementById('btnTambahMapel');
            const btnTambahPertama = document.getElementById('btnTambahPertama');

            // Tombol untuk menutup modal
            const closeButtons = document.querySelectorAll('.close-modal');

            // Data awal untuk filtering
            const originalRows = Array.from(tableBody.querySelectorAll('tr[data-id]'));

            // Fungsi untuk membuka modal
            function openModal() {
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            // Fungsi untuk menutup modal
            function closeModal() {
                modal.classList.remove('active');
                document.body.style.overflow = 'auto';
                resetForm();
            }

            // Fungsi untuk reset form
            function resetForm() {
                formMapel.reset();
                mapelId.value = '';
                modalTitle.textContent = 'Tambah Mata Pelajaran';
                submitText.textContent = 'Simpan';
                formMapel.action = "{{ route('admin.mapel.store') }}";
                formMapel.method = 'POST';

                // Hapus input _method jika ada
                const methodInput = formMapel.querySelector('input[name="_method"]');
                if (methodInput) {
                    methodInput.remove();
                }

                // Hapus pesan error
                document.querySelectorAll('.error-message').forEach(el => {
                    el.textContent = '';
                });
            }

            // Fungsi untuk filter dan search
            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedKelas = filterKelas.value;

                let visibleCount = 0;

                originalRows.forEach(row => {
                    const nama = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const kode = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                    const kelas = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                    const rowKelas = row.getAttribute('data-kelas');

                    const matchesSearch = !searchTerm ||
                        nama.includes(searchTerm) ||
                        kode.includes(searchTerm) ||
                        kelas.includes(searchTerm);

                    const matchesFilter = !selectedKelas || rowKelas === selectedKelas;

                    if (matchesSearch && matchesFilter) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Update info total
                if (totalInfo) {
                    totalInfo.textContent = `Menampilkan ${visibleCount} data mata pelajaran`;
                }

                // Tampilkan pesan jika tidak ada data
                const emptyRow = tableBody.querySelector('tr:not([data-id])');
                if (emptyRow) {
                    if (visibleCount === 0 && (searchTerm || selectedKelas)) {
                        emptyRow.style.display = '';
                        emptyRow.querySelector('h3').textContent = 'Data tidak ditemukan';
                        emptyRow.querySelector('p').textContent = 'Coba ubah kata kunci pencarian atau filter';
                    } else if (visibleCount === 0) {
                        emptyRow.style.display = '';
                        emptyRow.querySelector('h3').textContent = 'Belum ada data mata pelajaran';
                        emptyRow.querySelector('p').textContent = 'Mulai dengan menambahkan mata pelajaran pertama';
                    } else {
                        emptyRow.style.display = 'none';
                    }
                }
            }

            // Event listener untuk tombol tambah
            if (btnTambahMapel) {
                btnTambahMapel.addEventListener('click', function() {
                    resetForm();
                    openModal();
                });
            }

            if (btnTambahPertama) {
                btnTambahPertama.addEventListener('click', function() {
                    resetForm();
                    openModal();
                });
            }

            // Event listener untuk tombol edit
            document.addEventListener('click', function(e) {
                if (e.target.closest('.btn-edit')) {
                    const button = e.target.closest('.btn-edit');
                    const id = button.getAttribute('data-id');
                    const nama = button.getAttribute('data-nama');
                    const kode = button.getAttribute('data-kode');
                    const kelas = button.getAttribute('data-kelas');

                    // Isi form dengan data yang ada
                    mapelId.value = id;
                    namaMapel.value = nama;
                    kodeMapel.value = kode;
                    kelasId.value = kelas;

                    // Update form untuk edit
                    formMapel.action = `/admin/mapel/${id}`;
                    formMapel.method = 'POST';

                    // Tambahkan input _method untuk spoofing PUT
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'PUT';
                    formMapel.appendChild(methodInput);

                    modalTitle.textContent = 'Edit Mata Pelajaran';
                    submitText.textContent = 'Simpan Perubahan';
                    openModal();
                }
            });

            // Event listener untuk tombol delete
            document.addEventListener('click', function(e) {
                if (e.target.closest('.btn-delete')) {
                    const button = e.target.closest('.btn-delete');
                    const id = button.getAttribute('data-id');
                    const nama = button.getAttribute('data-nama');

                    if (confirm(`Yakin ingin menghapus mata pelajaran "${nama}"?`)) {
                        // Set form action dan submit
                        formDelete.action = `/admin/mapel/${id}`;
                        formDelete.submit();
                    }
                }
            });

            // Event listener untuk tombol tutup
            closeButtons.forEach(button => {
                button.addEventListener('click', closeModal);
            });

            // Event listener untuk klik di luar modal
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // Event listener untuk search dan filter
            if (searchInput) {
                searchInput.addEventListener('input', filterTable);
            }

            if (filterKelas) {
                filterKelas.addEventListener('change', filterTable);
            }

            if (btnResetFilter) {
                btnResetFilter.addEventListener('click', function() {
                    searchInput.value = '';
                    filterKelas.value = '';
                    filterTable();
                });
            }

            // Event listener untuk submit form
            formMapel.addEventListener('submit', function(e) {
                // Form akan di-submit secara normal
                // Validasi akan dilakukan oleh server
            });
        });
    </script>
</body>
</html>
