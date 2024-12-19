<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/storage/logo.png" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Don Macchiatos - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>
<style>
    :root {
        --primary-orange: #FFA500;
        --secondary-orange: #4f2000;
        --dark-bg: #1a1a1a;
        --darker-bg: #141414;
        --lighter-bg: #2d2d2d;
        --lighter-font: #ffffff;
        --darker-font: rgb(0, 0, 0);
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

    .menu-item:nth-child(2) {
        background: var(--primary-orange);
        color: var(--lighter-font)
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


    .dashboard-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
        transition: 0.3s ease-in-out;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        background-color: var(--primary-orange);
        color: var(--lighter-font);
    }

    .card-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 15px;
    }

    .bg-orange {
        background: var(--primary-orange);
        color: white;
    }


    .form-container {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }

    .form-control:focus {
        border-color: var(--primary-orange);
        box-shadow: 0 0 0 0.2rem rgba(255, 107, 0, 0.25);
    }

    .btn-orange {
        background: var(--primary-orange);
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 5px;
        transition: all 0.3s;
    }

    .btn-orange:hover {
        background: #ffb62f;
        transform: translateY(-2px);
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
        margin: 2% 0 0 6%;
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
    <div class="wrapper">

        <nav class="sidebar">
            <div class="sidebar-header">
                <h3><i class="fas fa-coffee me-2"></i>Don Macchiatos</h3>
            </div>
            <div class="sidebar-menu">
                <a href="{{ route('LoginPage') }}" class="menu-item">
                    <i class="fa-solid fa-arrow-left"></i>Back to Home
                </a>
                <div class="dropdown">
                    <a href="#" class="menu-item dropdown-toggle" id="deletedDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-shop"></i>Add Products
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="deletedDropdown">
                        <li><a class="dropdown-item" href="{{ '/DonMacPage' }}">Don Macchiatos</a></li>
                        <li><a class="dropdown-item" href="{{ '/SpecialProductPage' }}">Special Products</a></li>
                    </ul>
                </div>


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

            </div>
        </nav>


        <div class="main-content">

            <div class="row mb-4 ">

                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="card-icon bg-orange">
                            <i class="fas fa-box"></i>
                        </div>
                        <h4>Total Products</h4>
                        @isset($products)
                            @if ($products->isEmpty())
                                <h2>0</h2>
                            @else
                                <h2>{{ count($products) }}</h2>
                            @endif
                        @endisset
                        <p class="">Available Products 🛒</p>

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="card-icon bg-orange">
                            <i class="fas fa-peso-sign"></i>
                        </div>
                        <h4>Revenue</h4>
                        @isset($quantity)
                            @php
                                $totalRevenue = 0;
                                if (!empty($quantity)) {
                                    $totalRevenue = $quantity * 24;
                                }
                            @endphp
                            <h2>₱{{ number_format($totalRevenue, 2) }}</h2>
                            <p class="">1 year🛃</p>
                        @endisset
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="card-icon bg-orange">
                            <i class="fas fa-crown"></i>
                        </div>
                        <h4>Best Seller</h4>
                        @isset($bestSeller)
                            @foreach ($bestSeller as $bs)
                                @if ($bs->quantity === 0)
                                    <h5>No best seller yet</h5>
                                @elseif ($bs->quantity >= 20)
                                    <h3>{{ $bs->name }}</h3>
                                    <p>{{ $bs->quantity }}+ orders this month 💛</p>
                                @endif
                            @endforeach
                            @if (count($bestSeller) === 0)
                                <h5>No products available</h5>
                            @endif
                        @endisset
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="card-icon bg-orange">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Customers</h4>
                        @isset($customers)
                            <h2>+{{ count($customers) }}</h2>
                            <p class="">Total Customers 🧑🏻‍🦱</p>
                        @endisset
                    </div>
                </div>
            </div>


            @if (session('success'))
                <div class="alert alert-success custom-alert alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif


            @if (session('error'))
                <div class="alert custom-alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif


            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="form-container">
                        <h3 class="mb-4"><i class="fas fa-plus-circle me-2"></i>Add New Product</h3>
                        <form id="productForm" action="/addDonMacProducts" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Product Name</label>
                                <input type="text" name="name" maxlength="50"
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
                                        placeholder="Enter price" value="{{ old('price') }}"min="1" max="99999"
                                        oninput="if(this.value.length > 5) this.value=this.value.slice(0,5)">
                                </div>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Enter description">{{ old('description') }}</textarea>
                                @error('description')
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
                                        style="max-height: 200px;" src="" alt="">
                                </div>
                            </div>
                            <div class="text-end">
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

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
    </script>
</body>

</html>
