<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            background-color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    @section('dashboard')
        <div class="container-fluid py-4">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="mb-0">Branch Management</h2>
                        <div class="d-flex gap-2">
                            <a href="{{ route('UserManagement') }}" class="p-2" style='text-decoration: none; background-color: blue; color: white; border-radius: 5px;'>
                                <i class="fas fa-users me-2"></i>User Management
                            </a>
                            <button type="button" class="btn btn-warning p-2" data-bs-toggle="modal" data-bs-target="#addBranchModal">
                                <i class="fas fa-plus-circle me-2"></i>Add Branch
                            </button>
                            <form action="{{ route('SuperAdmin.logout') }}" method="post" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger p-2">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success py-2">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <h6 class="text-warning text-uppercase mb-2">Branch Statistics</h6>
                                    <canvas id="branchChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <h6 class="text-info text-uppercase mb-2">Customer Statistics</h6>
                                    <canvas id="customerChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <h6 class="text-success text-uppercase mb-2">Revenue Overview</h6>
                                    <canvas id="revenueChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <h6 class="text-primary text-uppercase mb-2">Orders Overview</h6>
                                    <canvas id="ordersChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addBranchModal" tabindex="-1" aria-labelledby="addBranchModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-warning text-dark">
                            <h5 class="modal-title" id="addBranchModalLabel">Add New Branch</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addBranchForm" action="{{ route('Add.Branches') }}" method="post" class="row g-3">
                                @csrf

                                @if (session('error'))
                                    <div class="alert alert-danger py-2">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="search" class="form-control @error('branchname') is-invalid @enderror"
                                            name="branch_name" list="branchname" id="branchInput" required>
                                        <label for="branchInput">Branch</label>
                                        <datalist id="branchname">
                                            <option value="Alcantara, Branch">Alcantara, Branch</option>
                                            <option value="Alcoy, Branch">Alcoy, Branch</option>
                                            <option value="Alegria, Branch">Alegria, Branch</option>
                                            <option value="Argao, Branch">Argao, Branch</option>
                                            <option value="Asturias, Branch">Asturias, Branch</option>
                                            <option value="Badian, Branch">Badian, Branch</option>
                                            <option value="Balamban, Branch">Balamban, Branch</option>
                                            <option value="Bantayan, Branch">Bantayan, Branch</option>
                                            <option value="Barili, Branch">Barili, Branch</option>
                                            <option value="Bogo, Branch">Bogo, Branch</option>
                                            <option value="Boljoon, Branch">Boljoon, Branch</option>
                                            <option value="Borbon, Branch">Borbon, Branch</option>
                                            <option value="Carcar, Branch">Carcar, Branch</option>
                                            <option value="Carmen, Branch">Carmen, Branch</option>
                                            <option value="Catmon, Branch">Catmon, Branch</option>
                                            <option value="Cebu City, Branch">Cebu City, Branch</option>
                                            <option value="Compostela, Branch">Compostela, Branch</option>
                                            <option value="Consolacion, Branch">Consolacion, Branch</option>
                                            <option value="Cordova, Branch">Cordova, Branch</option>
                                            <option value="Dalaguete, Branch">Dalaguete, Branch</option>
                                            <option value="Danao, Branch">Danao, Branch</option>
                                            <option value="Dumanjug, Branch">Dumanjug, Branch</option>
                                            <option value="Ginatilan, Branch">Ginatilan, Branch</option>
                                            <option value="Liloan, Branch">Liloan, Branch</option>
                                            <option value="Lapu-Lapu, Branch">Lapu-Lapu, Branch</option>
                                            <option value="Mandaue City , Branch">Mandaue City , Branch</option>
                                            <option value="Madridejos, Branch">Madridejos, Branch</option>
                                            <option value="Minglanilla, Branch">Minglanilla, Branch</option>
                                            <option value="Moalboal, Branch">Moalboal, Branch</option>
                                            <option value="Oslob, Branch">Oslob, Branch</option>
                                            <option value="Pilar, Branch">Pilar, Branch</option>
                                            <option value="Pinamungahan, Branch">Pinamungahan, Branch</option>
                                            <option value="Poro, Branch">Poro, Branch</option>
                                            <option value="Ronda, Branch">Ronda, Branch</option>
                                            <option value="San Fernando, Branch">San Fernando, Branch</option>
                                            <option value="San Francisco, Branch">San Francisco, Branch</option>
                                            <option value="San Remigio, Branch">San Remigio, Branch</option>
                                            <option value="Santa Fe, Branch">Santa Fe, Branch</option>
                                            <option value="Santander, Branch">Santander, Branch</option>
                                            <option value="Sibonga, Branch">Sibonga, Branch</option>
                                            <option value="Sogod, Branch">Sogod, Branch</option>
                                            <option value="Tabogon, Branch">Tabogon, Branch</option>
                                            <option value="Tabuelan, Branch">Tabuelan, Branch</option>
                                            <option value="Talisay, Branch">Talisay, Branch</option>
                                            <option value="Toledo, Branch">Toledo, Branch</option>
                                            <option value="Tuburan, Branch">Tuburan, Branch</option>
                                            <option value="Tudela, Branch">Tudela, Branch</option>
                                            <option value="Tugbong, Branch">Tugbong, Branch</option>
                                            <option value="Ulat, Branch">Ulat, Branch</option>
                                            <option value="Umas, Branch">Umas, Branch</option>
                                            <option value="Ubay, Branch">Ubay, Branch</option>
                                            <option value="Valencia, Branch">Valencia, Branch</option>
                                            <option value="Valladolid, Branch">Valladolid, Branch</option>
                                            <option value="Zambujal, Branch">Zambujal, Branch</option>
                                        </datalist>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('firstname') is-invalid @enderror" 
                                            id="firstname" name="first_name" required>
                                        <label for="firstname">First Name</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('lastname') is-invalid @enderror" 
                                            id="lastname" name="last_name" required>
                                        <label for="lastname">Last Name</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="search" class="form-control @error('address') is-invalid @enderror"
                                            name="address" list="address" id="addressInput" required>
                                        <label for="addressInput">Address</label>
                                        <datalist id="address">
                                            <option value="Alcantara, Cebu">Alcantara, Cebu</option>
                                            <option value="Alcoy, Cebu">Alcoy, Cebu</option>
                                            <option value="Alegria, Cebu">Alegria, Cebu</option>
                                            <option value="Argao, Cebu">Argao, Cebu</option>
                                            <option value="Asturias, Cebu">Asturias, Cebu</option>
                                            <option value="Badian, Cebu">Badian, Cebu</option>
                                            <option value="Balamban, Cebu">Balamban, Cebu</option>
                                            <option value="Bantayan, Cebu">Bantayan, Cebu</option>
                                            <option value="Barili, Cebu">Barili, Cebu</option>
                                            <option value="Bogo, Cebu">Bogo, Cebu</option>
                                            <option value="Boljoon, Cebu">Boljoon, Cebu</option>
                                            <option value="Borbon, Cebu">Borbon, Cebu</option>
                                            <option value="Carcar, Cebu">Carcar, Cebu</option>
                                            <option value="Carmen, Cebu">Carmen, Cebu</option>
                                            <option value="Catmon, Cebu">Catmon, Cebu</option>
                                            <option value="Cebu City, Cebu">Cebu City, Cebu</option>
                                            <option value="Compostela, Cebu">Compostela, Cebu</option>
                                            <option value="Consolacion, Cebu">Consolacion, Cebu</option>
                                            <option value="Cordova, Cebu">Cordova, Cebu</option>
                                            <option value="Dalaguete, Cebu">Dalaguete, Cebu</option>
                                            <option value="Danao, Cebu">Danao, Cebu</option>
                                            <option value="Dumanjug, Cebu">Dumanjug, Cebu</option>
                                            <option value="Ginatilan, Cebu">Ginatilan, Cebu</option>
                                            <option value="Liloan, Cebu">Liloan, Cebu</option>
                                            <option value="Lapu-Lapu, Cebu">Lapu-Lapu, Cebu</option>
                                            <option value="Madridejos, Cebu">Madridejos, Cebu</option>
                                            <option value="Mandaue, Cebu City">Mandaue, Cebu City</option>
                                            <option value="Minglanilla, Cebu">Minglanilla, Cebu</option>
                                            <option value="Moalboal, Cebu">Moalboal, Cebu</option>
                                            <option value="Oslob, Cebu">Oslob, Cebu</option>
                                            <option value="Pilar, Cebu">Pilar, Cebu</option>
                                            <option value="Pinamungahan, Cebu">Pinamungahan, Cebu</option>
                                            <option value="Poro, Cebu">Poro, Cebu</option>
                                            <option value="Ronda, Cebu">Ronda, Cebu</option>
                                            <option value="San Fernando, Cebu">San Fernando, Cebu</option>
                                            <option value="San Francisco, Cebu">San Francisco, Cebu</option>
                                            <option value="San Remigio, Cebu">San Remigio, Cebu</option>
                                            <option value="Santa Fe, Cebu">Santa Fe, Cebu</option>
                                            <option value="Santander, Cebu">Santander, Cebu</option>
                                            <option value="Sibonga, Cebu">Sibonga, Cebu</option>
                                            <option value="Sogod, Cebu">Sogod, Cebu</option>
                                            <option value="Tabogon, Cebu">Tabogon, Cebu</option>
                                            <option value="Tabuelan, Cebu">Tabuelan, Cebu</option>
                                            <option value="Talisay, Cebu">Talisay, Cebu</option>
                                            <option value="Toledo, Cebu">Toledo, Cebu</option>
                                            <option value="Tuburan, Cebu">Tuburan, Cebu</option>
                                            <option value="Tudela, Cebu">Tudela, Cebu</option>
                                            <option value="Tugbong, Cebu">Tugbong, Cebu</option>
                                            <option value="Ulat, Cebu">Ulat, Cebu</option>
                                            <option value="Umas, Cebu">Umas, Cebu</option>
                                            <option value="Ubay, Cebu">Ubay, Cebu</option>
                                            <option value="Valencia, Cebu">Valencia, Cebu</option>
                                            <option value="Valladolid, Cebu">Valladolid, Cebu</option>
                                            <option value="Zambujal, Cebu">Zambujal, Cebu</option>
                                        </datalist>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control @error('phone_number') is-invalid @enderror"
                                            id="phone_number" name="phone_number" maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                                        <label for="phone_number">Phone Number</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" required>
                                        <label for="email">Email</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" required>
                                        <label for="password">Password</label>
                                        <button class="btn btn-link position-absolute end-0 top-50 translate-middle-y" 
                                            type="button" onclick="togglePassword()">
                                            <i class="fas fa-eye-slash" id="passwordToggle"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="modal-footer px-0 pb-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fas fa-save me-2"></i>Save Branch
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-warning">Branch List</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center">
                            <thead class="bg-light">
                                <tr>
                                    <th>Branch Name</th>
                                    <th>Manager</th>
                                    <th>Address</th>
                                    <th>Contact</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($branches as $branch)
                                <tr>
                                    <td class="fw-bold">{{ $branch->branch_name }}</td>
                                    <td>{{ $branch->first_name }} {{ $branch->last_name }}</td>
                                    <td>{{ $branch->address }}</td>
                                    <td>
                                        <div>{{ $branch->phone_number }}</div>
                                        <div class="small text-muted">{{ $branch->email }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-success rounded-pill">
                                            <i class="fas fa-circle me-1"></i>{{ $branch->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('moreBranchInformation', ['id' => $branch->branch_id, 'branch_name' => $branch->branch_name, 'first_name' => $branch->first_name, 'last_name' => $branch->last_name, 'address' => $branch->address, 'phone_number' => $branch->phone_number, 'email' => $branch->email, 'status' => $branch->status]) }}" 
                                           class="btn btn-sm btn-outline-warning">
                                            <i class="fas fa-info-circle me-1"></i>Details
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

           
        </div>
    @endsection

    <script>
        // Auto-hide success alert after 3 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.querySelector('.alert-success');
            if (successAlert) {
                setTimeout(function() {
                    successAlert.style.transition = 'opacity 0.5s ease';
                    successAlert.style.opacity = '0';
                    setTimeout(function() {
                        successAlert.remove();
                    }, 500);
                }, 3000);
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Branch Chart
            new Chart(document.getElementById('branchChart'), {
                type: 'pie',
                data: {
                    labels: ['Active Branches', 'Inactive'],
                    datasets: [{
                        data: [{{ count($branches) }}, 0],
                        backgroundColor: ['#ffc107', '#e9ecef']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Customer Chart
            new Chart(document.getElementById('customerChart'), {
                type: 'pie',
                data: {
                    labels: ['Active Customers', 'Inactive'],
                    datasets: [{
                        data: [{{ $totalCustomers ?? 0 }}, 0],
                        backgroundColor: ['#ffc107', '#e9ecef']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Revenue Chart
            new Chart(document.getElementById('revenueChart'), {
                type: 'pie',
                data: {
                    labels: ['Current Revenue', 'Target'],
                    datasets: [{
                        data: [{{ $totalRevenue ?? 0 }}, {{ ($totalRevenue ?? 0) * 1.2 }}],
                        backgroundColor: ['#ffc107', '#e9ecef']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Orders Chart
            new Chart(document.getElementById('ordersChart'), {
                type: 'pie',
                data: {
                    labels: ['Completed Orders', 'Pending'],
                    datasets: [{
                        data: [{{ $totalOrders ?? 0 }}, 0],
                        backgroundColor: ['#ffc107', '#e9ecef']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        });


        document.getElementById('addBranchForm').addEventListener('submit', (e) => {
            const inputs = document.querySelectorAll('input[type="text"], input[type="number"],input[type="email"], input[type="password"], textarea');
            inputs.forEach(input => {
                input.value = input.value.trim();
            });
        });
    </script>

</body>

</html>
