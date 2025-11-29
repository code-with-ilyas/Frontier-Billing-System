<x-master>
    <div class="container-fluid mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top py-2">
                        <h5 class="mb-0 text-dark fw-bold">ADD NEW CUSTOMER</h5>
                        <!-- <a href="{{ route('customers.index') }}" class="btn btn-warning btn-sm fw-bold">
                            CUSTOMERS LIST
                        </a> -->
                         <a href="{{ route('customers.index') }}" class="btn btn-danger btn-sm fw-bold">
                            CLOSE
                        </a>
                    </div>

                    <div class="card-body p-3">
                        <form action="{{ route('customers.store') }}" method="POST">
                            @csrf
                           
                            <div class="mb-2">
                                <label class="form-label fw-bold text-dark">Customer Name</label>
                                <input type="text" name="customer_name" class="form-control form-control-sm" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-bold text-dark">Description</label>
                                <textarea name="description" class="form-control form-control-sm" rows="2"></textarea>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-bold text-dark">Starting Date</label>
                                <input type="date" name="starting_date" class="form-control form-control-sm" required>
                            </div>
                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-success btn-sm rounded-pill">
                                    SAVE
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        input.form-control,
        textarea.form-control,
        select.form-control {
            color: #000 !important; /* force black text */
            font-weight: 500;
        }

        input::placeholder,
        textarea::placeholder {
            color: #555 !important; /* slightly lighter for placeholders */
        }
    </style>
</x-master>