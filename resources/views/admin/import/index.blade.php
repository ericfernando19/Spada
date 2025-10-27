<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Akun Guru & Siswa</title>
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

        .btn-blue {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            transition: all 0.3s ease;
        }

        .btn-blue:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
        }

        .btn-green {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            transition: all 0.3s ease;
        }

        .btn-green:hover {
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

        .table-header-blue {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
        }

        .table-header-green {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .table-row:hover {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
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

        .file-input {
            border: 2px dashed #d1d5db;
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        .file-input:hover {
            border-color: #3b82f6;
            background: #f0f9ff;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
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
                        <h1 class="text-3xl font-bold">Import Akun Guru & Siswa</h1>
                        <p class="mt-2 text-blue-100">Import data massal menggunakan file Excel</p>
                    </div>
                    <div class="flex items-center space-x-4 bg-white/10 backdrop-blur-sm rounded-xl p-3">
                        <div class="user-avatar bg-gradient-to-r from-cyan-500 to-blue-500">
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
        <div class="py-8 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Tombol Kembali -->
                <div class="mb-6">
                    <a href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-150">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>      
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                <!-- Card Header -->
                <div class="border-b border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-xl bg-pink-100 text-pink-600 mr-4">
                            <i class="fas fa-file-import text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Import Data Massal</h2>
                            <p class="text-gray-600 text-sm">Upload file Excel untuk import data guru dan siswa sekaligus</p>
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

                    <!-- Import Forms Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Import Guru -->
                        <div class="form-section border border-blue-200 rounded-xl p-6 bg-blue-50">
                            <div class="flex items-center mb-4">
                                <div class="p-3 rounded-lg bg-blue-100 text-blue-600 mr-3">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <h3 class="font-semibold text-gray-800">Import Data Guru</h3>
                            </div>

                            <form action="{{ route('import.guru') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="file-input mb-4 cursor-pointer" onclick="document.getElementById('fileGuru').click()">
                                    <i class="fas fa-file-excel text-3xl text-green-500 mb-2"></i>
                                    <p class="text-gray-600 mb-1">Klik untuk memilih file Excel</p>
                                    <p class="text-gray-500 text-sm">Format: Nama | NIP</p>
                                    <input type="file" name="file" id="fileGuru" required class="hidden" accept=".xlsx,.xls">
                                </div>
                                <button type="submit" class="btn-blue w-full inline-flex items-center justify-center px-4 py-3 rounded-xl text-white font-semibold shadow transition duration-150">
                                    <i class="fas fa-upload mr-2"></i>
                                    Import Data Guru
                                </button>
                            </form>
                        </div>

                        <!-- Import Siswa -->
                        <div class="form-section border border-green-200 rounded-xl p-6 bg-green-50">
                            <div class="flex items-center mb-4">
                                <div class="p-3 rounded-lg bg-green-100 text-green-600 mr-3">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                                <h3 class="font-semibold text-gray-800">Import Data Siswa</h3>
                            </div>

                            <form action="{{ route('import.siswa') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="file-input mb-4 cursor-pointer" onclick="document.getElementById('fileSiswa').click()">
                                    <i class="fas fa-file-excel text-3xl text-green-500 mb-2"></i>
                                    <p class="text-gray-600 mb-1">Klik untuk memilih file Excel</p>
                                    <p class="text-gray-500 text-sm">Format: Nama | NISN</p>
                                    <input type="file" name="file" id="fileSiswa" required class="hidden" accept=".xlsx,.xls">
                                </div>
                                <button type="submit" class="btn-green w-full inline-flex items-center justify-center px-4 py-3 rounded-xl text-white font-semibold shadow transition duration-150">
                                    <i class="fas fa-upload mr-2"></i>
                                    Import Data Siswa
                                </button>
                            </form>
                        </div>
                    </div>

                    <hr class="my-8 border-gray-200">

                    <!-- Data Guru -->
                    <div class="mb-10">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center">
                                <div class="p-2 rounded-lg bg-blue-100 text-blue-600 mr-3">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <h3 class="text-xl font-bold text-blue-700">Daftar Guru</h3>
                            </div>
                            <span class="text-sm text-gray-500 bg-blue-50 px-3 py-1 rounded-full">
                                {{ $gurus->count() }} data guru
                            </span>
                        </div>

                        <div class="overflow-x-auto rounded-xl border border-gray-200">
                            <table class="w-full">
                                <thead>
                                    <tr class="table-header-blue">
                                        <th class="p-4 text-center text-white font-semibold rounded-tl-xl">
                                            <i class="fas fa-hashtag mr-2"></i>
                                            No
                                        </th>
                                        <th class="p-4 text-left text-white font-semibold">
                                            <i class="fas fa-user mr-2"></i>
                                            Nama
                                        </th>
                                        <th class="p-4 text-left text-white font-semibold">
                                            <i class="fas fa-id-card mr-2"></i>
                                            Username
                                        </th>
                                        <th class="p-4 text-center text-white font-semibold rounded-tr-xl w-40">
                                            <i class="fas fa-cogs mr-2"></i>
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse($gurus as $index => $guru)
                                        <tr class="table-row group">
                                            <td class="p-4 text-center text-gray-600 font-medium">
                                                {{ $index + 1 }}
                                            </td>
                                            <td class="p-4">
                                                <div class="flex items-center">
                                                    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold mr-3">
                                                        {{ substr($guru->nama, 0, 1) }}
                                                    </div>
                                                    <span class="font-medium text-gray-800">{{ $guru->nama }}</span>
                                                </div>
                                            </td>
                                            <td class="p-4">
                                                <span class="font-mono text-gray-700 bg-gray-100 px-2 py-1 rounded text-sm">
                                                    {{ $guru->username }}
                                                </span>
                                            </td>
                                            <td class="p-4">
                                                <div class="flex justify-center space-x-2">
                                                    <a href="{{ route('user.edit', $guru->id) }}"
                                                       class="btn-warning action-btn inline-flex items-center">
                                                        <i class="fas fa-edit mr-1"></i>
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('user.destroy', $guru->id) }}" method="POST" class="inline">
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
                                            <td colspan="4" class="p-8 text-center empty-state">
                                                <div class="flex flex-col items-center justify-center py-4">
                                                    <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-3">
                                                        <i class="fas fa-chalkboard-teacher text-gray-400 text-xl"></i>
                                                    </div>
                                                    <h4 class="text-lg font-semibold text-gray-600 mb-1">Belum ada data guru</h4>
                                                    <p class="text-gray-500 text-sm">Import data guru menggunakan form di atas</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Data Siswa -->
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center">
                                <div class="p-2 rounded-lg bg-green-100 text-green-600 mr-3">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                                <h3 class="text-xl font-bold text-green-700">Daftar Siswa</h3>
                            </div>
                            <span class="text-sm text-gray-500 bg-green-50 px-3 py-1 rounded-full">
                                {{ $siswas->count() }} data siswa
                            </span>
                        </div>

                        <div class="overflow-x-auto rounded-xl border border-gray-200">
                            <table class="w-full">
                                <thead>
                                    <tr class="table-header-green">
                                        <th class="p-4 text-center text-white font-semibold rounded-tl-xl">
                                            <i class="fas fa-hashtag mr-2"></i>
                                            No
                                        </th>
                                        <th class="p-4 text-left text-white font-semibold">
                                            <i class="fas fa-user mr-2"></i>
                                            Nama
                                        </th>
                                        <th class="p-4 text-left text-white font-semibold">
                                            <i class="fas fa-id-card mr-2"></i>
                                            Username
                                        </th>
                                        <th class="p-4 text-center text-white font-semibold rounded-tr-xl w-40">
                                            <i class="fas fa-cogs mr-2"></i>
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse($siswas as $index => $siswa)
                                        <tr class="table-row group">
                                            <td class="p-4 text-center text-gray-600 font-medium">
                                                {{ $index + 1 }}
                                            </td>
                                            <td class="p-4">
                                                <div class="flex items-center">
                                                    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-green-500 to-green-600 flex items-center justify-center text-white font-bold mr-3">
                                                        {{ substr($siswa->nama, 0, 1) }}
                                                    </div>
                                                    <span class="font-medium text-gray-800">{{ $siswa->nama }}</span>
                                                </div>
                                            </td>
                                            <td class="p-4">
                                                <span class="font-mono text-gray-700 bg-gray-100 px-2 py-1 rounded text-sm">
                                                    {{ $siswa->username }}
                                                </span>
                                            </td>
                                            <td class="p-4">
                                                <div class="flex justify-center space-x-2">
                                                    <a href="{{ route('user.edit', $siswa->id) }}"
                                                       class="btn-warning action-btn inline-flex items-center">
                                                        <i class="fas fa-edit mr-1"></i>
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('user.destroy', $siswa->id) }}" method="POST" class="inline">
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
                                            <td colspan="4" class="p-8 text-center empty-state">
                                                <div class="flex flex-col items-center justify-center py-4">
                                                    <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-3">
                                                        <i class="fas fa-user-graduate text-gray-400 text-xl"></i>
                                                    </div>
                                                    <h4 class="text-lg font-semibold text-gray-600 mb-1">Belum ada data siswa</h4>
                                                    <p class="text-gray-500 text-sm">Import data siswa menggunakan form di atas</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInputs = document.querySelectorAll('input[type="file"]');

        fileInputs.forEach(input => {
            input.addEventListener('change', function() {
                const fileName = this.files[0]?.name || 'Tidak ada file dipilih';
                const parent = this.parentElement;
                const textElement = parent.querySelector('p:first-of-type');
                if (textElement) {
                    textElement.textContent = fileName;
                    textElement.classList.add('text-blue-600', 'font-medium');
                }
            });
        });

        // ✅ Konfirmasi hanya untuk tombol hapus
        const deleteButtons = document.querySelectorAll('form button.btn-danger');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                if (!confirm('Yakin ingin menghapus data ini?')) {
                    e.preventDefault();
                }
            });
        });

        // Animasi hover baris tabel
        const tableRows = document.querySelectorAll('.table-row');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.01)';
            });
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });
    });
</script>

</body>
</html>
