<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/storage/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"
        integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Don Macchiatos - Admin</title>
    <style>
        :root {
            --primary-orange: #FF8C00;
            --dark-black: #1a1a1a;
        }

        body {
            background-color: var(--dark-black);
            font-family: 'Poppins', sans-serif;
        }

        .hero-section {
            min-height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                url('/storage/hero-bg.jpg') center/cover;
        }

        .text-orange {
            color: #FFA500 !important;
        }

        .bg-dark-custom {
            background-color: rgba(26, 26, 26, 0.95);
        }

        .btn-orange {
            background-color: #FFA500;
            color: #000;
            transition: all 0.3s ease;
        }

        .btn-orange:hover {
            background-color: #FFB733;
            transform: translateY(-2px);
        }

        .fade-in {
            animation: fadeIn 0.8s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }



        .auth-popover {
            background-color: var(--dark-black);
            border: 1px solid var(--primary-orange);
            border-radius: 15px;
            padding: 20px;
            min-width: 30%;
        }

        .form-control-custom {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 140, 0, 0.3);
            color: white;
        }

        .form-control-custom:focus {
            background-color: rgba(255, 255, 255, 0.15);
            border-color: var(--primary-orange);
            color: white;
            box-shadow: 0 0 0 0.25rem rgba(255, 140, 0, 0.25);
        }

        .form-control-custom::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .nav-tabs .nav-link.auth-tab {
            color: white;
            border: none;
            border-bottom: 2px solid transparent;
            background: transparent;
        }

        .nav-tabs .nav-link.auth-tab.active {
            color: var(--primary-orange);
            background: transparent;
            border-bottom: 2px solid var(--primary-orange);
        }

        .btn-outline-orange {
            color: var(--primary-orange);
            border-color: var(--primary-orange);
            background: transparent;
        }

        .btn-outline-orange:hover {
            color: black;
            background-color: var(--primary-orange);
        }

        .input-group .form-control-custom {
            border-right: none;
        }

        .input-group .btn-outline-orange {
            border-left: none;
        }

        .form-label {
            color: white;
        }
    </style>
</head>

