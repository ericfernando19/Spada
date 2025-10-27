<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Guru</title>
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

        .form-input {
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        .form-input:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
            outline: none;
        }

        .floating-label {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .floating-label label {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
            color: #6b7280;
            transition: all 0.3s ease;
            pointer-events: none;
            background: white;
            padding: 0 0.25rem;
        }

        .floating-label input:focus + label,
        .floating-label input:not(:placeholder-shown) + label {
            top: 0;
            font-size: 0.75rem;
            color: #10b981;
            font-weight: 500;
        }

        .input-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        .form-section {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
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
                        <h1 class="text-3xl font-bold">Tambah Data Guru</h1>
                        <p class="mt-2 text-blue-100">Tambah guru baru ke dalam sistem</p>
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
        <div class="py-8 max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                <!-- Card Header -->
                <div class="border-b border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-xl bg-green-100 text-green-600 mr-4">
                            <i class="fas fa-user-plus text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Form Tambah Guru</h2>
                            <p class="text-gray-600 text-sm">Isi data lengkap guru baru</p>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('guru.store') }}" method="POST" class="p-6">
                    @csrf

                    <!-- Informasi Pribadi Section -->
                    <div class="form-section">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-user-circle text-green-500 mr-2"></i>
                            <h3 class="font-semibold text-gray-800">Informasi Pribadi</h3>
                        </div>

                        <!-- Nama -->
                        <div class="floating-label">
                            <input type="text"
                                   name="nama"
                                   class="form-input"
                                   placeholder=" "
                                   required>
                            <label for="nama">
                                <i class="fas fa-user mr-2"></i>
                                Nama Lengkap
                            </label>
                            <div class="input-icon">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>

                        <!-- NIP -->
                        <div class="floating-label">
                            <input type="text"
                                   name="nip"
                                   class="form-input"
                                   placeholder=" "
                                   required>
                            <label for="nip">
                                <i class="fas fa-id-card mr-2"></i>
                                NIP
                            </label>
                            <div class="input-icon">
                                <i class="fas fa-id-card"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Kontak & Pengajaran Section -->
                    <div class="form-section">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-address-book text-blue-500 mr-2"></i>
                            <h3 class="font-semibold text-gray-800">Kontak & Pengajaran</h3>
                        </div>

                        <!-- No HP -->
                        <div class="floating-label">
                            <input type="text"
                                   name="no_hp"
                                   class="form-input"
                                   placeholder=" "
                                   placeholder="Contoh: 081234567890">
                            <label for="no_hp">
                                <i class="fas fa-phone mr-2"></i>
                                No HP
                            </label>
                            <div class="input-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                        </div>

                        <!-- Mata Pelajaran -->
                        <div class="floating-label">
                            <input type="text"
                                   name="mata_pelajaran"
                                   class="form-input"
                                   placeholder=" "
                                   required>
                            <label for="mata_pelajaran">
                                <i class="fas fa-book mr-2"></i>
                                Mata Pelajaran
                            </label>
                            <div class="input-icon">
                                <i class="fas fa-book"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Form Tips -->
                    <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                            <div>
                                <h4 class="font-medium text-blue-800 text-sm">Tips Pengisian</h4>
                                <ul class="text-blue-700 text-sm mt-1 list-disc list-inside space-y-1">
                                    <li>Pastikan NIP sudah benar dan belum terdaftar</li>
                                    <li>No HP digunakan untuk komunikasi penting</li>
                                    <li>Mata pelajaran sesuai dengan kurikulum</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex flex-col sm:flex-row justify-between gap-4 mt-8">
                        <a href="{{ route('guru.index') }}"
                           class="btn-secondary inline-flex items-center justify-center px-6 py-3 rounded-xl text-white font-semibold shadow transition duration-150 order-2 sm:order-1">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Daftar
                        </a>
                        <button type="submit"
                                class="btn-primary inline-flex items-center justify-center px-6 py-3 rounded-xl text-white font-semibold shadow transition duration-150 order-1 sm:order-2">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Data Guru
                        </button>
                    </div>
                </form>
            </div>

            <!-- Quick Stats -->
            <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
                {{-- <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-2 rounded-lg bg-green-100 text-green-600 mr-3">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Guru</p>
                            <p class="text-lg font-bold text-gray-800">{{ $totalGuru ?? '0' }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-2 rounded-lg bg-blue-100 text-blue-600 mr-3">
                            <i class="fas fa-book"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Mata Pelajaran</p>
                            <p class="text-lg font-bold text-gray-800">{{ $totalMapel ?? '12' }}</p>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-2 rounded-lg bg-purple-100 text-purple-600 mr-3">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Guru Baru</p>
                            <p class="text-lg font-bold text-gray-800">+1</p>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    <script>
        // Animasi untuk form inputs
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.form-input');

            inputs.forEach(input => {
                // Add focus effect
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-green-500', 'ring-opacity-20');
                });

                // Remove focus effect
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-green-500', 'ring-opacity-20');
                });

                // Auto fill detection for floating labels
                input.addEventListener('input', function() {
                    if (this.value !== '') {
                        this.classList.add('has-value');
                    } else {
                        this.classList.remove('has-value');
                    }
                });
            });

            // Form submission loading state
            const form = document.querySelector('form');
            form.addEventListener('submit', function() {
                const button = this.querySelector('button[type="submit"]');
                button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
                button.disabled = true;
            });
        });
    </script>
</body>
</html>
