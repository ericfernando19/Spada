<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
            min-height: 100vh;
        }

        .card-hover {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-card {
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #10b981, #3b82f6);
        }

        .menu-card {
            border-radius: 12px;
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .menu-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .menu-card:hover::after {
            transform: scaleX(1);
        }

        .bg-gradient-green {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .bg-gradient-blue {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }

        .bg-gradient-yellow {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .bg-gradient-purple {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        }

        .bg-gradient-red {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        .bg-gradient-pink {
            background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
        }

        .menu-card.green::after {
            background: linear-gradient(90deg, #10b981, #34d399);
        }

        .menu-card.blue::after {
            background: linear-gradient(90deg, #3b82f6, #60a5fa);
        }

        .menu-card.yellow::after {
            background: linear-gradient(90deg, #f59e0b, #fbbf24);
        }

        .menu-card.purple::after {
            background: linear-gradient(90deg, #8b5cf6, #a78bfa);
        }

        .menu-card.pink::after {
            background: linear-gradient(90deg, #ec4899, #f472b6);
        }

        .header-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
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

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        .logout-btn {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .logout-btn:hover {
            background: white !important;
            color: #ef4444 !important;
            border: 2px solid #ef4444;
            transform: scale(1.05);
        }

        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
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
                        <h1 class="text-3xl font-bold">Dashboard Admin</h1>
                        <p class="mt-2 text-blue-100">Selamat datang di panel administrasi</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <!-- User Profile dengan Dropdown -->
                        <div class="dropdown relative">
                            <div class="flex items-center space-x-3 bg-white/10 backdrop-blur-sm rounded-xl p-3 cursor-pointer">
                                <div class="user-avatar bg-gradient-to-r from-cyan-500 to-blue-500">
                                    {{ substr($user->nama ?? $user->email, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-semibold">{{ $user->nama ?? $user->email }}</p>
                                    <div class="flex items-center text-sm text-blue-100">
                                        <span class="inline-block w-2 h-2 rounded-full bg-green-400 mr-2"></span>
                                        <span>{{ ucfirst($user->role) }}</span>
                                    </div>
                                </div>
                                <i class="fas fa-chevron-down text-blue-100"></i>
                            </div>

                            <!-- Dropdown Menu -->
                            <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-10">
                                <div class="border-t my-1"></div>
                                <!-- Tombol Logout dalam Dropdown -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition-colors flex items-center">
                                        <i class="fas fa-sign-out-alt mr-2"></i>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Statistik -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
                <div class="stat-card bg-white rounded-xl p-6 card-hover">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-green-100 text-green-600 mr-4">
                            <i class="fas fa-chalkboard-teacher text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-gray-500 font-medium">Total Guru</h4>
                            <p class="mt-1 text-2xl font-bold text-green-600">{{ $totalGuru }}</p>
                        </div>
                    </div>
                </div>

                <div class="stat-card bg-white rounded-xl p-6 card-hover">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-blue-100 text-blue-600 mr-4">
                            <i class="fas fa-user-graduate text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-gray-500 font-medium">Total Siswa</h4>
                            <p class="mt-1 text-2xl font-bold text-blue-600">{{ $totalSiswa }}</p>
                        </div>
                    </div>
                </div>

                <div class="stat-card bg-white rounded-xl p-6 card-hover">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-purple-100 text-purple-600 mr-4">
                            <i class="fas fa-user-shield text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-gray-500 font-medium">Total Admin</h4>
                            <p class="mt-1 text-2xl font-bold text-purple-600">{{ $totalAdmin }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu Dashboard -->
            <div class="mb-10">
                <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-th-large text-green-500 mr-2"></i>
                    Menu Utama
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <a href="{{ route('guru.index') }}"
                       class="menu-card green bg-white rounded-xl p-5 card-hover flex flex-col items-center text-center">
                        <div class="p-4 rounded-full bg-gradient-green text-white mb-4 pulse-animation">
                            <i class="fas fa-chalkboard-teacher text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-lg text-gray-800">Kelola Guru</h3>
                        <p class="mt-2 text-sm text-gray-600">Manajemen data guru dan pengajar</p>
                        <div class="mt-4 text-green-500 font-medium flex items-center">
                            <span>Buka Modul</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </div>
                    </a>

                    <a href="{{ route('siswa.index') }}"
                       class="menu-card blue bg-white rounded-xl p-5 card-hover flex flex-col items-center text-center">
                        <div class="p-4 rounded-full bg-gradient-blue text-white mb-4">
                            <i class="fas fa-user-graduate text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-lg text-gray-800">Kelola Siswa</h3>
                        <p class="mt-2 text-sm text-gray-600">Manajemen data siswa dan peserta didik</p>
                        <div class="mt-4 text-blue-500 font-medium flex items-center">
                            <span>Buka Modul</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </div>
                    </a>

                    <a href="{{ route('admin.mapel.index') }}"
                       class="menu-card yellow bg-white rounded-xl p-5 card-hover flex flex-col items-center text-center">
                        <div class="p-4 rounded-full bg-gradient-yellow text-white mb-4">
                            <i class="fas fa-book text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-lg text-gray-800">Mapel & Kelas</h3>
                        <p class="mt-2 text-sm text-gray-600">Manajemen Mata Pelajaran & Kelas</p>
                        <div class="mt-4 text-yellow-500 font-medium flex items-center">
                            <span>Buka Modul</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </div>
                    </a>

                    <a href=""
                       class="menu-card purple bg-white rounded-xl p-5 card-hover flex flex-col items-center text-center">
                        <div class="p-4 rounded-full bg-gradient-purple text-white mb-4">
                            <i class="fas fa-chart-bar text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-lg text-gray-800">Laporan</h3>
                        <p class="mt-2 text-sm text-gray-600">Analisis dan laporan sistem</p>
                        <div class="mt-4 text-purple-500 font-medium flex items-center">
                            <span>Buka Modul</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </div>
                    </a>

                    <a href="{{ route('import.form') }}"
                       class="menu-card pink bg-white rounded-xl p-5 card-hover flex flex-col items-center text-center">
                        <div class="p-4 rounded-full bg-gradient-pink text-white mb-4">
                            <i class="fas fa-file-import text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-lg text-gray-800">Import Data</h3>
                        <p class="mt-2 text-sm text-gray-600">Import massal data guru & siswa</p>
                        <div class="mt-4 text-pink-500 font-medium flex items-center">
                            <span>Buka Modul</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Quick Actions & Logout -->
            {{-- <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Quick Actions -->
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-bolt text-yellow-500 mr-2"></i>
                        Akses Cepat
                    </h2>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <a href="{{ route('guru.create') }}" class="flex flex-col items-center p-4 rounded-lg bg-gray-50 hover:bg-green-50 transition-colors">
                            <i class="fas fa-user-plus text-green-500 text-xl mb-2"></i>
                            <span class="text-sm font-medium text-gray-700">Tambah Guru</span>
                        </a>
                        <a href="{{ route('siswa.create') }}" class="flex flex-col items-center p-4 rounded-lg bg-gray-50 hover:bg-blue-50 transition-colors">
                            <i class="fas fa-user-plus text-blue-500 text-xl mb-2"></i>
                            <span class="text-sm font-medium text-gray-700">Tambah Siswa</span>
                        </a>
                        <a href="{{ route('kelas.create') }}" class="flex flex-col items-center p-4 rounded-lg bg-gray-50 hover:bg-teal-50 transition-colors">
                            <i class="fas fa-school text-teal-500 text-xl mb-2"></i>
                            <span class="text-sm font-medium text-gray-700">Tambah Kelas</span>
                        </a>
                        <a href="{{ route('admin.mapel.create') }}" class="flex flex-col items-center p-4 rounded-lg bg-gray-50 hover:bg-yellow-50 transition-colors">
                            <i class="fas fa-book text-yellow-500 text-xl mb-2"></i>
                            <span class="text-sm font-medium text-gray-700">Tambah Mapel</span>
                        </a>
                    </div>
                </div> --}}

                <!-- Logout Card -->
                <div class="bg-gradient-red text-white rounded-xl shadow-sm p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center mb-4">
                            <div class="p-3 rounded-full bg-white/20 mr-4">
                                <i class="fas fa-sign-out-alt text-2xl"></i>
                            </div>
                            <h2 class="text-xl font-bold">Keluar Sistem</h2>
                        </div>
                        <p class="text-red-100 mb-6">
                            Jangan lupa untuk logout setelah selesai menggunakan sistem untuk keamanan akun Anda.
                        </p>
                    </div>

                    <!-- Tombol Logout Utama -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn w-full bg-white text-red-600 font-semibold py-3 rounded-lg flex items-center justify-center">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Logout Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-12 py-6 text-center text-gray-500 text-sm">
            <p>© 2025 Sistem Administrasi Sekolah. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Script untuk dropdown menu
        document.addEventListener('DOMContentLoaded', function() {
            const dropdowns = document.querySelectorAll('.dropdown');

            dropdowns.forEach(dropdown => {
                dropdown.addEventListener('mouseenter', function() {
                    this.querySelector('.dropdown-menu').style.opacity = '1';
                    this.querySelector('.dropdown-menu').style.visibility = 'visible';
                    this.querySelector('.dropdown-menu').style.transform = 'translateY(0)';
                });

                dropdown.addEventListener('mouseleave', function() {
                    this.querySelector('.dropdown-menu').style.opacity = '0';
                    this.querySelector('.dropdown-menu').style.visibility = 'hidden';
                    this.querySelector('.dropdown-menu').style.transform = 'translateY(-10px)';
                });
            });

            // Konfirmasi logout
            const logoutButtons = document.querySelectorAll('button[type="submit"]');
            logoutButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (this.closest('form').action.includes('logout')) {
                        if (!confirm('Apakah Anda yakin ingin logout?')) {
                            e.preventDefault();
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
