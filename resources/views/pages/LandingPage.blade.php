<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/storage/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"
        integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Don Macchiatos - Admin</title>
    <style>
        :root {
            --primary-orange: #FF8C00;
            --dark-black: #1a1a1a;
        }

        body {
            background-color: var(--dark-black);
            font-family: 'Poppins', sans-serif;
        }

        .hero-section {
            min-height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                url('/storage/hero-bg.jpg') center/cover;
        }

        .text-orange {
            color: #FFA500 !important;
        }

        .bg-dark-custom {
            background-color: rgba(26, 26, 26, 0.95);
        }

        .btn-orange {
            background-color: #FFA500;
            color: #000;
            transition: all 0.3s ease;
        }

        .btn-orange:hover {
            background-color: #FFB733;
            transform: translateY(-2px);
        }

        .fade-in {
            animation: fadeIn 0.8s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }



        .auth-popover {
            background-color: var(--dark-black);
            border: 1px solid var(--primary-orange);
            border-radius: 15px;
            padding: 20px;
            min-width: 30%;
        }
    </style>
</head>

<body class="text-white">


    <nav class="navbar navbar-expand-lg fixed-top bg-dark-custom">
        <div class="container">
            <a class="navbar-brand text-orange" href="/">Don Macchiatos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>


    <main>
        <section class="hero-section d-flex align-items-center">
            <div class="container text-center">

                <div class="fade-in">



                    <h1 class="display-2 mb-4 fw-bold" style="font-family: 'Playfair Display', serif;">Don Macchiatos
                    </h1>
                    <p class="lead mb-5 mx-auto" style="max-width: 800px;">
                        We source only the highest quality tea leaves, fresh milk, and natural ingredients to bring you
                        a rich, authentic taste with every sip. From classic flavors to creative,<br><span
                            class="text-orange">" DON MACCHIATOS "</span> guarantees a taste that delights.
                    </p>
                    <a href="/LoginPage" class="text-black">
                        <button class="btn btn-orange btn-lg rounded-pill px-5 py-3 fw-semibold text-uppercase">
                            Welcome Admin
                        </button>
                    </a>

                </div>
            </div>
        </section>

        <section class="py-5">
            <div class="container">
                <div class="row text-center g-4">
                    <div class="col-md-4">
                        <div class="mb-4">
                            <i class="fas fa-leaf text-orange fs-1"></i>
                        </div>
                        <h3 class="h4 mb-3" style="font-family: 'Playfair Display', serif;">Premium Quality</h3>
                        <p>Carefully selected ingredients for the perfect cup every time.</p>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-4">
                            <i class="fas fa-mug-hot text-orange fs-1"></i>
                        </div>
                        <h3 class="h4 mb-3" style="font-family: 'Playfair Display', serif;">Crafted with Care</h3>
                        <p>Each drink is prepared with attention to detail and passion.</p>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-4">
                            <i class="fas fa-heart text-orange fs-1"></i>
                        </div>
                        <h3 class="h4 mb-3" style="font-family: 'Playfair Display', serif;">Customer First</h3>
                        <p>Your satisfaction is our top priority.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script></script>

</body>

</html>
