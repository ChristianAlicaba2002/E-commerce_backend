<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/storage/logo.png" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>All Don Macchiatos Products - Admin</title>
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

    .menu-item:nth-child(3) {
        background: var(--primary-orange);
        color: var(--lighter-font)
    }

    .menu-item:hover {
        background: var(--secondary-orange);
        color: var(--ligther-font);
    }

    .menu-item i {
        margin-right: 10px;
    }


    .main-content {
        margin-left: 250px;
        width: calc(100% - 250px);
        padding: 20px;
    }

    .btn-orange {
        background: var(--primary-orange);
        color: white;
        border: none;
        padding: 6px 25px;
        border-radius: 5px;
        transition: all 0.3s;
    }

    .btn-orange:hover {
        background: var(--secondary-orange);
        color: var(--lighter-font)
    }

    .table-container {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .custom-alert {
        border-radius: 10px;
        border-left: 4px solid;
    }

    .alert-success {
        border-left-color: var(--primary-orange);
    }

    .popover-form {
        border-radius: 2rem;
        padding: 0.90rem 3rem;
        box-shadow: 1px 1px 20px var(--dark-bg);
    }

    .description {
        width: 45%;
        text-wrap: wrap;
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
        margin-left: 5px;
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
            <h3><i class="fas fa-coffee me-2"></i>Don Macchiatos</h3>
        </div>
        <div class="sidebar-menu">
            <a href="{{ '/LoginPage' }}" class="menu-item">
                <i class="fa-solid fa-arrow-left"></i>Back to Home
            </a>
            <div class="dropdown">
                <a href="#" class="menu-item dropdown-toggle" id="deletedDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-shop"></i>Add Products
                </a>
                <ul class="dropdown-menu" aria-labelledby="deletedDropdown">
                    <li><a class="dropdown-item" href="{{ '/DonMacPage' }}">Don Macchiatos</a></li>
                    <li><a class="dropdown-item" href="{{ '/SpecialProductPage' }}">Special Products</a></li>
                </ul>
            </div>


            <div class="dropdown">
                <a href="#" class="menu-item dropdown-toggle" id="deletedDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-shop"></i>Products
                </a>
                <ul class="dropdown-menu" aria-labelledby="deletedDropdown">
                    <li><a class="dropdown-item" href="{{ '#' }}">Don Macchiatos</a></li>
                    <li><a class="dropdown-item" href="{{ '/AllSpecialProducts' }}">Special Products</a></li>
                </ul>
            </div>


            <div class="dropdown">
                <a href="#" class="menu-item dropdown-toggle" id="deletedDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-trash"></i>Deleted Items
                </a>
                <ul class="dropdown-menu" aria-labelledby="deletedDropdown">
                    <li><a class="dropdown-item" href="{{ '/DeletedDonMacProducts' }}"> Don Macchiatos</a></li>
                    <li><a class="dropdown-item" href="{{ '/DeletedSpecialProducts' }}"> Special Products</a></li>
                </ul>
            </div>
        </div>
    </nav>

    @error('record')
        <div class="alert alert-danger custom-alert alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror

    @error('success')
        <div class="alert alert-success custom-alert alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror


    @error('error')
        <div class="alert alert-danger custom-alert alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror

    <div class="main-content">
        <div class="table-container">
            <h2 class="mb-4">Don Macchiatos List</h2>
            @isset($products)
                <h6>Total Products: {{ count($products) }}</h6>
            @endisset

            <input type="search" name="search" id="search" class="form-control mb-4" onkeyup="searchProduct()"
                placeholder="Search for a product">

            @if ($products->isEmpty())
                <div class="alert alert-warning">No products found in the Database.</div>
            @else
                @if (session('success'))
                    <div class="alert alert-success custom-alert alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @isset($products)
                    <h6>Sort by Name</h6>
                    <table class="table table-hover table-bordered" id="productTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products->sortBy('name') as $product)
                                <tr>
                                    <td>{{ $product->product_id }}</td>
                                    <td>
                                        <img src="{{ asset('/images/' . $product->image) }}" alt="{{ $product->name }}"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>₱{{ number_format($product->price, 2) }}</td>
                                    <td class="description">{{ $product->description }}</td>
                                    <td>
                                        <button class="btn"
                                            onclick="editProduct({{ $product->id }}, '{{ $product->name }}', '{{ $product->price }}', '{{ $product->description }}','{{ $product->image }}')"
                                            popovertarget='my-popover'><i class="fa-solid fa-pen-to-square"
                                                style="color: #2bff00; font-size: 1.3rem;"></i></button>

                                        <button type="button" class="border-0 bg-transparent" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            onclick="setDeleteProductId({{ $product->id }})">
                                            <i class="fa-solid fa-trash" style="color: #ff0000; font-size: 1.3rem;"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
            @endif
            </table>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to <span style="color: red">delete</span> this product?
                    </div>
                    <div class="modal-footer">
                        <form id="logout-form" action="" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>



        <div class="popover-form" id="my-popover" popover>
            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Update Product</h5>
                        <button type="button" class="btn-close" popovertarget="my-popover"></button>
                    </div>

                    <div class="modal-body p-4">
                        @isset($products)
                            @if ($products->isEmpty())
                                <div class="alert alert-warning">No products found in the Database.</div>
                            @else
                                @php
                                    foreach ($products as $product) {
                                        $id = $product->product_id;
                                    }
                                @endphp

                                <form action="{{ route('updateDonMacchiatosProduct', ['id' => $id]) }}" method="POST"
                                    id="updateForm" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" id="editProductId">
                                    <div class="mb-3">
                                        <label for="editName" class="form-label">Product Name</label>
                                        <input type="text" class="form-control" id="editName" name="name"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editPrice" class="form-label">Price (₱)</label>
                                        <div class="input-group">
                                            <span class="input-group-text">₱</span>
                                            <input type="number" class="form-control" id="editPrice" name="price"
                                                step="0.01" max="99999"
                                                oninput="if(this.value.length > 5) this.value=this.value.slice(0,5)"
                                                required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="editDescription" class="form-label">Description</label>
                                        <textarea class="form-control" id="editDescription" name="description" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editImage" class="form-label">Product Image</label>
                                        <input type="file" class="form-control" id="editImage" name="image"
                                            accept="image/*">
                                    </div>
                                    <div class="d-flex justify-content-end gap-2 mt-4">
                                        <button type="button" class="btn btn-secondary"
                                            popovertarget="my-popover">Cancel</button>
                                        <button type="submit" class="btn btn-orange">Update Product</button>
                                    </div>
                                </form>
                            @endif
                        @endisset
                    </div>


                </div>

            </div>

            <script>
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

                function editProduct(id, name, price, description, image) {
                    document.getElementById('updateForm').action = `/updateDonMacchiatosProduct/${id}`;
                    document.getElementById('editProductId').value = id;
                    document.getElementById('editName').value = name;
                    document.getElementById('editPrice').value = price;
                    document.getElementById('editDescription').value = description;
                    document.getElementById('editImage').value = image;

                }

                function setDeleteProductId(productId) {
                    const form = document.getElementById('logout-form');
                    form.action = `{{ url('deleteEachDonmacchiatosProduct') }}/${productId}`;
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

            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>


</body>

</html>
