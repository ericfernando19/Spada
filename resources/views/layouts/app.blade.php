<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SPADA') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
            min-height: 100vh;
        }

        .header-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            box-shadow: 0 4px 20px rgba(30, 58, 138, 0.3);
        }

        .footer-gradient {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        }

        .nav-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .logout-btn {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(239, 68, 68, 0.3);
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(239, 68, 68, 0.4);
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.4);
        }

        .main-content {
            min-height: calc(100vh - 180px);
            background: transparent;
        }

        .page-header {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        }

        .logo-container {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .status-badge {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }

        .footer-link {
            transition: all 0.3s ease;
            position: relative;
        }

        .footer-link:hover {
            color: #ffffff;
            transform: translateY(-1px);
        }

        .footer-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #3b82f6;
            transition: width 0.3s ease;
        }

        .footer-link:hover::after {
            width: 100%;
        }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen flex flex-col">

        <!-- Navigation Header -->
        <header class="header-gradient text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <!-- Logo & Brand -->
                    <div class="flex items-center space-x-4">
                        <div class="logo-container p-3 rounded-2xl">
                            <i class="fas fa-graduation-cap text-2xl text-white"></i>
                        </div>
                        <div>
                            <a href="{{ route('admin.dashboard') }}"
                               class="text-white font-bold text-2xl hover:text-blue-100 transition-colors duration-300">
                                SPADA
                            </a>
                            <p class="text-blue-100 text-sm hidden sm:block mt-1">
                                <i class="fas fa-rocket mr-1"></i>
                                Sistem Pembelajaran Digital Terpadu
                            </p>
                        </div>
                    </div>

                    <!-- User Info & Logout -->
                    <div class="flex items-center space-x-4">
                        <div class="nav-card rounded-2xl px-4 py-2 hidden md:flex items-center space-x-3">
                            <div class="user-avatar">
                                {{ substr(Auth::user()->nama ?? Auth::user()->email, 0, 1) }}
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-white text-sm">
                                    {{ Auth::user()->nama ?? Auth::user()->email }}
                                </p>
                                <p class="text-blue-100 text-xs flex items-center">
                                    <i class="fas fa-user-shield mr-1"></i>
                                    {{ ucfirst(Auth::user()->role) }}
                                </p>
                            </div>
                        </div>

                        {{-- <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                    class="logout-btn text-white px-4 py-2.5 rounded-xl font-semibold flex items-center space-x-2 transition-all duration-300">
                                <i class="fas fa-sign-out-alt"></i>
                                <span class="hidden sm:inline">Keluar</span>
                            </button>
                        </form> --}}
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Header -->
        @isset($header)
            <div class="page-header">
                <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="flex items-center space-x-4">
                            {{ $header }}
                        </div>

                        <!-- Quick Actions & Status -->
                        <div class="flex items-center space-x-4">
                            <span class="status-badge inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold text-white">
                                <i class="fas fa-circle animate-pulse mr-1.5"></i>
                                System Online
                            </span>
                            <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1.5 rounded-lg">
                                <i class="far fa-clock mr-1.5"></i>
                                <span class="current-time">{{ now()->format('d M Y, H:i') }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endisset

        <!-- Main Content -->
        <main class="flex-1 main-content">
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>

        <!-- Footer -->
        <footer class="footer-gradient text-white">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <!-- Copyright & Info -->
                    <div class="flex items-center space-x-3">
                        <div class="bg-blue-500/20 p-2 rounded-lg">
                            <i class="fas fa-graduation-cap text-blue-300 text-lg"></i>
                        </div>
                        <div>
                            <p class="text-blue-100 font-medium">
                                &copy; {{ date('Y') }} SPADA Education System
                            </p>
                            <p class="text-blue-200 text-xs mt-1">
                                Empowering Digital Learning Experience
                            </p>
                        </div>
                    </div>

                    <!-- Footer Links -->
                    <div class="flex items-center space-x-6 text-sm">
                        <a href="#" class="footer-link text-blue-200 flex items-center space-x-1">
                            <i class="fas fa-shield-alt text-xs"></i>
                            <span>Privacy</span>
                        </a>
                        <a href="#" class="footer-link text-blue-200 flex items-center space-x-1">
                            <i class="fas fa-file-contract text-xs"></i>
                            <span>Terms</span>
                        </a>
                        <a href="#" class="footer-link text-blue-200 flex items-center space-x-1">
                            <i class="fas fa-headset text-xs"></i>
                            <span>Support</span>
                        </a>
                        <a href="#" class="footer-link text-blue-200 flex items-center space-x-1">
                            <i class="fas fa-envelope text-xs"></i>
                            <span>Contact</span>
                        </a>
                    </div>
                </div>

                <!-- Version & Credits -->
                <div class="mt-4 pt-4 border-t border-blue-700/30 flex flex-col sm:flex-row justify-between items-center space-y-2 sm:space-y-0">
                    <span class="text-blue-300 text-xs">
                        <i class="fas fa-code-branch mr-1"></i>
                        Version 2.1.0 • Production Ready
                    </span>
                    <span class="text-blue-400 text-xs flex items-center">
                        Built with <i class="fas fa-heart text-red-400 mx-1.5 animate-pulse"></i>
                        for Better Education
                    </span>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Update waktu real-time
        function updateTime() {
            const now = new Date();
            const options = {
                day: '2-digit',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            };
            const timeElements = document.querySelectorAll('.current-time');
            const timeString = now.toLocaleDateString('id-ID', options);

            timeElements.forEach(element => {
                element.textContent = timeString;
            });
        }

        // Update waktu setiap 30 detik
        setInterval(updateTime, 30000);
        updateTime(); // Initial call

        // Smooth scrolling untuk anchor links
        document.addEventListener('DOMContentLoaded', function() {
            const anchorLinks = document.querySelectorAll('a[href^="#"]');
            anchorLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Add hover effects to interactive elements
            const interactiveElements = document.querySelectorAll('button, a, .nav-card');
            interactiveElements.forEach(element => {
                element.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-1px)';
                });
                element.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>
