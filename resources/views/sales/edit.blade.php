<x-master>
    <!-- Include Select2 CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Include Flatpickr CSS and JS for date formatting -->
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <div class="container-fluid mt-3">
        <div class="row g-3 h-100">

            <!-- LEFT: Sale Form -->
            <div class="col-md-4">
                <div class="card shadow-sm card-custom h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3 card-header card-header-custom">
                        <h4 class="mb-0">Edit Sale</h4>
                        <button type="submit" form="saleForm" class="btn btn-warning-custom px-3">Update Sale</button>
                    </div>

                    <form id="saleForm" method="POST" action="{{ route('sales.update', $sale->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-2 row">
                            <div class="col-md-6">
                                <label class="form-label">Entry Date</label>
                                <input type="text" name="entry_date" id="entryDate" class="form-control form-control-sm" value="{{ \Carbon\Carbon::parse($sale->entry_date)->format('d/m/Y') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Issue Date</label>
                                <input type="text" name="issue_date" id="issueDate" class="form-control form-control-sm" value="{{ \Carbon\Carbon::parse($sale->issue_date)->format('d/m/Y') }}" required>
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <div class="col-md-6">
                                <label class="form-label">Bill Month</label>
                                <input type="text" name="bill_month" class="form-control form-control-sm" value="{{ $sale->bill_month }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Bill Year</label>
                                <input type="text" name="bill_year" class="form-control form-control-sm" value="{{ $sale->bill_year }}" required>
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <div class="col-md-6">
                                <label class="form-label">Customer Name</label>
                                <select name="customer_name" id="customerSelect" class="form-control form-control-sm select2" required>
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->customer_name }}" @if($sale->customer_name == $customer->customer_name) selected @endif>
                                        {{ $customer->customer_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Vehicle Number</label>
<select name="vehicle_number" id="vehicleSelect" class="form-control form-control-sm select2">
    <option value="">Select Vehicle</option>
    @foreach($vehicles as $vehicle)
        <option value="{{ $vehicle->vehicle_number }}" 
            @if(isset($sale) && $sale->vehicle_number == $vehicle->vehicle_number) selected @endif>
            {{ $vehicle->vehicle_number }}
        </option>
    @endforeach
</select>

                            </div>
                        </div>

                        <div class="mb-2 row">
                            <div class="col-md-6">
                                <label class="form-label">Select Head</label>
                                <select name="head_id" id="headSelect" class="form-control form-control-sm select2" required>
                                    <option value="">Select Head</option>
                                    @foreach($heads as $head)
                                    <option value="{{ $head->id }}" @if($sale->head_id == $head->id) selected @endif>{{ $head->head_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Product</label>
                                <select name="product_id" id="productSelect" class="form-control form-control-sm select2" required>
                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}" @if($sale->product_id == $product->id) selected @endif>{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <div class="col-md-6">
                                <label class="form-label">Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control form-control-sm" value="{{ $sale->quantity }}" min="1" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Rate</label>
                                <input type="number" name="rate" id="rate" step="0.01" class="form-control form-control-sm" value="{{ $sale->rate }}" required>
                            </div>
                        </div>

                        <div id="saleItemsData"></div>
                    </form>
                </div>
            </div>

            <!-- MIDDLE: Sale & Product Table -->
            <div class="col-md-6">
                <div class="card shadow-sm card-custom h-100">
                    <div class="card-header card-header-custom fw-bold">SALE & PRODUCT DETAILS</div>
                    <div class="card-body table-container p-2">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm align-middle text-center" id="saleTable">
                                <thead class="table-light">
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
                                <tbody>
                                    <tr data-index="0">
                                        <td>1</td>
                                        <td>{{ $sale->issue_date }}</td>
                                        <td>{{ $sale->customer_name }}</td>
                                        <td>{{ $sale->vehicle?->vehicle_number ?? '' }}</td>
                                        <td>{{ $sale->head->head_name }}</td>
                                        <td>{{ $sale->product->product_name }}</td>
                                        <td>{{ $sale->quantity }}</td>
                                        <td>{{ $sale->rate }}</td>
                                        <td>{{ $sale->quantity * $sale->rate }}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm removeRow"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Head Products -->
            <div class="col-md-2">
                <div class="card shadow-sm card-custom" style="height:auto; max-height:250px;">
                    <div class="card-header card-header-custom fw-bold text-center" style="font-size:0.8rem;">Head Products</div>
                    <div class="card-body p-1" style="overflow-y:auto; max-height:200px;">
                        <table class="table table-bordered table-hover table-sm mb-0" id="headItemsTable">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Product</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2" class="text-center">Select a head</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

<script>
$(document).ready(function() {
    // === Initialize Flatpickr for date fields ===
    flatpickr("#entryDate, #issueDate", {
        dateFormat: "d/m/Y",
        allowInput: true
    });

    // === Initialize Select2 ===
    $('.select2').select2({ placeholder: "-- Select --", allowClear: true });

    // === Live update sale table row ===
    function updateSaleRow() {
        let customer = $('#customerSelect').val() || '';
        let vehicle = $('#vehicleSelect option:selected').text() || '';
        let head = $('#headSelect option:selected').text() || '';
        let product = $('#productSelect option:selected').text() || '';
        let qty = parseFloat($('#quantity').val()) || 0;
        let rate = parseFloat($('#rate').val()) || 0;
        let amount = (qty * rate).toFixed(2);

        let row = $('#saleTable tbody tr').first();
        row.find('td:nth-child(3)').text(customer);
        row.find('td:nth-child(4)').text(vehicle);
        row.find('td:nth-child(5)').text(head);
        row.find('td:nth-child(6)').text(product);
        row.find('td:nth-child(7)').text(qty);
        row.find('td:nth-child(8)').text(rate);
        row.find('td:nth-child(9)').text(amount);
    }

    $('#customerSelect, #vehicleSelect, #headSelect, #productSelect, #quantity, #rate').on('change input', updateSaleRow);

    // === Auto-focus next after Select2 selection ===
    $('#saleForm .select2').on('select2:close', function() {
        let inputs = $('#saleForm').find('input, select');
        let idx = inputs.index(this);
        if (idx >= 0 && idx < inputs.length - 1) inputs.eq(idx + 1).focus();
    });

    // === Enter key navigation & submit last field ===
    $('#saleForm').on('keypress', 'input, select', function(e) {
        if (e.which === 13) {
            e.preventDefault();
            let inputs = $('#saleForm').find('input, select');
            let idx = inputs.index(this);
            if (idx >= 0 && idx < inputs.length - 1) {
                inputs.eq(idx + 1).focus();
            } else {
                $('#saleForm').submit();
            }
        }
    });

    // === Load vehicles on customer change ===
    $('#customerSelect').on('change', function() {
        let customerName = $(this).val();
        let vehicleSelect = $('#vehicleSelect');
        vehicleSelect.html('<option value="">Select Vehicle</option>');
        if (customerName) {
            $.ajax({
                url: '/get-vehicles/' + customerName,
                type: 'GET',
                success: function(vehicles) {
                    vehicles.forEach(v => vehicleSelect.append(`<option value="${v.id}">${v.vehicle_number}</option>`));
                    updateSaleRow();
                }
            });
        } else updateSaleRow();
    });

    // === Load head products ===
    function loadHeadProducts(headId) {
        let tbody = $('#headItemsTable tbody');
        tbody.html('<tr><td colspan="2" class="text-center">Loading...</td></tr>');
        if (!headId) {
            tbody.html('<tr><td colspan="2" class="text-center">Select a head</td></tr>'); updateSaleRow(); return;
        }
        $.ajax({
            url: '/head-products/' + headId,
            type: 'GET',
            success: function(data) {
                tbody.html('');
                if (data.length === 0) tbody.html('<tr><td colspan="2" class="text-center">No products found</td></tr>');
                else {
                    data.forEach((p,i)=>tbody.append(`<tr><td>${i+1}</td><td>${p.product_name}</td></tr>`));
                    let productSelect = $('#productSelect');
                    productSelect.html('<option value="">Select Product</option>');
                    data.forEach(p=>productSelect.append(`<option value="${p.id}">${p.product_name}</option>`));
                    productSelect.val("{{ $sale->product_id }}").trigger('change');
                }
                updateSaleRow();
            }
        });
    }
    $('#headSelect').on('change', function() { loadHeadProducts($(this).val()); });
    let initialHead = $('#headSelect').val(); if (initialHead) loadHeadProducts(initialHead);

    // Remove row button
    $(document).on('click', '.removeRow', function() { $(this).closest('tr').remove(); });
});
</script>

<!-- Styles -->
<style>
    body { background: linear-gradient(135deg, #fff9c4, #ffecb3); }
    .card-custom { background: linear-gradient(145deg, #fff8dc, #ffe082); border-radius: 1rem; border: 2px solid #b38b00; box-shadow: 0 8px 20px rgba(0,0,0,0.15); padding: 1rem; }
    .card-header-custom { background-color: #f9e79f; color:#5a4d00; font-weight:700; border-radius:0.5rem; }
    .btn-warning-custom { background-color:#ffc107; color:#000; font-weight:bold; border-radius:0.5rem; }
    .btn-warning-custom:hover { background-color:#d4c329ff; }
    .table th { background-color:#f9e79f; color:#5a4d00; font-weight:700; }
    .table td { font-weight:500; }
    .table-hover tbody tr:hover { background-color:#fff9c4; }
    select.form-control, input.form-control { border-radius:0.5rem; border:1px solid #b38b00; }
    .form-label { font-weight:bold; color:#000; }
    .table-container { overflow-x:auto; }
</style>
</x-master>