<body class="text-white">
    @auth
        <div>
            @include('pages.HomePage')
            @yield('content')
        </div>
        {{-- @if (session('access'))
            <script>
                alert("{{ session('access') }}")
            </script>
        @endif --}}
    @else
        <nav class="navbar navbar-expand-lg fixed-top bg-dark-custom">
            <div class="container">
                <a class="navbar-brand text-orange" href="/">Don Macchiatos</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>


        <main>
            <section class="hero-section d-flex align-items-center">
                <div class="container text-center">

                    <div class="fade-in">
                        @if (session('success'))
                            <div class="alert-dark custom-alert alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i><label style="color: greenyellow"
                                    for="">{{ session('success') }}</label>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert-danger custom-alert alert-dismissible fade show " role="alert">
                                <label style="color:red">{{ session('error') }}</label>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('revoke'))
                            <div class="alert-danger custom-alert alert-dismissible fade show " role="alert">
                                <label style="color: red">{{ session('revoke') }}</label>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif


                        <h1 class="display-2 mb-4 fw-bold" style="font-family: 'Playfair Display', serif;">Don Macchiatos
                        </h1>
                        <p class="lead mb-5 mx-auto" style="max-width: 800px;">
                            We source only the highest quality tea leaves, fresh milk, and natural ingredients to bring you
                            a rich, authentic taste with every sip. From classic flavors to creative,<br><span
                                class="text-orange">" DON MACCHIATOS "</span> guarantees a taste that delights.
                        </p>
                        <button popovertarget="AuthForAdmin"
                            class="btn btn-orange btn-lg rounded-pill px-5 py-3 fw-semibold text-uppercase">
                            Welcome Admin
                        </button>
                    </div>
                </div>
            </section>

            <section class="py-5">
                <div class="container">
                    <div class="row text-center g-4">
                        <div class="col-md-4">
                            <div class="mb-4">
                                <i class="fas fa-leaf text-orange fs-1"></i>
                            </div>
                            <h3 class="h4 mb-3" style="font-family: 'Playfair Display', serif;">Premium Quality</h3>
                            <p>Carefully selected ingredients for the perfect cup every time.</p>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <i class="fas fa-mug-hot text-orange fs-1"></i>
                            </div>
                            <h3 class="h4 mb-3" style="font-family: 'Playfair Display', serif;">Crafted with Care</h3>
                            <p>Each drink is prepared with attention to detail and passion.</p>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <i class="fas fa-heart text-orange fs-1"></i>
                            </div>
                            <h3 class="h4 mb-3" style="font-family: 'Playfair Display', serif;">Customer First</h3>
                            <p>Your satisfaction is our top priority.</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>


        {{-- authentication --}}
        <div id="AuthForAdmin" popover class="auth-popover">
            <h1 class="text-center text-white font-serif">Admin</h1>
            <div class="nav nav-tabs mb-4 justify-content-center border-0" role="tablist">
                <button class="nav-link active auth-tab px-4 me-2" data-tab="login">Login</button>
                <button class="nav-link auth-tab px-4" data-tab="register">Register</button>
            </div>



            {{-- LoginForm --}}
            <form id="loginForm" action="{{ route('admin.login') }}" method="POST">
                @csrf
                <div class="mb-3 position-relative">
                    <label for="register-name" class="form-label">
                        <i class="fas fa-user text-orange me-2"></i>Branch Name
                    </label>
                    <input type="text" class="form-control form-control-custom" id="login-name" name="branchname"
                        required>
                </div>
                <div class="mb-3 position-relative">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock text-orange me-2"></i>Password
                    </label>
                    <div class="input-group">
                        <input type="password" class="form-control form-control-custom" id="login-password"
                            name="password" required>
                        <button type="button" class="btn btn-outline-orange"
                            onclick="togglePassword('login-password', this)">
                            <i class="fas fa-eye-slash"></i>
                        </button>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-orange ">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </button>
                </div>
                <div class="d-grid mt-3" style="display: flex; justify-content: center">
                    <a class=" cursor-pointer" style="color: orange; text-decoration: none; " href="/ForgotpassPage"
                        target="_blank">
                        Forgot password ?
                    </a>
                </div>
            </form>



            {{-- RegisterForm --}}
            <form id="registerForm" action="{{ route('admin.register') }}" method="POST" style="display: none;">
                @csrf
                <div class="mb-3 position-relative">
                    <label for="register-name" class="form-label">
                        <i class="fas fa-user text-orange me-2"></i>Branch Name
                    </label>
                    <input type="text" class="form-control form-control-custom" id="register-name" name="branchname"
                        required>
                </div>
                <div class="mb-3 position-relative">
                    <label for="register-name" class="form-label">
                        <i class="fas fa-user text-orange me-2"></i>Firstname
                    </label>
                    <input type="text" class="form-control form-control-custom" id="register-name" name="firstname"
                        required>
                </div>
                <div class="mb-3 position-relative">
                    <label for="register-name" class="form-label">
                        <i class="fas fa-user text-orange me-2"></i>Lastname
                    </label>
                    <input type="text" class="form-control form-control-custom" id="register-name" name="lastname"
                        required>
                </div>
                <div class="mb-3 position-relative">
                    <label for="register-password" class="form-label">
                        <i class="fas fa-lock text-orange me-2"></i>Password
                    </label>
                    <div class="input-group">
                        <input type="password" class="form-control form-control-custom" id="register-password"
                            name="password" required>
                        <button type="button" class="btn btn-outline-orange"
                            onclick="togglePassword('register-password', this)">
                            <i class="fas fa-eye-slash"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-3 position-relative">
                    <label for="register-password-confirm" class="form-label">
                        <i class="fas fa-lock text-orange me-2"></i>Confirm Password
                    </label>
                    <div class="input-group">
                        <input type="password" class="form-control form-control-custom" id="register-password-confirm"
                            name="confirm_password" required>
                        <button type="button" class="btn btn-outline-orange"
                            onclick="togglePassword('register-password-confirm', this)">
                            <i class="fas fa-eye-slash"></i>
                        </button>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-orange">
                        <i class="fas fa-user-plus me-2"></i>Register
                    </button>
                </div>
            </form>
        </div>
    @endauth




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function togglePassword(inputId, icon) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            }
        }

        // Tab switching functionality
        document.querySelectorAll('.auth-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                // Update active tab
                document.querySelectorAll('.auth-tab').forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                // Show/hide forms
                const formToShow = tab.dataset.tab === 'login' ? 'loginForm' : 'registerForm';
                const formToHide = tab.dataset.tab === 'login' ? 'registerForm' : 'loginForm';
                document.getElementById(formToShow).style.display = 'block';
                document.getElementById(formToHide).style.display = 'none';
            });
        });

        // Error handling
    </script>

</body>

</html>
