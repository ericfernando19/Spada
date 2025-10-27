<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas</title>
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

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
            color: white;
        }

        .tingkat-option {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            margin: 0.25rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tingkat-option:hover {
            border-color: #10b981;
            background: #f0fdf4;
        }

        .tingkat-option.selected {
            border-color: #10b981;
            background: #10b981;
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
                        <h1 class="text-3xl font-bold">Tambah Kelas Baru</h1>
                        <p class="mt-2 text-blue-100">Tambahkan kelas baru ke dalam sistem</p>
                    </div>
                    <div class="flex items-center space-x-4 bg-white/10 backdrop-blur-sm rounded-xl p-3">
                        <div class="user-avatar bg-gradient-to-r from-cyan-500 to-blue-500">
                            {{ substr(Auth::user()->nama ?? 'A', 0, 1) }}
                        </div>
                        <div>
                            <p class="font-semibold">{{ Auth::user()->nama ?? 'Admin' }}</p>
                            <div class="flex items-center text-sm text-blue-100">
                                <span class="inline-block w-2 h-2 rounded-full bg-green-400 mr-2"></span>
                                <span>{{ ucfirst(Auth::user()->role ?? 'Admin') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="py-8 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                <!-- Card Header -->
                <div class="border-b border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-xl bg-green-100 text-green-600 mr-4">
                            <i class="fas fa-plus text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Form Tambah Kelas</h2>
                            <p class="text-gray-600 text-sm">Isi data lengkap kelas baru</p>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('kelas.store') }}" method="POST" class="p-6">
                    @csrf

                    <!-- Notifikasi Error -->
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-start">
                            <i class="fas fa-exclamation-circle text-red-500 mt-1 mr-3"></i>
                            <div>
                                <h4 class="font-semibold text-red-800 text-sm">Terjadi Kesalahan</h4>
                                <ul class="text-red-700 text-sm mt-1 list-disc list-inside space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <!-- Informasi Kelas Section -->
                    <div class="form-section">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-school text-green-500 mr-2"></i>
                            <h3 class="font-semibold text-gray-800">Informasi Kelas</h3>
                        </div>

                        <!-- Nama Kelas -->
                        <div class="floating-label">
                            <input type="text"
                                   name="nama_kelas"
                                   id="nama_kelas"
                                   value="{{ old('nama_kelas') }}"
                                   class="form-input"
                                   placeholder=" "
                                   required>
                            <label for="nama_kelas">
                                <i class="fas fa-door-open mr-2"></i>
                                Nama Kelas
                            </label>
                            <div class="input-icon">
                                <i class="fas fa-door-open"></i>
                            </div>
                        </div>

                        <!-- Tingkat -->
                        <div class="floating-label">
                            <input type="text"
                                   name="tingkat"
                                   id="tingkat"
                                   value="{{ old('tingkat') }}"
                                   class="form-input"
                                   placeholder=" "
                                   required>
                            <label for="tingkat">
                                <i class="fas fa-layer-group mr-2"></i>
                                Tingkat (X, XI, XII)
                            </label>
                            <div class="input-icon">
                                <i class="fas fa-layer-group"></i>
                            </div>
                        </div>

                        <!-- Quick Select Tingkat -->
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Tingkat Cepat:</label>
                            <div class="flex flex-wrap gap-2">
                                <div class="tingkat-option" data-value="X">
                                    <i class="fas fa-1 mr-2"></i>
                                    Kelas X
                                </div>
                                <div class="tingkat-option" data-value="XI">
                                    <i class="fas fa-2 mr-2"></i>
                                    Kelas XI
                                </div>
                                <div class="tingkat-option" data-value="XII">
                                    <i class="fas fa-3 mr-2"></i>
                                    Kelas XII
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Tips -->
                    <div class="mb-6 p-4 bg-green-50 rounded-lg border border-green-200">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-green-500 mt-1 mr-3"></i>
                            <div>
                                <h4 class="font-medium text-green-800 text-sm">Tips Pengisian</h4>
                                <ul class="text-green-700 text-sm mt-1 list-disc list-inside space-y-1">
                                    <li>Nama kelas harus unik dan belum terdaftar</li>
                                    <li>Format tingkat: X, XI, atau XII</li>
                                    <li>Contoh nama kelas: "IPA 1", "IPS 2", "Bahasa 3"</li>
                                    <li>Pastikan data sudah benar sebelum disimpan</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex flex-col sm:flex-row justify-between gap-4 mt-8">
                        <a href="{{ route('kelas.index') }}"
                           class="btn-secondary inline-flex items-center justify-center px-6 py-3 rounded-xl text-white font-semibold shadow transition duration-150 order-2 sm:order-1">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Daftar
                        </a>
                        <button type="submit"
                                class="btn-primary inline-flex items-center justify-center px-6 py-3 rounded-xl text-white font-semibold shadow transition duration-150 order-1 sm:order-2">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Kelas
                        </button>
                    </div>
                </form>
            </div>

            <!-- Quick Stats -->
            {{-- <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-2 rounded-lg bg-green-100 text-green-600 mr-3">
                            <i class="fas fa-school"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Kelas</p>
                            <p class="text-lg font-bold text-gray-800">{{ $totalKelas ?? '0' }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-2 rounded-lg bg-blue-100 text-blue-600 mr-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Kapasitas</p>
                            <p class="text-lg font-bold text-gray-800">35 Siswa</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-2 rounded-lg bg-purple-100 text-purple-600 mr-3">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Kelas Baru</p>
                            <p class="text-lg font-bold text-gray-800">+1</p>
                        </div>
                    </div>
                </div>
            </div> --}}
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

            // Quick select untuk tingkat
            const tingkatOptions = document.querySelectorAll('.tingkat-option');
            const tingkatInput = document.getElementById('tingkat');

            tingkatOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Remove selected class from all options
                    tingkatOptions.forEach(opt => opt.classList.remove('selected'));
                    // Add selected class to clicked option
                    this.classList.add('selected');
                    // Set input value
                    tingkatInput.value = this.getAttribute('data-value');
                    // Trigger input event for floating label
                    tingkatInput.dispatchEvent(new Event('input'));
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
