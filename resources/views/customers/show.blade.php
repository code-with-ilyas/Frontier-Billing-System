<x-master>
    <style>
        body {
            overflow: hidden; /* disables both vertical and horizontal scroll */
        }
    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Card -->
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-warning text-dark fw-bold fs-4">
                       CUSTOMER DETAIL
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <h6 class="fw-bold text-dark">ID:</h6>
                            <p class="mb-0">{{ $customer->id }}</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="fw-bold text-dark">Customer Name:</h6>
                            <p class="mb-0">{{ $customer->customer_name }}</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="fw-bold text-dark">Description:</h6>
                            <p class="mb-0">{{ $customer->description }}</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="fw-bold text-dark">Starting Date:</h6>
                            <p class="mb-0">{{ $customer->starting_date }}</p>
                        </div>
                    </div>
                    <div class="card-footer bg-light text-end">
                        <a href="{{ route('customers.index') }}" class="btn btn-success text-black">
                            ⬅ Back to Customers
                        </a>
                    </div>
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>
    <style>
        body {
            overflow: hidden; /* disables both vertical and horizontal scroll */
        }
        .card-body h6 {
            color: #000 !important; /* heading labels pure black */
        }
        .card-body p {
            color: #000 !important; /* values pure black */
            font-weight: 500;
        }
    </style>
    </x-master>
    
