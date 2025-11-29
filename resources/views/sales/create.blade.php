<x-master>
    <!-- Include Select2 CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        body {
            background: linear-gradient(135deg, #fff9c4, #ffecb3);
        }

        .card-custom {
            background: linear-gradient(145deg, #fff8dc, #ffe082);
            border-radius: 1rem;
            border: 2px solid #b38b00;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            padding: 1rem;
            height: 100%;
        }

        .card-header-custom {
            background-color: #f9e79f;
            color: #5a4d00;
            font-weight: 700;
            border-radius: 0.5rem;
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

        .btn-gold {
            background: linear-gradient(135deg, #ffc107, #ffdb58);
            color: #000;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-gold:hover {
            background: linear-gradient(135deg, #ffcd38, #f5b700);
            transform: scale(1.05);
        }

    .table th {
    background-color: #f9e79f;
    color: #5a4d00;
    text-align: center;
    font-weight: 700;
    white-space: nowrap;
    vertical-align: middle;
    font-size: 0.72rem; /* ✅ optional: smaller header text */
}


        .table td {
            vertical-align: middle;
            text-align: center;
            font-weight: 500;
        }

        .table-hover tbody tr:hover {
            background-color: #fff9c4;
        }

        .select2-container--default .select2-selection--single {
            height: 35px;
            border-radius: 0.5rem;
            border: 1px solid #b38b00;
        }

        select.form-control,
        input.form-control {
            border-radius: 0.5rem;
            border: 1px solid #b38b00;
        }

        .form-label {
            font-weight: bold;
            color: #000;
        }

        .table-container {
            overflow-x: auto;
        }

        .sale-form-row {
            display: flex;
            gap: 1rem;
        }

        .sale-form-row .form-group {
            flex: 1;
        }

        #saleTable,
        #headItemsTable {
            table-layout: fixed;
            word-wrap: break-word;
        }

        .h-100 {
            min-height: 300px;
        }
    </style>

    <div class="container-fluid mt-2">
        <div class="row g-3 h-100">

            <!-- LEFT: Sale Form -->
            <div class="col-md-4">
                <div class="card shadow-sm card-custom h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fw-bold text-dark mb-0">🟡 ADD SALE</h4>
                        <button type="submit" form="saleForm" class="btn btn-warning-custom px-3" id="saveBtn">Save Sale</button>
                    </div>

                    <form id="saleForm" method="POST" action="{{ route('sales.store') }}">
                        @csrf

                        <div class="sale-form-row mb-2">
                            <div class="form-group">
                                <label class="form-label">Entry Date</label>
                                <input type="text" name="entry_date" id="entry_date" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Issue Date</label>
                                <input type="text" name="issue_date" id="issue_date" class="form-control form-control-sm" required>
                            </div>
                        </div>

                        <div class="sale-form-row mb-2">
                            <div class="form-group">
                                <label class="form-label">Bill Month</label>
                                <input type="text" name="bill_month" id="bill_month" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Bill Year</label>
                                <input type="text" name="bill_year" id="bill_year" class="form-control form-control-sm" required>
                            </div>
                        </div>

                        <div class="sale-form-row mb-2">
                            <div class="form-group">
                                <label class="form-label">Customer Name</label>
                                <select name="customer_name" id="customerSelect" class="form-control form-control-sm select2" required>
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->customer_name }}">{{ $customer->customer_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Vehicle Number</label>
                                <select name="vehicle_number" id="vehicleSelect" class="form-control form-control-sm select2">
                                    <option value="">Select Vehicle</option>
                                    @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->vehicle_number }}">{{ $vehicle->vehicle_number }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="sale-form-row mb-2">
                            <div class="form-group">
                                <label class="form-label">Select Head</label>
                                <select name="head_id" id="headSelect" class="form-control form-control-sm select2" required>
                                    <option value="">Select Head</option>
                                    @foreach($heads as $head)
                                    <option value="{{ $head->id }}">{{ $head->head_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- ✅ Product fields moved inside sale form -->
                        <div class="sale-form-row mb-2">
                            <div class="form-group">
                                <label class="form-label fw-bold text-dark">Product</label>
                                <select name="product_id" id="productSelect" class="form-control form-control-sm select2" required>
                                    <option value="">Select Product</option>
                                    @isset($products)
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                        {{ $product->product_name }}
                                    </option>
                                    @endforeach
                                    @endisset
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label fw-bold text-dark">Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control form-control-sm" min="1" value="1" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label fw-bold text-dark">Rate</label>
                                <input type="number" name="rate" id="rate" step="0.01" class="form-control form-control-sm" value="0" required>
                            </div>
                        </div>

                        <div class="text-end mb-2">
                            <button type="button" class="btn btn-gold btn-sm fw-bold" id="addItem">Add Item</button>
                        </div>

                        <div id="saleItemsData"></div>
                    </form>
                </div>
            </div>

            <!-- MIDDLE: Sale Table -->
            <div class="col-md-6">
                <div class="card shadow-sm card-custom h-100">
                    <div class="card-header card-header-custom fw-bold">SALE & PRODUCT DETAILS</div>
                    <div class="card-body p-2">
                        <div class="table-container mt-2">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-sm align-middle text-center" id="saleTable" style="font-size: 0.7rem;">
                                    <thead class="table-light" style="font-size: 0.7rem;">
                                        <tr>
                                            <th>S.No</th>
                                            <th>Issue Date</th>
                                            <th>Customer</th>
                                            <th>Vehicle</th>
                                            <th>Head</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Rate</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 0.65rem;"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Head Items -->
            <div class="col-md-2 ms-auto">
                <div class="card shadow-sm card-custom" style="height:auto; max-height:250px; min-width:150px;">
                    <div class="card-header card-header-custom fw-bold text-center">Head Products</div>
                    <div class="card-body p-1" style="overflow-y:auto; max-height:200px;">
                        <table class="table table-bordered table-hover table-sm mb-0" id="headItemsTable" style="font-size:0.7rem;">
                            <thead>
                                <tr><th>S.NO</th><th>Product</th></tr>
                            </thead>
                            <tbody><tr><td colspan="2" class="text-center p-1">Select a head</td></tr></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

      
        <script>
            // === Auto-focus next after Select2 selection ===
            $('#saleForm .select2').on('select2:close', function() {
                let inputs = $('#saleForm').find('input, select');
                let idx = inputs.index(this);
                if (idx >= 0 && idx < inputs.length - 1) {
                    inputs.eq(idx + 1).focus();
                }
            });

            $(document).ready(function() {

                function formatToday() {
                    let today = new Date();
                    let dd = String(today.getDate()).padStart(2, '0');
                    let mm = String(today.getMonth() + 1).padStart(2, '0');
                    let yyyy = today.getFullYear();
                    return `${dd}/${mm}/${yyyy}`;
                }

                $('#entry_date').val(formatToday());
                $('#issue_date').val(formatToday());
                $('#bill_month').val(new Date().toLocaleString('default', {
                    month: 'long'
                }));
                $('#bill_year').val(new Date().getFullYear());

                $('.select2').select2({
                    placeholder: "Select an option",
                    allowClear: true
                });

                $('#customerSelect').on('change', function() {
                    let customerName = $(this).val();
                    let vehicleSelect = $('#vehicleSelect');
                    vehicleSelect.html('<option value="">Select Vehicle</option>');
                    if (customerName) {
                        $.ajax({
                            url: '/get-vehicles/' + customerName,
                            type: 'GET',
                            success: function(vehicles) {
                                if (vehicles.length > 0) {
                                    vehicles.forEach(vehicle => {
                                        vehicleSelect.append(`<option value="${vehicle.id}">${vehicle.vehicle_number}</option>`);
                                    });
                                } else {
                                    vehicleSelect.append('<option value="">No vehicles found</option>');
                                }
                            },
                            error: function() {
                                alert('Error loading vehicles.');
                            }
                        });
                    }
                });

                $(document).on('keydown', 'input, select', function(e) {
                    if (e.key === "Enter") {
                        e.preventDefault();
                        let inputs = $('input, select, button').filter(':visible');
                        let idx = inputs.index(this);
                        if (idx > -1 && (idx + 1) < inputs.length) {
                            inputs.eq(idx + 1).focus();
                        }
                    }
                });

                $('#productSelect').on('change', function() {
                    let price = $(this).find(':selected').data('price') || 0;
                    $('#rate').val(price);
                });

                let counter = 1;
                let saleItems = [];

                $('#headSelect').on('change', function() {
                    let headId = $(this).val();
                    loadHeadProducts(headId);
                });

                $('#addItem').on('click', function() {
                    addSaleItem();
                    $('#quantity').val('1');
                    $('#entry_date').val(formatToday()).focus();
                });

                $('#saleForm').on('submit', function(e) {
                    if (saleItems.length === 0) {
                        e.preventDefault();
                        alert('Please add at least one sale item before saving.');
                        return false;
                    }
                    return true;
                });

                function loadHeadProducts(headId) {
                    let tableBody = $('#headItemsTable tbody');
                    let productSelect = $('#productSelect');

                    tableBody.html('<tr><td colspan="2" class="text-center">Loading products...</td></tr>');
                    productSelect.html('<option value="">Select Product</option>');

                    if (headId) {
                        $.ajax({
                            url: '{{ url("/head-products") }}/' + headId,
                            type: 'GET',
                            success: function(data) {
                                tableBody.html('');
                                if (data.length > 0) {
                                    data.forEach((item) => {
                                        tableBody.append(`<tr><td>${item.id}</td><td>${item.product_name}</td></tr>`);
                                        productSelect.append(`<option value="${item.id}" data-price="${item.price}">${item.id} - ${item.product_name}</option>`);
                                    });
                                } else {
                                    tableBody.html('<tr><td colspan="2" class="text-center">No products found</td></tr>');
                                }
                            },
                            error: function(xhr) {
                                console.error(xhr);
                                tableBody.html('<tr><td colspan="2" class="text-center text-danger">Failed to load products</td></tr>');
                            }
                        });
                    } else {
                        tableBody.html('<tr><td colspan="2" class="text-center">Select a head to view products</td></tr>');
                    }
                }

                function addSaleItem() {
                    let issueDate = $('[name="issue_date"]').val();
                    let customerId = $('#customerSelect').val();
                    let customerName = $('#customerSelect option:selected').text();
                    let vehicleId = $('#vehicleSelect').val();
                    let vehicleText = $('#vehicleSelect option:selected').text();
                    let headId = $('#headSelect').val();
                    let headText = $('#headSelect option:selected').text();
                    let productId = $('#productSelect').val();
                    let productText = $('#productSelect option:selected').text();
                    let qty = $('#quantity').val();
                    let rate = $('#rate').val();
                    let amount = (qty * rate).toFixed(2);

                    if (!issueDate || !customerId || !headId || !productId || qty <= 0 || rate <= 0) {
                        alert('Please fill all fields correctly.');
                        return;
                    }

                    let item = {
                        issue_date: issueDate,
                        customer_id: customerId,
                        customer_name: customerName,
                        vehicle_id: vehicleId,
                        vehicle_number: vehicleText,
                        head_id: headId,
                        head_name: headText,
                        product_id: productId,
                        product_name: productText,
                        quantity: qty,
                        rate: rate,
                        amount: amount
                    };

                    saleItems.push(item);

                    let row = `
                <tr data-index="${saleItems.length - 1}">
                    <td>${counter++}</td>
                    <td>${issueDate}</td>
                    <td>${customerName}</td>
                    <td>${vehicleText}</td>
                    <td>${headText}</td>
                    <td>${productText}</td>
                    <td>${qty}</td>
                    <td>${parseFloat(rate).toFixed(2)}</td>
                    <td>${amount}</td>
                    <td>
                       <button type="button" class="btn btn-danger btn-sm removeRow" title="Delete">
               <i class="fa fa-trash" style="font-size: 0.75rem;"></i>
      </button>
</td>

                </tr>`;
                    $('#saleTable tbody').append(row);

                    updateSaleItemsData();
                }

                $(document).on('click', '.removeRow', function() {
                    let row = $(this).closest('tr');
                    let index = row.data('index');
                    saleItems.splice(index, 1);
                    row.remove();

                    $('#saleTable tbody tr').each(function(i) {
                        $(this).find('td:first').text(i + 1);
                        $(this).data('index', i);
                    });

                    counter = saleItems.length + 1;
                    updateSaleItemsData();
                });

                function updateSaleItemsData() {
                    $('#saleItemsData').html('');
                    saleItems.forEach((item, index) => {
                        $('#saleItemsData').append(`
                        <input type="hidden" name="sale_items[${index}][issue_date]" value="${item.issue_date}">
                        <input type="hidden" name="sale_items[${index}][customer_id]" value="${item.customer_id}">
                        <input type="hidden" name="sale_items[${index}][customer_name]" value="${item.customer_name}">
                        <input type="hidden" name="sale_items[${index}][vehicle_id]" value="${item.vehicle_id}">
                        <input type="hidden" name="sale_items[${index}][vehicle_number]" value="${item.vehicle_number}">
                        <input type="hidden" name="sale_items[${index}][head_id]" value="${item.head_id}">
                        <input type="hidden" name="sale_items[${index}][product_id]" value="${item.product_id}">
                        <input type="hidden" name="sale_items[${index}][quantity]" value="${item.quantity}">
                        <input type="hidden" name="sale_items[${index}][rate]" value="${item.rate}">
                    `);
                    });
                }

            });
        </script>
</x-master>