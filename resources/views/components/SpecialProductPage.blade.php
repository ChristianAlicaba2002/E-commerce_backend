<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/storage/logo.png" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Special Products - Admin Dashboard</title>
</head>
<style>
    :root {
        --primary-orange: #ff6b00;
        --dark-bg: #1a1a1a;
        --darker-bg: #141414;
        --lighter-bg: #2d2d2d;
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

    .menu-item:hover {
        background: var(--primary-orange);
        color: white;
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
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
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
        box-shadow: 0 2px 15px rgba(0,0,0,0.1);
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
        background: #ff8533;
        transform: translateY(-2px);
    }

    .table-container {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }


    .custom-alert {
        border-radius: 10px;
        border-left: 4px solid;
    }

    .alert-success {
        border-left-color: var(--primary-orange);
    }
</style>

<body>
    <div class="wrapper">
     
        <nav class="sidebar">
            <div class="sidebar-header">
                <h3><i class="fa-brands fa-product-hunt"></i>Special Products</h3>
            </div>
            <div class="sidebar-menu">
                <a href="{{route('HomePage')}}" class="menu-item">
                    <i class="fa-solid fa-arrow-left"></i>Back to Home
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-home"></i>Dashboard
                </a>
            </div>
        </nav>

       
        <div class="main-content">
            
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="card-icon bg-orange">
                            <i class="fas fa-box"></i>
                        </div>
                        <h4>Total Products</h4>
                        @isset($products)
                        <h2>{{$products}}</h2>
                        @endisset
                            <h2>12</h2>
                            <p class="text-muted">+124124124124% from last month</p>          
                    
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="card-icon bg-orange">
                            <i class="fas fa-peso-sign"></i>
                        </div>
                        <h4>Revenue</h4>
                        <h2>₱25,000</h2>
                        <p class="text-muted">Today's earnings Wala gyapon</p>
                    </div>
                </div>
                {{-- <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="card-icon bg-orange">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h4>Orders</h4>
                        <h2>45</h2>
                        <p class="text-muted">Pending orders</p>
                    </div>
                </div> --}}
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="card-icon bg-orange">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Customers</h4>
                        <h2>1,250</h2>
                        <p class="text-muted">Total registered Wala gyapon</p>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert custom-alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="form-container">
                        <h3 class="mb-4"><i class="fas fa-plus-circle me-2"></i>Add New Product</h3>

                        <form id="productForm" action="/addspecialproducts" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Product Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                    placeholder="Enter product name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" 
                                        placeholder="Enter price" value="{{ old('price') }}">
                                </div>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Product Image</label>
                                <input type="file" id="images" class="form-control " name="image">
                                @error('image') is-invalid @enderror
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="mt-3">
                                    <img id="imagessss" class="img-preview img-fluid rounded" style="max-height: 200px;" src="" alt="">
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
    <script src="{{asset('homepage.js')}}"></script>
</body>
</html>
