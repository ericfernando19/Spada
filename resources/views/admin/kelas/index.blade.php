<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kelas</title>
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

        .table-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .table-row:hover {
            background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
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

        .tingkat-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .tingkat-x { background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white; }
        .tingkat-xi { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; }
        .tingkat-xii { background: linear-gradient(135deg, #ec4899 0%, #db2777 100%); color: white; }

        .pagination-btn {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .pagination-btn:hover {
            background: #10b981;
            color: white;
            border-color: #10b981;
        }

        .pagination-active {
            background: #10b981;
            color: white;
            border-color: #10b981;
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
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            width: 90%;
            max-width: 500px;
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }

        .modal-overlay.active .modal-content {
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
            font-size: 1.25rem;
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
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            background-color: white;
            transition: all 0.2s;
        }

        .form-select:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        /* Filter Styles */
        .filter-section {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e2e8f0;
        }

        .filter-active {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border-color: #059669 !important;
        }

        .filter-reset {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .hidden-row {
            display: none !important;
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
                        <h1 class="text-3xl font-bold">Kelola Data Kelas</h1>
                        <p class="mt-2 text-blue-100">Manajemen data kelas dan tingkatan</p>
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
        </div>

        <!-- Main Content -->
        <div class="py-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                <!-- Card Header -->
                <div class="border-b border-gray-100 p-6">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-xl bg-green-100 text-green-600 mr-4">
                                <i class="fas fa-school text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">Data Kelas</h2>
                                <p class="text-gray-600 text-sm">Total <span id="totalKelas">{{ $kelas->total() }}</span> kelas terdaftar</p>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ route('admin.mapel.index') }}"
                               class="btn-secondary inline-flex items-center px-4 py-3 rounded-xl text-white font-semibold shadow transition duration-150">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali
                            </a>
                            <button id="openCreateModal"
                                    class="btn-primary inline-flex items-center px-4 py-3 rounded-xl text-white font-semibold shadow transition duration-150">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Kelas
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="filter-section">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-2">Filter Berdasarkan Tingkat</h3>
                            <div class="flex flex-wrap gap-2">
                                <button class="filter-btn px-4 py-2 rounded-lg transition-all duration-200 border border-gray-300 hover:shadow-md bg-white filter-active" data-tingkat="all">
                                    <i class="fas fa-layer-group mr-2"></i>Semua Tingkat
                                </button>
                                <button class="filter-btn px-4 py-2 rounded-lg transition-all duration-200 border border-gray-300 hover:shadow-md bg-white" data-tingkat="X">
                                    <i class="fas fa-graduation-cap mr-2"></i>Tingkat X
                                </button>
                                <button class="filter-btn px-4 py-2 rounded-lg transition-all duration-200 border border-gray-300 hover:shadow-md bg-white" data-tingkat="XI">
                                    <i class="fas fa-graduation-cap mr-2"></i>Tingkat XI
                                </button>
                                <button class="filter-btn px-4 py-2 rounded-lg transition-all duration-200 border border-gray-300 hover:shadow-md bg-white" data-tingkat="XII">
                                    <i class="fas fa-graduation-cap mr-2"></i>Tingkat XII
                                </button>
                            </div>
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

                    <!-- Tabel Kelas -->
                    <div class="overflow-x-auto rounded-xl border border-gray-200">
                        <table class="w-full">
                            <thead>
                                <tr class="table-header">
                                    <th class="p-4 text-center text-white font-semibold rounded-tl-xl">
                                        <i class="fas fa-hashtag mr-2"></i>
                                        No
                                    </th>
                                    <th class="p-4 text-left text-white font-semibold">
                                        <i class="fas fa-door-open mr-2"></i>
                                        Nama Kelas
                                    </th>
                                    <th class="p-4 text-center text-white font-semibold">
                                        <i class="fas fa-layer-group mr-2"></i>
                                        Tingkat
                                    </th>
                                    <th class="p-4 text-center text-white font-semibold rounded-tr-xl w-48">
                                        <i class="fas fa-cogs mr-2"></i>
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100" id="kelasTableBody">
                                @forelse($kelas as $i => $k)
                                    <tr class="table-row group kelas-data" data-tingkat="{{ $k->tingkat }}">
                                        <td class="p-4 text-center text-gray-600 font-medium">
                                            {{ $i + $kelas->firstItem() }}
                                        </td>
                                        <td class="p-4">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-green-500 to-green-600 flex items-center justify-center text-white font-bold mr-3">
                                                    {{ substr($k->nama_kelas, 0, 1) }}
                                                </div>
                                                <span class="font-medium text-gray-800">{{ $k->nama_kelas }}</span>
                                            </div>
                                        </td>
                                        <td class="p-4 text-center">
                                            @php
                                                $tingkatClass = 'tingkat-' . strtolower($k->tingkat);
                                            @endphp
                                            <span class="tingkat-badge {{ $tingkatClass }} inline-flex items-center">
                                                <i class="fas fa-graduation-cap mr-1.5 text-xs"></i>
                                                {{ $k->tingkat }}
                                            </span>
                                        </td>
                                        <td class="p-4">
                                            <div class="flex justify-center space-x-2">
                                                <button
                                                    class="btn-warning action-btn inline-flex items-center edit-btn"
                                                    data-id="{{ $k->id }}"
                                                    data-nama="{{ $k->nama_kelas }}"
                                                    data-tingkat="{{ $k->tingkat }}">
                                                    <i class="fas fa-edit mr-1"></i>
                                                    Edit
                                                </button>
                                                <form action="{{ route('kelas.destroy', $k->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn-danger action-btn inline-flex items-center delete-btn">
                                                        <i class="fas fa-trash mr-1"></i>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="p-8 text-center empty-state">
                                            <div class="flex flex-col items-center justify-center py-8">
                                                <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                                    <i class="fas fa-school text-gray-400 text-2xl"></i>
                                                </div>
                                                <h3 class="text-lg font-semibold text-gray-600 mb-2">Belum ada data kelas</h3>
                                                <p class="text-gray-500 text-sm mb-4">Mulai dengan menambahkan kelas pertama</p>
                                                <button id="openCreateModalEmpty"
                                                        class="btn-primary inline-flex items-center px-4 py-2 rounded-lg text-white font-semibold">
                                                    <i class="fas fa-plus mr-2"></i>
                                                    Tambah Kelas Pertama
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($kelas->hasPages())
                        <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="text-sm text-gray-600">
                                Menampilkan <span id="showingCount">{{ $kelas->firstItem() }} - {{ $kelas->lastItem() }}</span> dari <span id="totalCount">{{ $kelas->total() }}</span> kelas
                            </div>
                            <div class="flex space-x-2">
                                @if($kelas->onFirstPage())
                                    <span class="pagination-btn opacity-50 cursor-not-allowed">
                                        <i class="fas fa-chevron-left mr-2"></i>Sebelumnya
                                    </span>
                                @else
                                    <a href="{{ $kelas->previousPageUrl() }}" class="pagination-btn">
                                        <i class="fas fa-chevron-left mr-2"></i>Sebelumnya
                                    </a>
                                @endif

                                @foreach($kelas->getUrlRange(1, $kelas->lastPage()) as $page => $url)
                                    @if($page == $kelas->currentPage())
                                        <span class="pagination-btn pagination-active">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}" class="pagination-btn">{{ $page }}</a>
                                    @endif
                                @endforeach

                                @if($kelas->hasMorePages())
                                    <a href="{{ $kelas->nextPageUrl() }}" class="pagination-btn">
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
                    @if($kelas->count() > 0)
                        <div class="mt-4 flex justify-between items-center text-sm text-gray-500">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle mr-2 text-green-500"></i>
                                <span>Menampilkan <span id="displayCount">{{ $kelas->count() }}</span> data kelas</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <button class="flex items-center text-gray-500 hover:text-green-600 transition-colors">
                                    <i class="fas fa-download mr-1"></i>
                                    Export
                                </button>
                                <button class="flex items-center text-gray-500 hover:text-green-600 transition-colors">
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

    <!-- Modal Tambah Kelas -->
    <div id="createModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-lg font-semibold text-gray-800">Tambah Kelas Baru</h3>
                <button class="close-modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="createForm" action="{{ route('kelas.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kelas" class="form-label">Nama Kelas</label>
                        <input type="text" id="nama_kelas" name="nama_kelas" class="form-input" placeholder="Masukkan nama kelas" required>
                    </div>
                    <div class="form-group">
                        <label for="tingkat" class="form-label">Tingkat</label>
                        <select id="tingkat" name="tingkat" class="form-select" required>
                            <option value="">Pilih Tingkat</option>
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary inline-flex items-center px-4 py-2 rounded-lg text-white font-semibold close-modal">
                        Batal
                    </button>
                    <button type="submit" class="btn-primary inline-flex items-center px-4 py-2 rounded-lg text-white font-semibold">
                        <i class="fas fa-save mr-2"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Kelas -->
    <div id="editModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-lg font-semibold text-gray-800">Edit Data Kelas</h3>
                <button class="close-modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_nama_kelas" class="form-label">Nama Kelas</label>
                        <input type="text" id="edit_nama_kelas" name="nama_kelas" class="form-input" placeholder="Masukkan nama kelas" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_tingkat" class="form-label">Tingkat</label>
                        <select id="edit_tingkat" name="tingkat" class="form-select" required>
                            <option value="">Pilih Tingkat</option>
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary inline-flex items-center px-4 py-2 rounded-lg text-white font-semibold close-modal">
                        Batal
                    </button>
                    <button type="submit" class="btn-primary inline-flex items-center px-4 py-2 rounded-lg text-white font-semibold">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal functionality
            const createModal = document.getElementById('createModal');
            const editModal = document.getElementById('editModal');
            const openCreateModalBtn = document.getElementById('openCreateModal');
            const openCreateModalEmptyBtn = document.getElementById('openCreateModalEmpty');
            const closeModalBtns = document.querySelectorAll('.close-modal');
            const editButtons = document.querySelectorAll('.edit-btn');
            const deleteButtons = document.querySelectorAll('.delete-btn');
            const editForm = document.getElementById('editForm');

            // Filter functionality - PERBAIKAN DI SINI
            const filterBtns = document.querySelectorAll('.filter-btn');
            const resetFilterBtn = document.getElementById('resetFilter');
            const filterStatus = document.getElementById('filterStatus');
            const kelasTableBody = document.getElementById('kelasTableBody');
            const tableRows = document.querySelectorAll('.kelas-data'); // PERBAIKAN: gunakan class yang konsisten
            const displayCount = document.getElementById('displayCount');
            const showingCount = document.getElementById('showingCount');
            const totalCount = document.getElementById('totalCount');
            const totalKelas = document.getElementById('totalKelas');

            let currentFilter = 'all';

            // Open create modal
            function openCreateModal() {
                createModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            // Open edit modal
            function openEditModal(id, nama, tingkat) {
                editForm.action = `{{ route('kelas.update', '') }}/${id}`;
                document.getElementById('edit_nama_kelas').value = nama;
                document.getElementById('edit_tingkat').value = tingkat;
                editModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            // Close modal
            function closeModal() {
                createModal.classList.remove('active');
                editModal.classList.remove('active');
                document.body.style.overflow = 'auto';
            }

            // Filter table by tingkat - PERBAIKAN UTAMA
            function filterTable(tingkat) {
                currentFilter = tingkat;

                let visibleCount = 0;
                let currentNumber = 1;

                tableRows.forEach((row) => {
                    const rowTingkat = row.getAttribute('data-tingkat');

                    if (tingkat === 'all' || rowTingkat === tingkat) {
                        row.classList.remove('hidden-row');
                        visibleCount++;

                        // Update nomor urut
                        const firstCell = row.cells[0];
                        firstCell.textContent = currentNumber;
                        currentNumber++;
                    } else {
                        row.classList.add('hidden-row');
                    }
                });

                // Update counts
                updateCounts(visibleCount);

                // Update filter status
                updateFilterStatus(tingkat, visibleCount);

                // Enable/disable reset button
                resetFilterBtn.disabled = tingkat === 'all';
                resetFilterBtn.classList.toggle('opacity-50', tingkat === 'all');
                resetFilterBtn.classList.toggle('cursor-not-allowed', tingkat === 'all');

                // Update filter buttons appearance
                updateFilterButtons(tingkat);
            }

            // Update filter buttons appearance
            function updateFilterButtons(activeTingkat) {
                filterBtns.forEach(btn => {
                    const tingkat = btn.getAttribute('data-tingkat');
                    if (tingkat === activeTingkat) {
                        btn.classList.add('filter-active', 'text-white');
                        btn.classList.remove('border-gray-300', 'bg-white');
                    } else {
                        btn.classList.remove('filter-active', 'text-white');
                        btn.classList.add('border-gray-300', 'bg-white');
                    }
                });
            }

            // Update filter status text
            function updateFilterStatus(tingkat, count) {
                let statusText = '';
                switch(tingkat) {
                    case 'all':
                        statusText = `Menampilkan semua tingkat (${count} data)`;
                        break;
                    case 'X':
                        statusText = `Menampilkan tingkat X (${count} data)`;
                        break;
                    case 'XI':
                        statusText = `Menampilkan tingkat XI (${count} data)`;
                        break;
                    case 'XII':
                        statusText = `Menampilkan tingkat XII (${count} data)`;
                        break;
                }
                filterStatus.textContent = statusText;
            }

            // Update display counts
            function updateCounts(visibleCount) {
                displayCount.textContent = visibleCount;

                // Update showing count for pagination
                if (visibleCount > 0) {
                    showingCount.textContent = `1 - ${visibleCount}`;
                } else {
                    showingCount.textContent = '0 - 0';
                }
            }

            // Event listeners for modals
            openCreateModalBtn.addEventListener('click', openCreateModal);

            if (openCreateModalEmptyBtn) {
                openCreateModalEmptyBtn.addEventListener('click', openCreateModal);
            }

            closeModalBtns.forEach(btn => {
                btn.addEventListener('click', closeModal);
            });

            // Event listener untuk edit buttons menggunakan event delegation
            document.addEventListener('click', function(e) {
                if (e.target.closest('.edit-btn')) {
                    const btn = e.target.closest('.edit-btn');
                    const id = btn.getAttribute('data-id');
                    const nama = btn.getAttribute('data-nama');
                    const tingkat = btn.getAttribute('data-tingkat');
                    openEditModal(id, nama, tingkat);
                }
            });

            // Event listeners for filter buttons
            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const tingkat = this.getAttribute('data-tingkat');
                    filterTable(tingkat);
                });
            });

            // Event listener for reset filter
            resetFilterBtn.addEventListener('click', function() {
                filterTable('all');
            });

            // Event listeners for delete buttons
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (!confirm('Yakin ingin menghapus data ini?')) {
                        e.preventDefault();
                    }
                });
            });

            // Close modal when clicking outside
            [createModal, editModal].forEach(modal => {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeModal();
                    }
                });
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeModal();
                }
            });

            // Initialize filter
            updateFilterButtons('all');

            // Debug info
            console.log('Total rows found:', tableRows.length);
            tableRows.forEach(row => {
                console.log('Row data-tingkat:', row.getAttribute('data-tingkat'));
            });
        });
    </script>
</body>
</html>
