<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/storage/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Forgot password</title>
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
    </style>
</head>

<body class="min-vh-100 d-flex flex-column">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h1 class="card-title text-center mb-4">Forgot Password</h1>
                        <p class="text-muted text-center mb-4">
                            We need to confirm if this is you, so please follow our confirmation
                        </p>

                        @if (session('error'))
                            <script>
                                alert("{{ session('error') }}")
                            </script>
                        @endif
                        @if (session('success'))
                            <script>
                                alert("{{ session('success') }}")
                            </script>
                        @endif

                        <form action="/confirmation" method="post">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="branchname" class="form-label">Branch Name</label>
                                <input type="text" class="form-control" id="branchname" name="branchname" placeholder="Enter branch name" required>
                            </div>
                            <div class="mb-3">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter first name" required>
                            </div>
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter last name" required>
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
</body>

</html>
