<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>FRONTIER BILLING SYSTEM</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('admin_assets/img/invoice.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@600;700&family=Open+Sans&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('admin_assets/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('admin_assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('admin_assets/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Topbar Start -->
    <div class="container-fluid bg-secondary top-bar wow fadeIn" data-wow-delay="0.1s">
        <div class="row align-items-center h-100">
            <div class="col-lg-4 text-center text-lg-start">

                <h4 class="text-primary m-0">FRONTIER BILLING SYSTEM</h4>


            </div>
            <div class="col-lg-8 d-none d-lg-block">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="d-flex justify-content-end">
                            <div class="flex-shrink-0 btn-square bg-primary">
                                <i class="fa fa-phone-alt text-dark"></i>
                            </div>
                            <div class="ms-2">
                                <h6 class="text-primary mb-0">Call Us</h6>
                                <span class="text-white">0349-7871912</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="d-flex justify-content-end">
                            <div class="flex-shrink-0 btn-square bg-primary">
                                <i class="fa fa-envelope-open text-dark"></i>
                            </div>
                            <div class="ms-2">
                                <h6 class="text-primary mb-0">Mail Us</h6>
                                <span class="text-white">net3ilyas@gmail.com</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="d-flex justify-content-end">
                            <div class="flex-shrink-0 btn-square bg-primary">
                                <i class="fa fa-map-marker-alt text-dark"></i>
                            </div>
                            <div class="ms-2">
                                <h6 class="text-primary mb-0">Address</h6>
                                <span class="text-white">Peshawer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid bg-secondary px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="nav-bar">
            <nav class="navbar navbar-expand-lg bg-primary navbar-dark px-4 py-lg-0">
                <h4 class="d-lg-none m-0">Menu</h4>
                <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav me-auto">

                        <!-- 🔹 Customer Dropdown -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Customer</a>
                            <div class="dropdown-menu bg-light m-0">
                                <!-- <a href="{{ route('customers.create') }}" class="dropdown-item fw-bold text-dark">Add New Customer</a>
                                <a href="{{ route('customers.index') }}" class="dropdown-item fw-bold text-dark">Customers List</a> -->
                                <a href="{{ route('vehicles.create') }}" class="dropdown-item fw-bold text-dark">Add Customers & Vehicle Names</a>
                                <a href="{{ route('vehicles.index') }}" class="dropdown-item fw-bold text-dark">Vehicles & Customers List</a>
                                <a href="{{ route('heads.create') }}" class="dropdown-item fw-bold text-dark">Add Heads</a>
                            </div>
                        </div>

                        <!-- 🔹 Product Dropdown -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Product</a>
                            <div class="dropdown-menu bg-light m-0">
                                <a href="{{ route('products.create') }}" class="dropdown-item fw-bold text-dark">Add New Products</a>
                                <a href="{{ route('products.index') }}" class="dropdown-item fw-bold text-dark">Products List</a>
                            </div>
                        </div>

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Daily Sale</a>
                            <div class="dropdown-menu bg-light m-0">
                                <a href="{{ route('sales.create') }}" class="dropdown-item fw-bold text-dark">Add New Sale</a>
                                <a href="{{ route('sales.index') }}" class="dropdown-item fw-bold text-dark">Sales List</a>
                            </div>
                        </div>

                        <!-- 🔹 Reports Dropdown -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Reports</a>
                            <div class="dropdown-menu bg-light m-0">
                                <a href="{{ route('sales.form') }}" class="dropdown-item fw-bold text-dark ">Daily Reports Of Bills</a>
                                <a href="{{ route('sales.report') }}" class="dropdown-item fw-bold text-dark">Generate Bills For Customer Name</a>
                                <a href="{{ route('vehicle.bills') }}" class="dropdown-item fw-bold text-dark">Generate Bills For Vehicle Name</a>
                                <a href="{{ route('saved.bills') }}" class="dropdown-item fw-bold text-dark">Generated Bills Saved History</a>
                                <a href="{{ route('heads.report') }}" class="dropdown-item fw-bold text-dark">Heads & Products Reports</a>
                            </div>
                        </div>

                    </div>

                    <!-- 🔹 Logout Button -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-warning rounded-pill px-4">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->



    {{ $slot }}

    <!-- JavaScript Libraries -->
    <script src="{{ asset('admin_assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_assets/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('admin_assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('admin_assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('admin_assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('admin_assets/js/main.js') }}"></script>
</body>

</html>