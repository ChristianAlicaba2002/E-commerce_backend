<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/storage/logo.png" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>All Don Macchiatos Products - Admin</title>
</head>
<style>
        :root {
        --primary-orange: #FFA500;
        --secondary-orange:  #4f2000;
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
    .menu-item:nth-child(3){
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
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .custom-alert {
        border-radius: 10px;
        border-left: 4px solid;
    }

    .alert-success {
        border-left-color: var(--primary-orange);
    }
    .popover-form{
        border-radius: 2rem;
        padding: 0.90rem 3rem;
        box-shadow: 1px 1px 20px var(--dark-bg);
    }
    .description{
        width: 45%;
        text-wrap: wrap;
    }
</style>
<body>

    
    <nav class="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-coffee me-2"></i>Don Macchiatos</h3>
        </div>
        <div class="sidebar-menu">
            <a href="{{route('HomePage')}}" class="menu-item">
                <i class="fa-solid fa-arrow-left"></i>Back to Home
            </a>
            <a href="{{'/DonMacPage'}}" class="menu-item">
                <i class="fas fa-home"></i>Dashboard
            </a>
            <a href="3" class="menu-item">
                <i class="fa-solid fa-shop"></i>Products
            </a>
        </div>
    </nav>
    
    <div class="main-content">
        <div class="table-container">
            <h2 class="mb-4">Don Macchiatos List</h2>
            @isset($products)
                <h6>Total Products: {{count($products)}}</h6>
            @endisset

            <input type="search" name="search" id="search" class="form-control mb-4" onkeyup="searchProduct()" placeholder="Search for a product">
        
                @if($products->isEmpty())
                        <div class="alert alert-warning">No products found in the database.</div>
                @else
                        @isset($products)
                            <h6>Sort by Name</h6>
                            <table class="table table-hover" id="productTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>  
                            <tbody>
                                @foreach($products->sortBy('name') as $product)
                                
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            <img src="{{ asset('/images/' . $product->image) }}" 
                                                alt="{{ $product->name }}" 
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td class="description">{{ $product->description }}</td>
                                        <td>₱{{ number_format($product->price, 2) }}</td>
                                        <td>
                                            <button class="btn btn-orange" {{$product->id}} popovertarget='my-popover'>Edit</button>
                                                <form action="{{ route('deleteEachDonmacchiatosProduct', ['id' => $product->id]) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                                </form>
                                        </td>
                                        </tr>
                                @endforeach
                        @endisset
                            </tbody>
                @endif
            </table>
    </div>
 
    <div class="popover-form" id="my-popover" popover>
        <div class="modal-dialog">
        <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Update Product</h5>
                    <button type="button" class="btn-close" popovertarget="my-popover"></button>
                </div>
                
                <div class="modal-body p-4">
                    <form action="/updateSpecialProduct" method="put" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price (₱)</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" placeholder="0.00" >
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" >
                        </div>
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="button" class="btn btn-secondary" popovertarget="my-popover">Cancel</button>
                            <button type="submit" class="btn btn-orange">Update Product</button>
                        </div>
                    </form>
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
        </script>
</body>
</html>