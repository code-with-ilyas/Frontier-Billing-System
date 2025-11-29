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
            border: 2px solid #b38b00;
            border-radius: 1rem;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .card-header-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-warning-custom {
            background-color: #ffc107;
            border: none;
            color: #000;
            font-weight: bold;
            border-radius: 0.5rem;
            transition: 0.3s ease-in-out;
        }

        .btn-warning-custom:hover {
            background-color: #d4c329ff;
            color: #000;
        }
    </style>

    <div class="container d-flex justify-content-center align-items-start vh-100">
        <div class="card shadow-lg p-4 card-custom mt-5" style="min-width: 420px;">

            <!-- Card Header -->
            <div class="card-header-custom mb-3">
                <h4 class="mt-2 fw-bold text-dark mb-0">🚗 EDIT VEHICLE</h4>
                <button type="submit" form="vehicleForm" class="btn btn-warning-custom px-3">Update</button>
            </div>

            <hr class="hr-heading">

            <!-- Vehicle Edit Form -->
            <form id="vehicleForm" action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold text-dark">Customer Name:</label>
                    <input type="text" name="customer_name" class="form-control border-dark"
                           value="{{ $vehicle->customer_name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-dark">Vehicle Number:</label>
                    <input type="text" name="vehicle_number" class="form-control border-dark"
                           value="{{ $vehicle->vehicle_number }}" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('vehicles.index') }}" class="btn btn-warning-custom px-3">Back</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // ✅ Enter key navigation for form inputs
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('vehicleForm');
            const inputs = Array.from(form.querySelectorAll('input, select, textarea'));

            inputs.forEach((input, index) => {
                input.addEventListener('keydown', function (event) {
                    if (event.key === 'Enter') {
                        event.preventDefault(); // Stop normal form submission

                        const nextInput = inputs[index + 1];

                        if (nextInput) {
                            nextInput.focus(); // Move to next field
                        } else {
                            form.submit(); // If last field → submit form
                        }
                    }
                });
            });
        });
    </script>
</x-master>
