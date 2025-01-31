<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/storage/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Reset Password</title>
    <style>
        body {
            background: linear-gradient(135deg, #ff8c00 0%, #000000 100%);
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
        }

        .btn-primary {
            background-color: #ff8c00;
            border-color: #ff8c00;
        }

        .btn-primary:hover {
            background-color: #ff7600;
            border-color: #ff7600;
        }

        .btn-outline-secondary {
            border-color: #ced4da;
            color: #6c757d;
        }

        .btn-outline-secondary:hover {
            background-color: #f8f9fa;
            color: #6c757d;
        }

        .input-group .btn {
            z-index: 0;
        }

        .alert-fade-out {
            animation: fadeOut 0.5s ease forwards;
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
    </style>
</head>

<body class="min-vh-100 d-flex flex-column">
    <div class="container my-5">
        <a href="/ForgotpassPage"><i class="fa-solid fa-arrow-left text-black" style="font-size: 1.5rem"></i></a>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h1 class="card-title text-center mb-4">Reset Password</h1>
                        <form action="/reset-password" method="POST">
                            @csrf
                            <div class="mb-3 d-block">
                                <label for="">Branch Name :</label>
                                <strong>{{ $branch_name }}</strong><br>
                                <label for="">First Name :</label>
                                <strong>{{ $first_name }}</strong><br>
                                <label for="">Last Name :</label>
                                <strong>{{ $last_name }}</strong><br>
                                <label for="">Address :</label>
                                <strong>{{ $address }}</strong><br>
                                <label for="">Email :</label>
                                <strong>{{ $email }}</strong>
                            </div>

                            {{-- @if (session('success'))
                                <div class="alert alert-success custom-alert alert-dismissible fade show animate__animated animate__fadeIn"
                                    role="alert">
                                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif --}}

                            @if (session('error'))
                                <div class="alert alert-danger custom-alert alert-dismissible fade show animate__animated animate__fadeIn"
                                    role="alert">
                                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <input type="hidden" name="branch_name" value="{{ $branch_name }}">
                            <input type="hidden" name="first_name" value="{{ $first_name }}">
                            <input type="hidden" name="last_name" value="{{ $last_name }}">
                            <input type="hidden" name="address" value="{{ $address }}">
                            <input type="hidden" name="email" value="{{ $email }}">
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="new_password" name="new_password"
                                        placeholder="Enter new password" required>
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="togglePassword('new_password', this)">
                                        <i class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="confirm_password"
                                        name="confirm_password" placeholder="Confirm new password" required>
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="togglePassword('confirm_password', this)">
                                        <i class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert-dismissible');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.classList.add('alert-fade-out');
                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                }, 3000);
            });
        });
    </script>
</body>

</html>
