<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>User Management</title>
</head>

<body class="bg-white">

    @if (session('failedToExport'))
        <script>
            alert("{{ session('failedToExport') }}")
        </script>
    @endif


    <div class="container-fluid p-4">
        <div class="mb-3">
            <a href="{{ route('LoginSuperAdmin') }}" class="btn btn-warning">
                <i class="fa-solid fa-arrow-left me-2"></i> Back to Dashboard
            </a>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">User Management</h1>
                <div>
                    <span class="badge bg-primary text-white p-2 me-2">Total Users: {{ count($users) }}</span>
                </div>
            </div>
            <div class="card-body">
                <p class="lead text-muted mb-4">
                    Welcome to the User Management dashboard. This interface provides a comprehensive view of all
                    registered users in the system.
                    You can monitor user details including personal information and account timestamps. Use this table
                    to track and manage user accounts effectively.
                </p>

                <div class="alert alert-info mb-4">
                    <i class="fas fa-info-circle me-2"></i>
                    The table below displays user information in chronological order based on registration date.
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchUser" placeholder="Search users...">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-8 text-end">
                        <button class="btn btn-success me-2"
                            onclick="window.location.href='{{ route('export.users.excel') }}'">
                            <i class="fas fa-file-excel me-1"></i> Export to Excel
                        </button>
                        <button class="btn btn-danger" onclick="window.location.href='{{ route('export.users.pdf') }}'">
                            <i class="fas fa-file-pdf me-1"></i> Export to PDF
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered text-center">
                        <thead class="table-warning">
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Birth Year</th>
                                <th>Birth Month</th>
                                <th>Birth Day</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->firstName }}</td>
                                    <td>{{ $user->lastName }}</td>
                                    <td>{{ $user->birthYear }}</td>
                                    <td>{{ $user->birthMonth }}</td>
                                    <td>{{ $user->birthDay }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->last_login ?? 'Offline' }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <div class="btn-group gap-2">
                                            <button class="btn btn-sm btn-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
