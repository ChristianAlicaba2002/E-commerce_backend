<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Branches Dashboard</title>
    <link rel="shortcut icon" href="/storage/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<style>
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

<body class="bg-light">


    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <div class="container mt-5">
        <a href="{{ '/AllSpecialProducts' }}" class="btn btn-warning text-dark mb-3 ps-0">
            <i class="fa-solid fa-arrow-left m-2"></i>
            <span>Back to Products</span>
        </a>
        <div class="card shadow">
            <div class="card-header bg-warning text-black">
                <h2 class="mb-0">Branch Information</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-4">
                        <label class="text-muted">About This Branch</label>
                        <p class="lead">
                            {{ 'Welcome to ' . $branches->branch_name . ' branch! We are committed to serving the finest coffee and providing exceptional service to our valued customers in this location. Our dedicated team, led by ' . $branches->first_name . ' ' . $branches->last_name . ', ensures a warm and inviting atmosphere for every visitor.' }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="text-muted">Branch Name</label>
                            <h5>{{ $branches->branch_name }}</h5>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted">Manager Name</label>
                            <h5>{{ $branches->first_name }} {{ $branches->last_name }}</h5>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted">Address</label>
                            <h5>{{ $branches->address }}</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="text-muted">Phone Number</label>
                            <h5>{{ $branches->phone_number }}</h5>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted">Email</label>
                            <h5>{{ $branches->email }}</h5>
                        </div>
                    </div>
                </div>
                <button data-bs-toggle="modal" data-bs-target="#updateBranchModal"
                    onclick="EditInformation({{ $branches->id }} , '{{ $branches->branch_name }}' , '{{ $branches->first_name }}', '{{ $branches->last_name }}', '{{ $branches->address }}', '{{ $branches->phone_number }}', '{{ $branches->email }}')"
                    type="button" class="btn btn-warning">
                    Update your Information
                </button>
            </div>
        </div>
    </div>




    <div class="modal" id="updateBranchModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Branch Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id='updateForm' action='' method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="branch_id" id="branch_id">
                        <div class="mb-3">
                            <label for="branch_name" class="form-label">Branch Name</label>
                            <input style="cursor: not-allowed;" type="text" name="branch_name" id="branch_name"
                                class="form-control" placeholder="Branch Name" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control"
                                placeholder="First Name">
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control"
                                placeholder="Last Name">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input style="cursor: not-allowed;" type="text" name="address" id="address"
                                class="form-control" placeholder="Address" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control"
                                placeholder="Phone Number" maxlength="11">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Email">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function EditInformation(id, branch_name, first_name, last_name, address, phone_number, email) {
            document.getElementById('updateForm').action = `/updateBranchInformation/${id}`
            document.getElementById('branch_id').value = id;
            document.getElementById('branch_name').value = branch_name;
            document.getElementById('first_name').value = first_name;
            document.getElementById('last_name').value = last_name;
            document.getElementById('address').value = address;
            document.getElementById('phone_number').value = phone_number;
            document.getElementById('email').value = email;
        }

        // document.getElementById('updateBranchModal').addEventListener('submit' , (e) => {
        //     e.preventDefault();
        //     const inputs = document.querySelectorAll('input[type="text"], input[type="number"],input[type="email"], input[type="password"], textarea');
        //     inputs.forEach(input => {
        //         input.value = input.value.trim();
        //     });

        // })
    </script>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
