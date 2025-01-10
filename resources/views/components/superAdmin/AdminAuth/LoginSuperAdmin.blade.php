<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Portal | Don Macchiatos</title>
    <link rel="shortcut icon" href="/storage/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #FF8C00;
            --secondary: #FFA500;
            --accent: #E67E22;
            --light: #ECF0F1;
            --dark: #2C3E50;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            padding: 2.5rem 5rem;
            margin: 2rem;
        }

        .brand-logo {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 1.5rem;
        }

        .login-title {
            color: var(--dark);
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1.75rem;
        }

        .login-subtitle {
            color: #64748b;
            margin-bottom: 2rem;
            font-size: 1rem;
        }

        .form-label {
            color: var(--dark);
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 1.5px solid #e2e8f0;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(230, 126, 34, 0.1);
        }

        .input-group-text {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-right: none;
            color: #64748b;
        }

        .btn-primary {
            background: var(--accent);
            border: none;
            padding: 0.85rem 1.5rem;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background: #d35400;
            transform: translateY(-1px);
        }

        .branch-link {
            color: blue;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .branch-link:hover {
            color: #d35400;
        }

        .alert {
            border-radius: 8px;
            font-size: 0.9rem;
            border: none;
        }

        .alert-success {
            background: #def7ec;
            color: #03543f;
        }

        .alert-danger {
            background: #fde8e8;
            color: #9b1c1c;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.3s ease-out;
        }

        .mb-4 {
            margin-bottom: 1rem !important;
        }
    </style>
</head>

<body>
    @auth('admin')
        <div>
            @include('components.superAdmin.pages.dashboard')
            @yield('dashboard')
        </div>
    @else
        <div class="login-wrapper">
            <div class="login-card fade-in">
                <div class="text-center">
                    <img src="/storage/logo.png" alt="Don Macchiatos Logo" class="brand-logo">
                    <h1 class="login-title">Super Admin Portal</h1>
                    <p class="login-subtitle">Enter your credentials to access the dashboard</p>
                </div>

                <form id="loginForm" action="{{ route('superadmin.login') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" 
                                class="form-control @error('admin') is-invalid @enderror"
                                name="admin" 
                                required 
                                placeholder="Enter your username"
                                autofocus>
                        </div>
                        @error('admin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" 
                                class="form-control @error('password') is-invalid @enderror"
                                id="password" 
                                name="password" 
                                required 
                                placeholder="Enter your password">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                <i class="fas fa-eye-slash" id="passwordToggle"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-primary">
                            Sign In
                        </button>
                    </div>

                    <div class="text-center">
                        <a href="/" class="branch-link text-accent text-decoration-none">
                        <i class="fas fa-user-shield me-1"></i>
                            Return to Branch Admin
                        </a>
                    </div>
                </form>
            </div>

            <!-- Alerts -->
            @if(session('success') || session('error'))
                <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
                    @if(session('success'))
                        <div class="alert alert-success fade-in" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger fade-in" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            @endif
        </div>
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordToggle = document.getElementById('passwordToggle');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggle.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                passwordInput.type = 'password';
                passwordToggle.classList.replace('fa-eye', 'fa-eye-slash');
            }
        }

        // Auto-dismiss alerts
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-20px)';
                    setTimeout(() => alert.remove(), 300);
                }, 5000);
            });
        });
    </script>
</body>

</html>
