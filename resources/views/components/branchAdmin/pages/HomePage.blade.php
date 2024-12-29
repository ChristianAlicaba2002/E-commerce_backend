    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" href="/storage/logo.png" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <style>
            .hero-section {
                background: linear-gradient(#FFA500, rgba(0, 0, 0, 0.804)),
                    url('/storage/coffee-bg.jpg') center/cover;
                /* background-image: url('/images/backgroundContact.jpg'); */
                height: 100vh;
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
            }

            .nav-link {
                color: white;
                font-size: 1.2rem;
                margin: 0 1rem;
                transition: all 0.3s ease;
            }

            .nav-link:hover {
                color: #221e19;
                transition: all 0.3s ease-in-out;
                transform: translateY(-2px);
            }

            .about-section {
                padding: 5rem 0;
                background-color: #d49f75;
            }

            .coffee-card {
                border-radius: 15px;
                overflow: hidden;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease;
            }

            .coffee-card:hover {
                transform: translateY(-10px);
            }

            .coffee-card img {
                max-width: 100%;
                height: auto;
            }

            @media (max-width: 768px) {
                .hero-section {
                    height: 80vh;
                    padding: 2rem 1rem;
                    text-align: center;
                }

                .nav-link {
                    font-size: 1rem;
                    margin: 0.5rem 0;
                }

                .about-section {
                    padding: 2rem 1rem;
                }

                .coffee-card {
                    margin-bottom: 1rem;
                    width: 100%;
                }

                .coffee-card img {
                    width: 100%;
                    height: auto;
                }
            }

            @media (max-width: 576px) {
                .hero-section h1 {
                    font-size: 1.5rem;
                }

                .hero-section p {
                    font-size: 1rem;
                }
            }
        </style>
    </head>

    <body>
        @section('content')
        
            <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ '/' }}">
                        <img class="logo rounded-circle" src="/storage/logo.png" alt="Don Macchiatos Logo" height="40">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <div class="navbar-nav ms-auto">
                            <a class="nav-link" href="{{ 'DonMacAllProducts' }}">Dashboard</a>
                            <a class="nav-link" href="{{ 'OrdersPage' }}">Orders</a>
                        </div>

                    </div>
                    <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <i class="fa-solid fa-right-from-bracket" style="color: #ff0000; font-size: 1.5rem; margin-right: 10px; margin-top: 5px"></i>
                    </button>

                </div>
            </nav>
            <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-black" id="logoutModalLabel">Confirm Logout</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5 style="color: red;">Are you sure you want to logout?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                            <button type="button" class="btn btn-primary"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <section class="hero-section">
                <div class="container text-center">
                <h1 class="mb-4" data-aos="fade-down">{{ Auth::guard('branches')->user()->branch_name }} <i class="fa-solid fa-house"></i></h1>
                    <h1 class="display-1 mb-4" data-aos="fade-down">Don Macchiatos</h1>
                    <p class="lead mb-4" data-aos="fade-up" data-aos-delay="200">
                        Crafting Perfect Moments, One Cup at a Time
                    </p>
                </div>
            </section>



            <section class="about-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6" data-aos="fade-right">
                            <h2 class="mb-4">Welcome to Don Macchiatos</h2>
                            <p class="lead">
                                At Don Macchiatos, we believe in the art of coffee making. Our passion for quality coffee
                                began in 2010, and since then, we've been serving the finest coffee experiences to our
                                valued customers.
                            </p>
                            <p>
                                We carefully select premium coffee beans from sustainable sources around the world and
                                roast them to perfection. Our skilled baristas craft each drink with precision and care,
                                ensuring every sip is a moment to remember.
                            </p>
                        </div>
                        <div class="col-md-6" data-aos="fade-left">
                            <div class="row">
                                <div class="col-12 col-md-6 mb-4">
                                    <div class="coffee-card">
                                        <img src="/storage/coffee1.jpg" alt="Coffee" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-4">
                                    <div class="coffee-card">
                                        <img src="/storage/coffee2.jpg" alt="Coffee" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endsection




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({
                duration: 1000,
                once: true
            });

            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    document.querySelector('.navbar').style.backgroundColor = ' #FFA500';
                } else {
                    document.querySelector('.navbar').style.backgroundColor = 'transparent';
                }
            });
        </script>
    </body>

    </html>
