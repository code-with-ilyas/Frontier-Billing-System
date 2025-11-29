<x-master>
    <style>
        body {
            overflow: hidden;
            background: linear-gradient(135deg, #e0c446ff, #ffecb3);
        }

        .hr-heading {
            border: none;
            height: 3px;
            margin: 0.8rem auto 1rem;
            width: 80%;
            border-radius: 50px;
            background: linear-gradient(to right, transparent, #b38b00, transparent);
            opacity: 0.8;
        }

        .card-custom {
            background: linear-gradient(145deg, #d6a922ff, #ffecb3);
            /* soft warning gradient */
            border: 2px solid #b38b00;
            border-radius: 1rem;
            /* smooth rounded corners */
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .card-header-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Custom button styles */
        .btn-warning-custom {
            background-color: #ffc107;
            /* Bootstrap warning */
            border: none;
            color: #000;
            font-weight: bold;
            border-radius: 0.5rem;
            transition: 0.3s ease-in-out;
        }

        .btn-warning-custom:hover {
            background-color: #d4c329ff;
            /* light yellow */
            color: #000;
        }
    </style>

    <div class="container d-flex justify-content-center align-items-start vh-100">
        <div class="card shadow-lg p-4 card-custom mt-5" style="min-width: 420px;">

            <!-- Card Header -->
            <div class="card-header-custom mb-3">
                <h4 class="mt-2 fw-bold text-dark mb-0">📊 DAILY REPORTS</h4>
                <button type="submit" form="reportForm" class="btn btn-warning-custom px-3">View</button>
            </div>

            <hr class="hr-heading">

            <!-- Form -->
            <form id="reportForm" method="GET" action="{{ route('sales.view') }}">
                <div class="mb-3">
                    <label for="customer_name" class="form-label fw-bold text-dark">Customer Name:</label>
                    <select class="form-control border-dark" name="customer_name" id="customer_name" required>
                        <option value="">-- Select Customer --</option>
                        @foreach($customers as $customer)
                        <option value="{{ $customer->customer_name }}">{{ $customer->customer_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label fw-bold text-dark">Starting:</label>
                    <input type="date" name="date" id="date" class="form-control border-dark" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="" class="btn btn-warning-custom px-3">Close</a>
                </div>
            </form>
        </div>
    </div>
</x-master>