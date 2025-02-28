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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>All Products - Admin</title>
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
        padding: 15px;
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

    .menu-item:nth-child(4) {
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

    .btn-orange {
        background: var(--primary-orange);
        color: white;
        border: none;
        padding: 6px 25px;
        border-radius: 5px;
        transition: all 0.3s;
    }

    .btn-orange:hover {
        background: #ff8533;
        color: var(--lighter-font)
    }

    .table-container {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .popover-form {
        padding: 0.90rem 3rem;
        box-shadow: 1px 1px 20px var(--dark-bg);
        border-radius: 2rem;
    }

    .custom-alert {
        border-radius: 10px;
        border-left: 4px solid;
    }

    .alert-success {
        border-left-color: var(--primary-orange);
    }

    .description {
        width: 35%;
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

    nav .btn {
        border: none;
        background: none;
        transition: color 0.3s;
    }

    nav .btn:hover {
        color: var(--primary-orange);
    }

    nav .btn.active {
        color: var(--primary-orange);
        font-weight: bold;
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

    .card {
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-body {
        padding: 1.25rem;
    }

    .card-title {
        color: #666;
        margin-bottom: 0.5rem;
    }

    .card-text {
        color: var(--primary-orange);
        margin-bottom: 0;
    }

    .fa-trash {
        color: rgb(255, 67, 67);
    }

    .fa-box-archive {
        color: var(--primary-orange);
    }

    th,
    td:nth-child(7),
    td:nth-child(2),
    td:nth-child(1) {
        text-align: center;
    }
</style>

<body>

    <nav class="sidebar">
        <div class="sidebar-header">
            <h3><i class="fa-brands fa-product-hunt"></i>Inventory</h3>
        </div>
        <div class="sidebar-menu">
            <a href="{{ '/' }}" class="menu-item">
                <i class="fa-solid fa-arrow-left"></i>Back to Home
            </a>


            <div class="dropdown">
                <a href="#" class="menu-item " id="deletedDropdown" role="button">
                    <i class="fa-solid fa-shop"></i>Products
                </a>
            </div>


            <div class="dropdown">
                <a href="/DeletedSpecialProducts" class="menu-item" id="deletedDropdown" role="button">
                    <i class="fa-solid fa-box-archive"></i>Archive
                </a>
            </div>

            <div
                style="position: absolute; bottom: 20px; width: 100%; text-align: center; color: white; padding: 15px; background-color: var(--darker-bg);">
                <i class="fas fa-store me-2"></i>
                <a class=" text-white"
                    href="{{ '/DisplayBranchDashboard' . Auth::guard('branches')->user()->branch_id }}">
                    <strong>{{ Auth::guard('branches')->user()->branch_name }}</strong>
                </a>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All Products</h6>
                        <p class="card-text h4">{{ count($products) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Revenue</h6>
                        <p class="card-text h4">₱0.00</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Best Seller</h6>
                        <p class="card-text h4">-</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Customers</h6>
                        <p class="card-text h4">0</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Special Products List</h2>
                <button class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#add-product-modal">
                    <i class="fas fa-plus me-2"></i>Add Product
                </button>
            </div>
            @isset($products)
                <h6>Total Products: {{ count($products) }}</h6>
            @endisset

            <input type="search" name="search" id="search" class="form-control mb-4" onkeyup="searchProduct()"
                placeholder="Search for a product">

            @if ($products->isEmpty())
                <!-- <div class="alert alert-warning">Don't have any products</div> -->
            @else
                <nav>
                    <ul class="d-flex justify-content-center gap-4 list-unstyled">
                        <li>
                            <button class="btn active" onclick="filterProducts('all', event)">
                                All
                            </button>
                        </li>
                        @php
                            $categories = $products->pluck('category')->unique();
                        @endphp
                        @foreach ($categories as $category)
                            <li>
                                <button class="btn" onclick="filterProducts('{{ $category }}',event)">
                                    {{ $category }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            @endif


            @if ($products->isEmpty())
                <div class="alert alert-warning">Don't have any products</div>
            @else
                @if (session('success'))
                    <div class="alert alert-success custom-alert alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger custom-alert alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif




                @isset($products)
                    <h6 class="fw-light">Sort by Price</h6>
                    <table class="table table-hover table-bordered" id="productTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($products->sortBy('price') as $product)
                                <tr>
                                    <td>{{ $product->product_id }}</td>
                                    <td>
                                        <img src="{{ asset('/images/' . $product->image) }}" alt="{{ $product->name }}"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>₱{{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->category }}</td>
                                    <td class="description">{{ $product->description }}</td>
                                    <td>
                                        <button class="btn" title="Edit Product"
                                            onclick="editProduct({{ $product->id }}, '{{ $product->name }}', '{{ $product->price }}', '{{ addslashes($product->description) }}', '{{ $product->category }}')"
                                            popovertarget='my-popover'><i class="fa-solid fa-pen-to-square"
                                                style="color: #2bff00; font-size: 1.3rem;"></i>
                                        </button>

                                        <button type="button" class="border-0 bg-transparent" data-bs-toggle="modal"
                                            data-bs-target="#archiveModal"
                                            onclick="setArchiveProductId({{ $product->id }})" title="Archive Product">
                                            <i class="fa-solid fa-box-archive" style="font-size: 1.3rem"></i>
                                        </button>

                                        <button type="button" class="border-0 bg-transparent" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            onclick="setDeleteProductId({{ $product->id }})" title="Delete Product">
                                            <i class="fa-solid fa-trash" style="font-size: 1.3rem"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            @endif

            <div class="modal fade" id="add-product-modal" tabindex="-1" aria-labelledby="addProductModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="addProductModalLabel">Add New Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <form id="productForm" action="{{ route('addProducts') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="branch_id"
                                    value="{{ Auth::guard('branches')->user()->branch_id }}">
                                <input type="hidden" name="branch_name"
                                    value="{{ Auth::guard('branches')->user()->branch_name }}">

                                <div class="mb-3">
                                    <label class="form-label">Product Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter product name" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text">₱</span>
                                        <input type="number" name="price"
                                            class="form-control @error('price') is-invalid @enderror"
                                            placeholder="Enter price" value="{{ old('price') }}" min="1"
                                            max="99999"
                                            oninput="if(this.value.length > 5) this.value=this.value.slice(0,5)">
                                    </div>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Enter description" value="{{ old('description') }}"></textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                {{-- <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <select name="category"
                                        class="form-control mb-1 @error('category') is-invalid @enderror">
                                        <option value="">Select a category</option>
                                        <option value="Pizza" {{ old('category') == 'Pizza' ? 'selected' : '' }}>
                                            Pizza</option>
                                        <option value="Drink" {{ old('category') == 'Drink' ? 'selected' : '' }}>
                                            Drinks</option>
                                        <option value="Dessert" {{ old('category') == 'Dessert' ? 'selected' : '' }}>
                                            Dessert</option>
                                        <option value="Combo" {{ old('category') == 'Combo' ? 'selected' : '' }}>
                                            Combo</option>
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div> --}}


                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <input type="text" name="category"
                                        class="form-control @error('category') is-invalid @enderror"
                                        placeholder="Enter Category" value="{{ old('category') }}">
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">Product Image</label>
                                    <input type="file" id="images"
                                        class="form-control @error('image') is-invalid @enderror" name="image">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="mt-3">
                                        <img id="imagessss" class="img-preview img-fluid rounded"
                                            style="max-height: 100px;" src="" alt="">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end gap-2 mt-4">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-orange">
                                        <i class="fas fa-plus me-2"></i>Add Product
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



        </div>

        {{-- ArchiveButton --}}
        <div class="modal fade" id="archiveModal" tabindex="-1" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to <span style="color: rgb(255, 140, 0)">Archive</span> this product?
                    </div>
                    <div class="modal-footer">
                        <form id="archive-form" action="" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-warning">Archive</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>


        {{-- DeleteButton --}}
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to <span style="color: red">Delete</span> this product?
                    </div>
                    <div class="modal-footer">
                        <form id="delete-form" action="" method="POST" style="display: inline;">
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
                                <form action="{{ route('updateSpecialProduct', ['id' => $id]) }}" method="POST"
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
                                                max="99999"
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
        </div>
    </div>


    <script>
        const imagessss = document.getElementById("imagessss");
        const message = document.getElementById("message");

        let nameofFile = "";
        document
            .querySelector('input[type="file"]')
            .addEventListener("change", function() {
                if (this.files && this.files[0]) {
                    let img = document.querySelector("img");

                    img.onload = () => {
                        URL.revokeObjectURL(img.src);
                    };
                    img.src = URL.createObjectURL(this.files[0]);
                    console.log(this.files[0]);
                    imagessss.style.display = "inline-block";
                    subimage.style.display = "none";
                    imagelabel.textContent = this.files[0].name;
                }

                const getfilename = (event) => {
                    const files = event.target.files;
                    const fileName = files[0].name;
                    nameofFile = fileName;
                    console.log("file name: ", getfilename);
                };
            });

        document
            .getElementById("productForm")
            .addEventListener("submit", function(event) {
                event.preventDefault();

                const name = document.querySelector('input[name="name"]');
                const price = document.querySelector('input[name="price"]');
                const image = document.querySelector('input[name="image"]');
                const description = document.querySelector(
                    'textarea[name="description"]'
                );
                const category = document.querySelector('input[name="category"]');

                const inputs = [name, price, image];
                inputs.forEach((input) => {
                    input.classList.remove("is-invalid");
                    const feedback = input.nextElementSibling;
                    if (feedback && feedback.classList.contains("invalid-feedback")) {
                        feedback.remove();
                    }
                });
                let isValid = true;

                if (!name.value.trim()) {
                    showError(name, "Product name is required");
                    isValid = false;
                }

                if (!price.value.trim()) {
                    showError(price, "Price is required");
                    isValid = false;
                } else if (price.value <= 0) {
                    showError(price, "Price must be greater than 0");
                    isValid = false;
                }

                if (!image.files || !image.files[0]) {
                    showError(image, "Please select an image");
                    isValid = false;
                }

                if (!description.value.trim()) {
                    showError(description, "Description is required");
                    isValid = false;
                }

                if (!category.value.trim()) {
                    showError(category, "Category is required");
                    isValid = false;
                }

                if (isValid) {
                    this.submit();
                }
            });

        function showError(input, message) {
            input.classList.add("is-invalid");
            const errorDiv = document.createElement("div");
            errorDiv.className = "invalid-feedback";
            errorDiv.textContent = message;
            input.parentNode.insertBefore(errorDiv, input.nextSibling);
        }

        document.getElementById("images").onchange = function(evt) {
            const [file] = this.files;
            if (file) {
                document.getElementById("imagessss").src = URL.createObjectURL(file);
            }
        };

        document.getElementById("images").addEventListener("change", function(event) {
            const image = document.getElementById("imagessss");
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    image.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            const alerts = document.querySelectorAll(".alert-dismissible");
            alerts.forEach((alert) => {
                setTimeout(() => {
                    alert.classList.add("alert-fade-out");
                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                }, 3000);
            });
        });








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

        function setArchiveProductId(productId) {
            const form = document.getElementById('archive-form');
            form.action = `{{ url('archiveEachProduct') }}/${productId}`;
        }

        function setDeleteProductId(productId) {
            const form = document.getElementById('delete-form');
            form.action = `{{ url('deletedEachProduct') }}/${productId}`;
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


        function filterProducts(category, event) {
            document.querySelectorAll('nav .btn').forEach(btn => {
                btn.classList.remove('active');
            });

            event.target.classList.add('active');

            let table = document.getElementById('productTable');
            let tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                let categoryCell = tr[i].getElementsByTagName('td')[4];
                if (categoryCell) {
                    let categoryValue = categoryCell.textContent || categoryCell.innerText;

                    if (category === 'all' || categoryValue.trim() === category) {
                        tr[i].style.display = '';
                    } else {
                        tr[i].style.display = 'none';
                    }
                }
            }
        }

        document.getElementById('productForm').addEventListener('submit', (e) => {
            const inputs = document.querySelectorAll('input[type="text"], input[type="number"], textarea');
            inputs.forEach(input => {
                input.value = input.value.trim();
            });
        });

        document.getElementById('updateForm').addEventListener('submit', (e) => {
            const inputs = document.querySelectorAll('input[type="text"], input[type="number"], textarea');
            inputs.forEach(input => {
                input.value = input.value.trim();
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>



</body>

</html>
