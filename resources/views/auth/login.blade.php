<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SPADA Sekolah</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            min-height: 100vh;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 2rem;
            text-align: center;
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

        .login-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
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

        .alert-animation {
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .decoration-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .circle-1 {
            width: 200px;
            height: 200px;
            top: -100px;
            right: -100px;
        }

        .circle-2 {
            width: 150px;
            height: 150px;
            bottom: -75px;
            left: -75px;
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
    </style>
</head>
<body class="flex justify-center items-center min-h-screen p-4">
    <!-- Background Decoration -->
    <div class="decoration-circle circle-1"></div>
    <div class="decoration-circle circle-2"></div>

    <!-- Login Container -->
    <div class="login-container w-full max-w-md relative z-10">
        <!-- Header -->
        <div class="login-header">
            <div class="mx-auto w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mb-4 pulse-animation">
                <i class="fas fa-graduation-cap text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold">SPADA Sekolah</h1>
            <p class="text-green-100 mt-2">Sistem Pembelajaran Digital Terpadu</p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login.store') }}" class="p-8">
            @csrf

            <!-- Alert Error -->
            @if(session('error'))
                <div class="alert-animation mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-start">
                    <i class="fas fa-exclamation-circle text-red-500 mt-1 mr-3"></i>
                    <div>
                        <h4 class="font-medium text-red-800">Login Gagal</h4>
                        <p class="text-red-600 text-sm mt-1">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <!-- Username Field -->
            <div class="floating-label">
                <input type="text"
                       name="username"
                       class="form-input"
                       placeholder=" "
                       required
                       autocomplete="username">
                <label for="username">
                    <i class="fas fa-user mr-2"></i>
                    Username (NISN/NIP/Email)
                </label>
                <div class="input-icon">
                    <i class="fas fa-user"></i>
                </div>
            </div>

            <!-- Password Field -->
            <div class="floating-label">
                <input type="password"
                       name="password"
                       class="form-input"
                       placeholder=" "
                       required
                       autocomplete="current-password">
                <label for="password">
                    <i class="fas fa-lock mr-2"></i>
                    Password
                </label>
                <div class="input-icon">
                    <i class="fas fa-lock"></i>
                </div>
            </div>

            <!-- Remember Me & Forgot Password -->
            {{-- <div class="flex justify-between items-center mb-6">
                <label class="flex items-center text-sm text-gray-600">
                    <input type="checkbox" class="rounded border-gray-300 text-green-500 focus:ring-green-500 mr-2">
                    Ingat saya
                </label>
                <a href="#" class="text-sm text-green-600 hover:text-green-700 font-medium">
                    Lupa password?
                </a>
            </div> --}}

            <!-- Login Button -->
            <button type="submit" class="login-btn mb-6">
                <i class="fas fa-sign-in-alt mr-2"></i>
                Masuk ke Sistem
            </button>

            <!-- Divider -->
            {{-- <div class="relative flex items-center justify-center mb-6">
                <div class="border-t border-gray-200 w-full"></div>
                <span class="absolute bg-white px-3 text-sm text-gray-500">atau</span>
            </div> --}}

            <!-- Alternative Login Methods -->
            {{-- <div class="grid grid-cols-2 gap-3 mb-6">
                <button type="button" class="flex items-center justify-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fab fa-google text-red-500 mr-2"></i>
                    <span class="text-sm font-medium">Google</span>
                </button>
                <button type="button" class="flex items-center justify-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-envelope text-blue-500 mr-2"></i>
                    <span class="text-sm font-medium">Email</span>
                </button>
            </div> --}}

            <!-- Help Text -->
            {{-- <div class="text-center text-sm text-gray-500">
                Butuh bantuan?
                <a href="#" class="text-green-600 hover:text-green-700 font-medium">Hubungi Administrator</a>
            </div> --}}
        </form>

        <!-- Footer -->
        <div class="border-t border-gray-100 p-4 text-center text-xs text-gray-500">
            <p>© 2025 SPADA Sekolah.</p>
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

            // Add loading state to login button
            const loginForm = document.querySelector('form');
            loginForm.addEventListener('submit', function() {
                const button = this.querySelector('button[type="submit"]');
                button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
                button.disabled = true;
            });
        });
    </script>
</body>
</html>
