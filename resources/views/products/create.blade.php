<x-master>
    <!-- ✅ Include Select2 CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>


        body {
            background: linear-gradient(135deg, #e0c446ff, #ffecb3);
        }

        .card-custom {
            background: linear-gradient(145deg, #d6a922ff, #ffecb3);
            border: 2px solid #b38b00;
            border-radius: 1rem;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .btn-warning-custom {
            background-color: #ffc107;
            color: #000;
            font-weight: bold;
            border-radius: 0.5rem;
            transition: 0.3s;
        }

        .btn-warning-custom:hover {
            background-color: #d4c329ff;
            color: #000;
        }

        input.form-control,
        select.form-control {
            color: #000 !important;
            font-weight: 500;
        }

        ::placeholder {
            color: #000 !important;
            opacity: 1;
        }

        .select2-selection__placeholder {
            color: #000 !important;
        }

        h5.fw-bold {
            color: #000 !important;
        }
    </style>

    <div class="container d-flex justify-content-center align-items-start mt-5">
        <div class="card shadow-lg p-4 card-custom" style="min-width: 420px;">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold text-dark mb-0">
                    {{ isset($product) ? '✏️ Edit Product' : '🟢 Add New Product' }}
                </h4>
                <button type="submit" form="productForm" class="btn btn-warning-custom px-3">
                    {{ isset($product) ? 'Update' : 'Save' }}
                </button>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success fw-bold text-center p-2 mb-3" id="successMessage">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Product Form -->
            <form id="productForm" action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST">
                @csrf
                @if(isset($product)) @method('PUT') @endif

                <div class="row">
                    <!-- Head Dropdown -->
                    <div class="col-md-6 mb-2">
                        <label class="form-label fw-bold text-dark">Select Head</label>
                        <select name="head_id" class="form-control form-control-sm select2 enter-field">
                            <option value="">-- Select Head --</option>
                            @php
                                $uniqueHeads = $heads->unique('head_name');
                            @endphp
                            @foreach($uniqueHeads as $head)
                                <option value="{{ $head->id }}"
                                    {{ (old('head_id', $product->head_id ?? '') == $head->id) ? 'selected' : '' }}>
                                    {{ $head->head_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('head_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-2">
                        <label class="form-label fw-bold text-dark">Product Name</label>
                        <input type="text" name="product_name" class="form-control form-control-sm enter-field"
                            value="{{ old('product_name', $product->product_name ?? '') }}" placeholder="Enter Product Name" required>
                        @error('product_name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-2">
                        <label class="form-label fw-bold text-dark">Manufacture</label>
                        <input type="text" name="manufacture" class="form-control form-control-sm enter-field"
                            value="{{ old('manufacture', $product->manufacture ?? '') }}" placeholder="Enter Manufacture">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label class="form-label fw-bold text-dark">Units</label>
                        <input type="number" name="units" class="form-control form-control-sm enter-field"
                            value="{{ old('units', $product->units ?? '') }}" placeholder="Enter Units" required>
                        @error('units') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-2">
                        <label class="form-label fw-bold text-dark">Price</label>
                        <input type="number" step="0.01" name="price" class="form-control form-control-sm enter-field"
                            value="{{ old('price', $product->price ?? '') }}" placeholder="Enter Price" required>
                        @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    
                </div>
            </form>
        </div>
    </div>

    <!-- ✅ JS Functionality -->
    <script>

        
        $(document).ready(function() {
            // ✅ Initialize Select2
            $('.select2').select2({
                placeholder: "-- Select Head --",
                allowClear: true,
                width: '100%'
            });

            // ✅ Auto-hide success message after 2 seconds
            setTimeout(() => {
                const msg = document.getElementById('successMessage');
                if (msg) msg.style.display = 'none';
            }, 2000);

            // ✅ Enable Enter key navigation + auto-submit on last field
            const inputs = $('.enter-field');
            inputs.on('keypress', function(e) {
                if (e.which === 13) {
                    e.preventDefault();
                    const index = inputs.index(this);
                    if (index < inputs.length - 1) {
                        inputs.eq(index + 1).focus();
                    } else {
                        $('#productForm').submit();
                    }
                }
            });
        });
    </script>
</x-master>
