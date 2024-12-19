<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/storage/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Forgot password</title>
    <style>
        body {
            background: linear-gradient(135deg, #ff8c00 0%, #00000070 100%);
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
        <a href="/LoginPage"><i class="fa-solid fa-arrow-left text-black" style="font-size: 1.5rem"></i></a>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h1 class="card-title text-center mb-4">Forgot Password</h1>
                        <p class="text-muted text-center mb-4">
                            We need to confirm if this is you, so please follow our confirmation
                        </p>
                        {{-- 
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif --}}

                        @if (session('success'))
                            <div class="alert alert-success custom-alert alert-dismissible fade show animate__animated animate__fadeIn"
                                role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger custom-alert alert-dismissible fade show animate__animated animate__fadeIn"
                                role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif




                        <form action="/confirmation" method="post">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="branchname" class="form-label">Branch Name</label>
                                <input type="text" class="form-control" id="branchname" name="branchname"
                                    placeholder="Enter branch name" required>
                            </div>
                            <div class="mb-3">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname"
                                    placeholder="Enter first name" required>
                            </div>
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname"
                                    placeholder="Enter last name" required>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
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
