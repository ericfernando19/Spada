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
            background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%);
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

        .kelas-badge {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
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
        </div>

        <!-- Main Content -->
        <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                <!-- Card Header -->
                <div class="border-b border-gray-100 p-6">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
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
                            <a href="{{ route('admin.mapel.create') }}"
                               class="btn-primary inline-flex items-center px-4 py-3 rounded-xl text-white font-semibold shadow transition duration-150">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Mapel
                            </a>
                            <a href="{{ route('kelas.index') }}"
                               class="btn-success inline-flex items-center px-4 py-3 rounded-xl text-white font-semibold shadow transition duration-150">
                                <i class="fas fa-school mr-2"></i>
                                Kelola Kelas
                            </a>
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

                    <!-- Tabel Mata Pelajaran -->
                    <div class="overflow-x-auto rounded-xl border border-gray-200">
                        <table class="w-full">
                            <thead>
                                <tr class="table-header">
                                    <th class="p-4 text-left text-white font-semibold rounded-tl-xl">
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
                                    <th class="p-4 text-center text-white font-semibold rounded-tr-xl w-48">
                                        <i class="fas fa-cogs mr-2"></i>
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($mapel as $m)
                                    <tr class="table-row group">
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
                                            <span class="kelas-badge inline-flex items-center">
                                                <i class="fas fa-graduation-cap mr-1.5 text-xs"></i>
                                                {{ $m->kelas->tingkat }} - {{ $m->kelas->nama_kelas }}
                                            </span>
                                        </td>
                                        <td class="p-4">
                                            <div class="flex justify-center space-x-2">
                                                <a href="{{ route('admin.mapel.edit', $m->id) }}"
                                                   class="btn-warning action-btn inline-flex items-center">
                                                    <i class="fas fa-edit mr-1"></i>
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.mapel.destroy', $m->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn-danger action-btn inline-flex items-center"
                                                            onclick="return confirm('Yakin ingin menghapus mata pelajaran {{ $m->nama_mapel }}?')">
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
                                                    <i class="fas fa-book text-gray-400 text-2xl"></i>
                                                </div>
                                                <h3 class="text-lg font-semibold text-gray-600 mb-2">Belum ada data mata pelajaran</h3>
                                                <p class="text-gray-500 text-sm mb-4">Mulai dengan menambahkan mata pelajaran pertama</p>
                                                <a href="{{ route('admin.mapel.create') }}"
                                                   class="btn-primary inline-flex items-center px-4 py-2 rounded-lg text-white font-semibold">
                                                    <i class="fas fa-plus mr-2"></i>
                                                    Tambah Mapel Pertama
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Info Footer -->
                    @if($mapel->count() > 0)
                        <div class="mt-4 flex justify-between items-center text-sm text-gray-500">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle mr-2 text-purple-500"></i>
                                <span>Menampilkan {{ $mapel->count() }} data mata pelajaran</span>
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
    </div>

    <script>
        // Konfirmasi hapus dengan sweet alert sederhana
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('form button[type="submit"]');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (!confirm('Yakin ingin menghapus data ini?')) {
                        e.preventDefault();
                    }
                });
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
        });
    </script>
</body>
</html>
