<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branch Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --orange-primary: #ff9a52;
            --orange-light: #fff3e6;
            --orange-dark: #ff7e1f;
        }

        body {
            background-color: var(--orange-light);
        }

        .card {
            border-color: var(--orange-primary);
            border-radius: 10px;
        }

        .product-card {
            transition: transform 0.2s;
            background-color: white;
        }

        .product-card:hover {
            transform: translateY(-5px);
            border-color: var(--orange-dark);
        }

        h1, h2 {
            color: var(--orange-dark);
        }

        .card-text.text-primary {
            color: var(--orange-dark) !important;
        }

        .badge.bg-success {
            background-color: var(--orange-primary) !important;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <a href="{{ route('LoginSuperAdmin') }}" class="btn btn-warning mb-3">
            <i class="fa-solid fa-arrow-left me-2"></i>Back to Dashboard
        </a>
        <h1 class="mb-4 text-center">Branch Details</h1>

        <div class="card mb-5 shadow">
            <div class="card-body">
                <h2 class="card-title mb-4">Branch Information</h2>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Branch Name:</strong> {{ $branches->branch_name }}</p>
                        <p><strong>First Name:</strong> {{ $branches->first_name }}</p>
                        <p><strong>Last Name:</strong> {{ $branches->last_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Address:</strong> {{ $branches->address }}</p>
                        <p><strong>Phone Number:</strong> {{ $branches->phone_number }}</p>
                        <p><strong>Email:</strong> {{ $branches->email }}</p>
                        <p><strong>Status:</strong> <span class="badge text-black bg-{{ $branches->status === 'Active' ? 'success' : 'warning' }}">{{ $branches->status }}</span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title mb-3">Special Products</h2>
                @if(count($specialProducts) === 0)
                    <p class="text-muted mb-0">No special products available</p>
                @else
                    <p class="mb-0">Total Products: {{count($specialProducts)}}</p>
                @endif
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title mb-3">Don Macchiatos</h2>
                @if(count($donMacProducts) === 0)
                    <p class="text-muted mb-0">No Don Macchiatos products available</p>
                @else
                    <p class="mb-0">Total Products: {{count($donMacProducts)}}</p>
                @endif
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
