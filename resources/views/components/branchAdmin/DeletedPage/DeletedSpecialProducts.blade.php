<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/storage/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>Deleted Products</title>
</head>
<style>
    :root {
        --primary-orange: #FFA500;
        --secondary-orange: #4f2000;
        --dark-bg: #1a1a1a;
        --darker-bg: #141414;
        --lighter-bg: #2d2d2d;
        --lighter-font: #ffffff;
        --darker-font: #000000;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
    }

    .wrapper {
        display: flex;
        min-height: 100vh;
    }

    .sidebar {
        width: 250px;
        background: var(--darker-bg);
        color: white;
        min-height: 100vh;
        position: fixed;
        transition: all 0.3s;
    }

    .sidebar-header {
        padding: 20px;
        background: var(--primary-orange);
        text-align: center;
    }

    .sidebar-menu {
        padding: 20px 0;
    }

    .menu-item {
        padding: 10px 20px;
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
        transition: 0.3s;
    }

    .menu-item:nth-child(6) {
        background: var(--primary-orange);
    }

    .menu-item:hover {
        background: var(--secondary-orange);
        color: var(--lighter-font);
    }

    .menu-item i {
        margin-right: 10px;
    }

    .main-content {
        margin-left: 250px;
        width: calc(100% - 250px);
        padding: 20px;
    }

    .table-container {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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

    .dropdown-menu {
        margin: 1.5% 0 0 0;
        display: none;
        position: absolute;
        z-index: 1000;
        background-color: var(--primary-orange);
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }

    .dropdown-menu li {
        padding: 5px 10px;
        color: var(--lighter-font);
        text-decoration: none;
        display: flex;
        align-items: center;
        transition: 0.3s;
    }

    .dropdown-item:hover {
        background-color: rgba(255, 255, 255, 0.386);
    }
</style>

<body>

    <nav class="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-coffee me-2"></i>Deleted Items</h3>
        </div>
        <div class="sidebar-menu">
            <a href="{{ '/' }}" class="menu-item">
                <i class="fa-solid fa-arrow-left"></i>Back to Home
            </a>
        

            <div class="dropdown">
                <a href="#" class="menu-item dropdown-toggle" id="deletedDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-shop"></i>Products
                </a>
                <ul class="dropdown-menu" aria-labelledby="deletedDropdown">
                    <li><a class="dropdown-item" href="{{ '/DonMacAllProducts' }}">Don Macchiatos</a></li>
                    <li><a class="dropdown-item" href="{{ '/AllSpecialProducts' }}">Special Products</a></li>
                </ul>
            </div>

            <div class="dropdown">
                <a href="#" class="menu-item dropdown-toggle" id="deletedDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-trash"></i>Deleted Items
                </a>
                <ul class="dropdown-menu" aria-labelledby="deletedDropdown">
                    <li><a class="dropdown-item" href="{{ '/DeletedDonMacProducts' }}">Don Macchiatos</a></li>
                    <li><a class="dropdown-item" href="{{ '/DeletedSpecialProducts' }}">Special Products</a></li>
                </ul>
            </div>

            <div style="position: absolute; bottom: 20px; width: 100%; text-align: center; color: white; padding: 15px; background-color: var(--darker-bg);">
                <i class="fas fa-store me-2"></i>
                <a class="text-white" href="{{ '/DisplayBranchDashboard' . Auth::guard('branches')->user()->branch_id }}">
                    <strong>{{ Auth::guard('branches')->user()->branch_name }}</strong>
                </a>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <div class="table-container">
            <h2 class="">Deleted Special Items</h2>
            @isset($products)
                <h6>Total Products: {{ count($products) }}</h6>
            @endisset
            <input type="search" name="search" id="search" class="form-control mb-4" onkeyup="searchProduct()"
                placeholder="Search for a product">
            @if ($products->isEmpty())
                <div class="alert alert-warning">No products deleted yet.</div>
            @else
                @if (session('success'))
                    <div class="alert alert-success custom-alert alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @isset($products)
                    <table class="table table-hover" id="productTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Category</th>
                                <th scope="col">Description</th>
                                <th scope="col">Deleted At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->product_id }}</td>
                                    <td>
                                        <img src="{{ asset('/images/' . $product->image) }}" alt="{{ $product->name }}"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->category }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->updated_at }}</td>
                                    <td>
                                        <form action="/restoringSpecialData{{ $product->id }}" method="post">
                                            @csrf
                                            @method('POST')
                                            <button class="btn btn-warning mb-2">Restore</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endisset
            @endif
        </div>
    </div>
    <script>
        function editProduct(id, name, price, description) {
            document.getElementById('updateForm').action = `/updateSpecialProduct/${id}`;
            document.getElementById('editProductId').value = id;
            document.getElementById('editName').value = name;
            document.getElementById('editPrice').value = price;
            document.getElementById('editDescription').value = description;
        }

        function searchProduct() {
            let input = document.getElementById('search');
            let filter = input.value.toLowerCase();
            let table = document.getElementById('productTable');
            let tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                let td = tr[i].getElementsByTagName('td');
                let found = false;

                for (let j = 0; j < td.length; j++) {
                    let cell = td[j];
                    if (cell) {
                        let textValue = cell.textContent || cell.innerText;
                        if (textValue.toLowerCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }

                tr[i].style.display = found ? '' : 'none';
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
