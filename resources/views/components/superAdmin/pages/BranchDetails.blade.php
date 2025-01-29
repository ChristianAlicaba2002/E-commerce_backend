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
            --primary-color: #2C3E50;
            --secondary-color: #E67E22;
            --background-color: #F5F6FA;
            --text-color: #2C3E50;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            font-family: 'Inter', sans-serif;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            margin-bottom: 1.5rem;
        }

        .page-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-radius: 0 0 20px 20px;
        }

        .back-button {
            background-color: transparent;
            border: 2px solid white;
            color: white;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background-color: white;
            color: var(--primary-color);
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 10px;
            font-weight: 500;
        }

        .status-active {
            background-color: #2ECC71;
            color: white;
        }

        .status-inactive {
            background-color: #E74C3C;
            color: white;
        }

        .info-label {
            color: #7F8C8D;
            font-weight: 500;
        }

        .info-value {
            color: var(--text-color);
            font-weight: 600;
        }

        .products-card {
            background: white;
            transition: transform 0.2s ease;
        }

        .products-card:hover {
            transform: translateY(-5px);
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

        .fade-in {
            animation: fadeIn 0.3s ease-out;
        }
    </style>
</head>

<body>
    <div class="page-header">
        <div class="container">
            <a href="{{ route('LoginSuperAdmin') }}" class="btn back-button mb-3">
                <i class="fa-solid fa-arrow-left me-2"></i>Back to Dashboard
            </a>
            <h1 class="mb-0">Branch Details</h1>
        </div>
    </div>

    <div class="container">
        <div class="card mb-4">
            <div class="card-body p-4">
                <h2 class="card-title mb-4">Branch Information</h2>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="info-label">Branch Name</div>
                            <div class="info-value">{{ $branches->branch_name }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="info-label">Manager</div>
                            <div class="info-value">{{ $branches->first_name }} {{ $branches->last_name }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="info-label">Status</div>
                            <span
                                class="status-badge {{ $branches->status === 'Active' ? 'status-active' : 'status-inactive' }}">
                                {{ $branches->status }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="info-label">Address</div>
                            <div class="info-value">{{ $branches->address }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="info-label">Contact Information</div>
                            <div class="info-value">
                                <i class="fas fa-phone me-2"></i>{{ $branches->phone_number }}<br>
                                <i class="fas fa-envelope me-2"></i>{{ $branches->email }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card products-card">
                    <div class="card-body p-4">
                        <h2 class="card-title h4 mb-3">
                            <i class="fas fa-star me-2 text-warning"></i>Special Products
                        </h2>
                        @if (count($specialProducts) === 0)
                            <p class="text-muted mb-0">No special products available</p>
                        @else
                            <p class="mb-0"><strong>Total Products:</strong> {{ count($specialProducts) }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card products-card">
                    <div class="card-body p-4">
                        <h2 class="card-title h4 mb-3">
                            <i class="fas fa-coffee me-2 text-secondary"></i>Don Macchiatos
                        </h2>
                        @if (count($donMacProducts) === 0)
                            <p class="text-muted mb-0">No Don Macchiatos products available</p>
                        @else
                            <p class="mb-0"><strong>Total Products:</strong> {{ count($donMacProducts) }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
