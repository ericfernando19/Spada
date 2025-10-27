<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Guru</title>
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

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
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
            background-color: white;
            border-radius: 16px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            transform: translateY(-20px);
            transition: transform 0.3s ease;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .modal-overlay.active .modal-content {
            transform: translateY(0);
        }

        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: between;
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

        /* Search and Filter Styles */
        .search-filter-container {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e2e8f0;
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .search-input:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
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

        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .form-error {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.25rem;
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
                        <h1 class="text-3xl font-bold">Kelola Data Guru</h1>
                        <p class="mt-2 text-blue-100">Manajemen data guru dan pengajar</p>
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
                            <div class="p-3 rounded-xl bg-green-100 text-green-600 mr-4">
                                <i class="fas fa-chalkboard-teacher text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">Data Guru</h2>
                                <p class="text-gray-600 text-sm">Total {{ $gurus->count() }} guru terdaftar</p>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ route('admin.dashboard') }}"
                               class="btn-secondary inline-flex items-center px-4 py-3 rounded-xl text-white font-semibold shadow transition duration-150">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali
                            </a>
                            <button id="openAddModal"
                                    class="btn-primary inline-flex items-center px-4 py-3 rounded-xl text-white font-semibold shadow transition duration-150">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Guru
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Search and Filter Section -->
                <div class="search-filter-container">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="searchInput" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-search mr-1"></i> Cari Guru
                            </label>
                            <input type="text" id="searchInput" placeholder="Cari berdasarkan nama, NIP, atau mata pelajaran..."
                                   class="search-input">
                        </div>
                        <div>
                            <label for="filterMapel" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-filter mr-1"></i> Filter Mata Pelajaran
                            </label>
                            <input type="text" id="filterMapel" placeholder="Ketik mata pelajaran..."
                                   class="search-input">
                        </div>
                        <div class="flex items-end">
                            <button id="resetFilters"
                                    class="btn-secondary inline-flex items-center px-4 py-2 rounded-lg text-white font-medium w-full justify-center">
                                <i class="fas fa-refresh mr-2"></i>
                                Reset Filter
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

                    @if($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-red-400"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">
                                        Terdapat {{ $errors->count() }} kesalahan dalam pengisian form
                                    </h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul class="list-disc list-inside space-y-1">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Tabel Guru -->
                    <div class="overflow-x-auto rounded-xl border border-gray-200">
                        <table class="w-full" id="guruTable">
                            <thead>
                                <tr class="table-header">
                                    <th class="p-4 text-left text-white font-semibold rounded-tl-xl">
                                        <i class="fas fa-user mr-2"></i>
                                        Nama Guru
                                    </th>
                                    <th class="p-4 text-left text-white font-semibold">
                                        <i class="fas fa-id-card mr-2"></i>
                                        NIP
                                    </th>
                                    <th class="p-4 text-left text-white font-semibold">
                                        <i class="fas fa-phone mr-2"></i>
                                        No HP
                                    </th>
                                    <th class="p-4 text-left text-white font-semibold">
                                        <i class="fas fa-book mr-2"></i>
                                        Mata Pelajaran
                                    </th>
                                    <th class="p-4 text-center text-white font-semibold rounded-tr-xl w-48">
                                        <i class="fas fa-cogs mr-2"></i>
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100" id="guruTableBody">
                                @forelse($gurus as $guru)
                                    <tr class="table-row group" data-id="{{ $guru->id }}" data-nama="{{ $guru->nama }}"
                                        data-nip="{{ $guru->nip }}" data-no_hp="{{ $guru->no_hp }}"
                                        data-mata_pelajaran="{{ $guru->mata_pelajaran }}">
                                        <td class="p-4">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold mr-3">
                                                    {{ substr($guru->nama, 0, 1) }}
                                                </div>
                                                <span class="font-medium text-gray-800">{{ $guru->nama }}</span>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <span class="font-mono text-gray-700 bg-gray-100 px-2 py-1 rounded text-sm">
                                                {{ $guru->nip }}
                                            </span>
                                        </td>
                                        <td class="p-4">
                                            @if($guru->no_hp)
                                                <div class="flex items-center text-gray-700">
                                                    <i class="fas fa-phone text-green-500 mr-2"></i>
                                                    {{ $guru->no_hp }}
                                                </div>
                                            @else
                                                <span class="text-gray-400 italic">-</span>
                                            @endif
                                        </td>
                                        <td class="p-4">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-book-open mr-1"></i>
                                                {{ $guru->mata_pelajaran }}
                                            </span>
                                        </td>
                                        <td class="p-4">
                                            <div class="flex justify-center space-x-2">
                                                <button type="button"
                                                        class="btn-warning action-btn inline-flex items-center edit-btn"
                                                        data-id="{{ $guru->id }}">
                                                    <i class="fas fa-edit mr-1"></i>
                                                    Edit
                                                </button>
                                                <form action="{{ route('guru.destroy', $guru->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn-danger action-btn inline-flex items-center"
                                                            onclick="return confirm('Yakin ingin menghapus guru {{ $guru->nama }}?')">
                                                        <i class="fas fa-trash mr-1"></i>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-8 text-center empty-state">
                                            <div class="flex flex-col items-center justify-center py-8">
                                                <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                                    <i class="fas fa-chalkboard-teacher text-gray-400 text-2xl"></i>
                                                </div>
                                                <h3 class="text-lg font-semibold text-gray-600 mb-2">Belum ada data guru</h3>
                                                <p class="text-gray-500 text-sm mb-4">Mulai dengan menambahkan guru pertama Anda</p>
                                                <button id="openAddModalEmpty"
                                                        class="btn-primary inline-flex items-center px-4 py-2 rounded-lg text-white font-semibold">
                                                    <i class="fas fa-plus mr-2"></i>
                                                    Tambah Guru Pertama
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Info Footer -->
                    @if($gurus->count() > 0)
                        <div class="mt-4 flex justify-between items-center text-sm text-gray-500">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                                <span id="resultCount">Menampilkan {{ $gurus->count() }} data guru</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <button class="flex items-center text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-download mr-1"></i>
                                    Export
                                </button>
                                <button class="flex items-center text-gray-500 hover:text-gray-700">
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

    <!-- Modal Tambah/Edit Guru -->
    <div class="modal-overlay" id="guruModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-xl font-bold text-gray-800" id="modalTitle">Tambah Guru Baru</h3>
                <button type="button" class="close-modal">&times;</button>
            </div>
            <form id="guruForm" method="POST">
                @csrf
                <div id="methodField"></div>

                <div class="modal-body">
                    <div class="space-y-4">
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                            <input type="text" id="nama" name="nama" required
                                   class="form-input"
                                   placeholder="Masukkan nama lengkap guru"
                                   value="{{ old('nama') }}">
                            <p class="text-xs text-gray-500 mt-1">Wajib diisi</p>
                        </div>

                        <div>
                            <label for="nip" class="block text-sm font-medium text-gray-700 mb-1">NIP *</label>
                            <input type="text" id="nip" name="nip" required
                                   class="form-input"
                                   placeholder="Masukkan NIP guru"
                                   value="{{ old('nip') }}">
                            <p class="text-xs text-gray-500 mt-1">Wajib diisi</p>
                        </div>

                        <div>
                            <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                            <input type="tel" id="no_hp" name="no_hp"
                                   class="form-input"
                                   placeholder="Masukkan nomor HP guru"
                                   value="{{ old('no_hp') }}">
                            <p class="text-xs text-gray-500 mt-1">Opsional</p>
                        </div>

                        <div>
                            <label for="mata_pelajaran" class="block text-sm font-medium text-gray-700 mb-1">Mata Pelajaran *</label>
                            <input type="text" id="mata_pelajaran" name="mata_pelajaran" required
                                   class="form-input"
                                   placeholder="Masukkan mata pelajaran (contoh: Matematika, Bahasa Indonesia)"
                                   value="{{ old('mata_pelajaran') }}">
                            <p class="text-xs text-gray-500 mt-1">Wajib diisi</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="close-modal btn-secondary inline-flex items-center px-4 py-2 rounded-lg text-white font-medium">
                        Batal
                    </button>
                    <button type="submit" class="btn-primary inline-flex items-center px-4 py-2 rounded-lg text-white font-medium" id="submitBtn">
                        <i class="fas fa-save mr-2"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal Elements
            const modal = document.getElementById('guruModal');
            const openAddModalBtn = document.getElementById('openAddModal');
            const openAddModalEmptyBtn = document.getElementById('openAddModalEmpty');
            const closeModalBtns = document.querySelectorAll('.close-modal');
            const modalTitle = document.getElementById('modalTitle');
            const guruForm = document.getElementById('guruForm');
            const methodField = document.getElementById('methodField');
            const submitBtn = document.getElementById('submitBtn');

            // Search and Filter Elements
            const searchInput = document.getElementById('searchInput');
            const filterMapel = document.getElementById('filterMapel');
            const resetFiltersBtn = document.getElementById('resetFilters');
            const guruTableBody = document.getElementById('guruTableBody');
            const resultCount = document.getElementById('resultCount');
            const originalRows = Array.from(guruTableBody.querySelectorAll('tr'));

            // Open Modal for Adding
            openAddModalBtn.addEventListener('click', openAddModal);
            if (openAddModalEmptyBtn) {
                openAddModalEmptyBtn.addEventListener('click', openAddModal);
            }

            // Close Modal
            closeModalBtns.forEach(btn => {
                btn.addEventListener('click', closeModal);
            });

            // Close modal when clicking outside
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // Edit Button Event Listeners
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    openEditModal(id);
                });
            });

            // Search Functionality
            searchInput.addEventListener('input', filterTable);
            filterMapel.addEventListener('input', filterTable);
            resetFiltersBtn.addEventListener('click', resetFilters);

            // PERBAIKAN: Form submission dengan validasi sederhana
            guruForm.addEventListener('submit', function(e) {
                // Validasi form sebelum submit
                if (!validateForm()) {
                    e.preventDefault();
                    return false;
                }

                // Tampilkan loading state
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<div class="loading mr-2"></div> Menyimpan...';
                submitBtn.disabled = true;

                // Biarkan form submit normal setelah validasi
                return true;
            });

            // Functions
            function openAddModal() {
                modalTitle.textContent = 'Tambah Guru Baru';
                guruForm.reset();
                guruForm.action = "{{ route('guru.store') }}";
                methodField.innerHTML = '';
                submitBtn.innerHTML = '<i class="fas fa-save mr-2"></i> Simpan';
                submitBtn.disabled = false;

                // Clear error styles
                clearErrorStyles();

                modal.classList.add('active');

                // Focus ke field pertama
                setTimeout(() => {
                    document.getElementById('nama').focus();
                }, 300);
            }

            function openEditModal(id) {
                const row = document.querySelector(`tr[data-id="${id}"]`);
                if (!row) return;

                modalTitle.textContent = 'Edit Data Guru';

                // Isi form dengan data dari row
                document.getElementById('nama').value = row.getAttribute('data-nama');
                document.getElementById('nip').value = row.getAttribute('data-nip');
                document.getElementById('no_hp').value = row.getAttribute('data-no_hp') || '';
                document.getElementById('mata_pelajaran').value = row.getAttribute('data-mata_pelajaran');

                // Set action dan method untuk update
                guruForm.action = "{{ route('guru.update', '') }}/" + id;
                methodField.innerHTML = '@method("PUT")';
                submitBtn.innerHTML = '<i class="fas fa-save mr-2"></i> Update';
                submitBtn.disabled = false;

                // Clear error styles
                clearErrorStyles();

                modal.classList.add('active');

                // Focus ke field pertama
                setTimeout(() => {
                    document.getElementById('nama').focus();
                }, 300);
            }

            function closeModal() {
                modal.classList.remove('active');
            }

            function validateForm() {
                let isValid = true;

                // Clear previous errors
                clearErrorStyles();

                // Validasi Nama
                const nama = document.getElementById('nama').value.trim();
                if (!nama) {
                    showError('nama', 'Nama guru harus diisi');
                    isValid = false;
                }

                // Validasi NIP
                const nip = document.getElementById('nip').value.trim();
                if (!nip) {
                    showError('nip', 'NIP harus diisi');
                    isValid = false;
                }

                // Validasi Mata Pelajaran
                const mataPelajaran = document.getElementById('mata_pelajaran').value.trim();
                if (!mataPelajaran) {
                    showError('mata_pelajaran', 'Mata pelajaran harus diisi');
                    isValid = false;
                }

                return isValid;
            }

            function showError(fieldId, message) {
                const field = document.getElementById(fieldId);
                field.classList.add('form-error');

                // Create error message element
                let errorElement = field.parentNode.querySelector('.error-message');
                if (!errorElement) {
                    errorElement = document.createElement('div');
                    errorElement.className = 'error-message';
                    field.parentNode.appendChild(errorElement);
                }
                errorElement.textContent = message;
            }

            function clearErrorStyles() {
                const errorFields = document.querySelectorAll('.form-error');
                errorFields.forEach(field => {
                    field.classList.remove('form-error');
                });

                const errorMessages = document.querySelectorAll('.error-message');
                errorMessages.forEach(msg => {
                    msg.remove();
                });
            }

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const filterTerm = filterMapel.value.toLowerCase();

                let visibleCount = 0;

                originalRows.forEach(row => {
                    if (row.cells.length < 4) return; // Skip empty state row

                    const nama = row.getAttribute('data-nama').toLowerCase();
                    const nip = row.getAttribute('data-nip').toLowerCase();
                    const mataPelajaran = row.getAttribute('data-mata_pelajaran').toLowerCase();

                    const matchesSearch = nama.includes(searchTerm) ||
                                         nip.includes(searchTerm) ||
                                         mataPelajaran.includes(searchTerm);
                    const matchesFilter = !filterTerm || mataPelajaran.includes(filterTerm);

                    if (matchesSearch && matchesFilter) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Update result count
                if (resultCount) {
                    resultCount.textContent = `Menampilkan ${visibleCount} data guru`;
                }

                // Show empty state if no results
                const emptyStateRow = guruTableBody.querySelector('tr:last-child');
                if (emptyStateRow && emptyStateRow.cells.length === 1) {
                    if (visibleCount === 0 && (searchTerm || filterTerm)) {
                        emptyStateRow.style.display = '';
                        emptyStateRow.querySelector('td').innerHTML = `
                            <div class="flex flex-col items-center justify-center py-8">
                                <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                    <i class="fas fa-search text-gray-400 text-2xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-600 mb-2">Tidak ada hasil ditemukan</h3>
                                <p class="text-gray-500 text-sm mb-4">Coba ubah kata kunci pencarian atau filter</p>
                                <button id="resetFiltersFromEmpty"
                                        class="btn-primary inline-flex items-center px-4 py-2 rounded-lg text-white font-semibold">
                                    <i class="fas fa-refresh mr-2"></i>
                                    Reset Pencarian
                                </button>
                            </div>
                        `;

                        // Add event listener to the reset button in empty state
                        document.getElementById('resetFiltersFromEmpty').addEventListener('click', resetFilters);
                    } else if (visibleCount > 0) {
                        emptyStateRow.style.display = 'none';
                    }
                }
            }

            function resetFilters() {
                searchInput.value = '';
                filterMapel.value = '';
                filterTable();
            }

            // Konfirmasi hapus dengan sweet alert sederhana
            const deleteButtons = document.querySelectorAll('form button[type="submit"]');

            deleteButtons.forEach(button => {
                if (button.closest('form').action.includes('destroy')) {
                    button.addEventListener('click', function(e) {
                        if (!confirm('Yakin ingin menghapus data ini?')) {
                            e.preventDefault();
                        }
                    });
                }
            });

            // Animasi untuk rows
            const tableRows = document.querySelectorAll('.table-row');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.01)';
                });

                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });

            @if($errors->any())
                @if(old('_method') == 'PUT')
                    const editId = "{{ old('id') }}";
                    if (editId) {
                        setTimeout(() => {
                            openEditModal(editId);
                        }, 500);
                    }
                @else
                    setTimeout(() => {
                        openAddModal();
                    }, 500);
                @endif
            @endif
        });
    </script>
</body>
</html>
