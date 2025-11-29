<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>FRONTIER BILLING SYSTEM</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/assets/img/invoice.png') }}">

   
    <!-- Font Awesome icons (free version) -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Core theme CSS -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand fw-bold text-uppercase text-dark" href="#page-top">
                FRONTIER BILLING SYSTEM
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive">
                Menu <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('login') }}"
                            class="btn btn-dark fw-bold text-uppercase px-4 py-2 rounded-pill shadow-sm">
                            LOGIN
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Masthead -->
    <header class="masthead">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <h1 class="mx-auto my-0 text-uppercase fw-bold">Frontier Billing System</h1>
                    <h2 class="text-white-50 mx-auto mt-3 mb-4">
                        A modern and user-friendly billing solution to manage invoices, customers, and payments efficiently.
                    </h2>


                </div>
            </div>
        </div>
    </header>

    {{ $slot }}

</body>

</html>