<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="/storage/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .containerBackgound {
            background: linear-gradient(#FFA500, rgba(0, 0, 0, 0.804)),
                url('/storage/coffee-bg.jpg') center/cover;
            height: 100vh;

        }

        .login-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateY(0);
            }

            to {
                opacity: 0;
                transform: translateY(-20px);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .custom-alert {
            animation: fadeIn 0.5s ease-out;
        }

        .alert-fade-out {
            animation: fadeOut 0.5s ease-out forwards;
        }
    </style>
</head>

<body>
    @auth
        <div>
            @include('pages.HomePage')
            @yield('content')
            @if (session('access'))
                <script>
                    alert('{{ session('access') }}')
                </script>
            @endif

        </div>
    @else
        <div class="containerBackgound">

            <div class="row justify-content-center align-items-center h-100 w-100">
                <div class='position-absolute top-0 end-0'>
                    <div class="text-center float-end">
                        @if (session('success'))
                            <div class="alert alert-dark custom-alert alert-dismissible fade show alert-fade-out d-inline-block"
                                role="alert">
                                <i class="fas fa-check-circle me-2"></i><label style="color: greenyellow"
                                    for="">{{ session('success') }}</label>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger custom-alert alert-dismissible fade show d-inline-block"
                                role="alert">
                                <label style="color:red">{{ session('error') }}</label>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('revoke'))
                            <div class="alert alert-danger custom-alert alert-dismissible fade show d-inline-block"
                                role="alert">
                                <label style="color:red">{{ session('revoke') }}</label>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>

                </div>


                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card login-card bg-white border-warning">
                        <div class="card-body p-4">
                            <h2 class="text-center text-black mb-4">Welcome Back</h2>



                            <form id="loginForm" action="{{ route('admin.login') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="firstname" class="form-label text-black">First Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-warning text-white">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                            id="firstname" name="firstname" required placeholder="First Name">
                                        @error('firstname')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label text-black">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-warning text-white">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" required placeholder="Password">
                                        <button class="btn btn-outline-warning" type="button" onclick="togglePassword()">
                                            <i class="fas fa-eye-slash" id="passwordToggle"></i>
                                        </button>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-grid gap-2 mt-3">
                                    <p>
                                        Don't have an account?
                                        <a href="{{ route('RegisterPage') }}"
                                            class="text-primary text-decoration-none">
                                            Sign up
                                        </a>
                                    </p>
                                </div>
                                <div class="d-grid gap-2 mb-3">
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fas fa-sign-in-alt me-2 text-black"></i>Login
                                    </button>
                                </div>

                                <div class="mb-3 text-center">
                                    <a href="/ForgotpassPage" class="text-danger text-decoration-none">
                                        Forgot password?
                                    </a>
                                </div>






                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endauth



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordToggle = document.getElementById('passwordToggle');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggle.classList.remove('fa-eye-slash');
                passwordToggle.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                passwordToggle.classList.remove('fa-eye');
                passwordToggle.classList.add('fa-eye-slash');
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const alerts = document.querySelectorAll(".alert-dismissible");
            alerts.forEach((alert) => {
                setTimeout(() => {
                    alert.classList.add("alert-fade-out");
                    setTimeout(() => {
                        alert.remove();
                    }, 5000);
                }, 5000);
            });
        });
    </script>
</body>

</html>
