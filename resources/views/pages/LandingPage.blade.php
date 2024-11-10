<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/storage/logo.p" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Don Macchiatos</title>
    <style>
        :root {
            --primary-orange: #FFA500;
            --dark-bg: #1a1a1a;
            --light-orange: #FFB733;
        }
        
        body {
            background-color: var(--dark-bg);
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
        }

        .navbar {
            background-color: rgba(26, 26, 26, 0.95);
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--primary-orange) !important;
        }

        .hero-section {
            min-height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('/storage/hero-bg.jpg') center/cover;
            display: flex;
            align-items: center;
            padding: 100px 0;
        }

        .brand-orange {
            color: var(--primary-orange);
        }

        .btn-custom {
            background-color: var(--primary-orange);
            color: #000;
            padding: 15px 40px;
            border: none;
            border-radius: 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: var(--light-orange);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 165, 0, 0.3);
        }

        .hero-text {
            font-size: 1.25rem;
            font-weight: 300;
            max-width: 800px;
            margin: 0 auto;
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-orange);
            margin-bottom: 1.5rem;
        }

        .section-padding {
            padding: 100px 0;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.8s ease forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
  
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Don Macchiatos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <main>
       
        <section class="hero-section">
            <div class="container text-center">
                <div class="fade-in">
                    <h1 class="display-2 mb-4 fw-bold">Don Macchiatos</h1>
                    <p class="hero-text mb-5">
                        Experience the perfect blend of tradition and innovation. We source only the finest tea leaves, 
                        fresh milk, and natural ingredients to create extraordinary beverages that delight your senses.
                    </p>
                    <a href="{{ '/HomePage' }}" class="btn btn-custom">
                       Welcome Admin
                    </a>
                </div>
            </div>
        </section>


        <section class="section-padding">
            <div class="container">
                <div class="row text-center g-4">
                    <div class="col-md-4">
                        <div class="feature-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h3 class="h4 mb-3">Premium Quality</h3>
                        <p class=" text-white">Carefully selected ingredients for the perfect cup every time.</p>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-icon">
                            <i class="fas fa-mug-hot"></i>
                        </div>
                        <h3 class="h4 mb-3">Crafted with Care</h3>
                        <p class=" text-white">Each drink is prepared with attention to detail and passion.</p>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3 class="h4 mb-3">Customer First</h3>
                        <p class=" text-white">Your satisfaction is our top priority.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>