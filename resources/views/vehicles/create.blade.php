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
                <h4 class="mt-2 fw-bold text-dark mb-0">🚗 ADD VEHICLE</h4>
                <button type="submit" form="vehicleForm" class="btn btn-warning-custom px-3">Save</button>
            </div>

            <hr class="hr-heading">

            <!-- ✅ Success Message -->
            @if(session('success'))
            <div class="alert alert-success fw-bold text-center p-2 mb-3" id="successMessage">
                {{ session('success') }}
            </div>
            @endif

            <!-- Vehicle Form -->
            <form id="vehicleForm" action="{{ route('vehicles.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold text-dark">Customer Name:</label>
                    <input type="text" name="customer_name" class="form-control border-dark enter-field" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-dark">Vehicle Number:</label>
                    <input type="text" name="vehicle_number" class="form-control border-dark enter-field" required>
                </div>


            </form>
        </div>
    </div>

    <script>
        // ✅ Auto-hide success message after 2 seconds
        setTimeout(() => {
            const msg = document.getElementById('successMessage');
            if (msg) msg.style.display = 'none';
        }, 2000);

        // ✅ Enable "Enter to go next field", and auto-submit on last field
        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('.enter-field');
            inputs.forEach((input, index) => {
                input.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        if (index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        } else {
                            document.getElementById('vehicleForm').submit();
                        }
                    }
                });
            });
        });
    </script>
</x-master>