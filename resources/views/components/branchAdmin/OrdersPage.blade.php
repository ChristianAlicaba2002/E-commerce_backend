<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/storage/logo.png" type="image/x-icon">
    <title>Orders Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .bg-orange {
            background-color: orange;
        }

        .text-orange {
            color: orange;
        }

        body {
            background-color: #fff5e6;
        }

        .container {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 0.85rem;
        }

        .table thead {
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container mt-5 shadow-lg p-3 mb-5 bg-body rounded">
        <a href="{{ '/' }}" class="btn btn-warning text-dark mb-3 ps-0">
            <i class="fa-solid me-2"></i>
            Back to Dashboard
        </a>
        <div class="row mb-4">
            <div class="col text-center">
                <h1 class="display-4 text-orange">Orders Management</h1>
                <p class="lead">Manage all your orders efficiently and effectively.</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 mx-auto">
                <div class="input-group">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search orders...">
                    <button class="btn btn-warning" type="button">
                        <i class="fa-solid fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover text-center table-bordered border">
                <thead class="bg-orange text-white">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Product</th>
                        <th scope="col">Payment</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Message</th>
                        <th scope="col">Status</th>
                        <th scope="col">Time</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($orders as $order)
                        <tr class="align-middle">
                            <td>{{ $order->product_id }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->payment }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->fullname }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->phoneNumber }}</td>
                            <td>{{ $order->message }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->updated_at }}</td>
                        </tr>
                    @endforeach


                </tbody>

            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

    <!-- Add this search functionality -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let searchText = this.value.toLowerCase();
            let tableRows = document.querySelectorAll('tbody tr');

            tableRows.forEach(row => {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchText) ? '' : 'none';
            });
        });
    </script>
</body>

</html>
