<x-master>
    <style>
        .form-control {
            height: 45px;
            font-size: 16px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 500;
        }

        .form-check-label {
            font-size: 16px;
            font-weight: 600;
            margin-left: 8px;
        }

        .form-check-input {
            width: 22px;
            height: 22px;
        }

        .btn-custom-wide {
            height: 45px;
            font-size: 16px;
        }

        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            color: #000 !important;
        }

        .form-control {
            border: 2px solid #ced4da;
            border-radius: 8px;
            padding: 0.5rem 0.75rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            outline: none;
        }

        .searchable-select option[value=""] {
            color: #6c757d;
            font-style: italic;
        }

        .bill-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #000;
        }

        .company-header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .company-header h1 {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
            letter-spacing: 2px;
        }

        .items-table,
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .items-table th,
        .summary-table th {
            background-color: #f39c12;
            color: #000;
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-weight: bold;
        }

        .items-table td,
        .summary-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .total-row {
            font-weight: bold;
            background-color: #f8f9fa;
            color: #000;
        }

        @media print {
            body * {
                visibility: hidden !important;
            }

            #printable-area,
            #printable-area * {
                visibility: visible !important;
            }

            #printable-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
            }

            .no-print {
                display: none !important;
            }
        }

        .btn-primary.custom-btn {
            background: linear-gradient(135deg, #007bff, #339cff);
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            padding: 0.5rem 1.2rem;
            border: none;
            transition: all 0.3s;
        }

        .btn-primary.custom-btn:hover {
            background: linear-gradient(135deg, #339cff, #007bff);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .btn-outline-secondary.custom-btn {
            background: transparent;
            color: #6c757d;
            font-weight: 600;
            border: 2px solid #6c757d;
            border-radius: 8px;
            padding: 0.5rem 1.2rem;
            transition: all 0.3s;
        }

        .btn-outline-secondary.custom-btn:hover {
            background: #6c757d;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .btn-success.custom-btn {
            background: linear-gradient(135deg, #28a745, #5cd65c);
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            padding: 0.5rem 1.2rem;
            border: none;
            transition: all 0.3s;
        }

        .btn-success.custom-btn:hover {
            background: linear-gradient(135deg, #5cd65c, #28a745);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .btn-info.custom-btn {
            background: linear-gradient(135deg, #17a2b8, #5bc0de);
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            padding: 0.5rem 1.2rem;
            border: none;
            transition: all 0.3s;
        }

        .btn-info.custom-btn:hover {
            background: linear-gradient(135deg, #5bc0de, #17a2b8);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .light-yellow-bg {
            background-color: #fff9c4;
        }

        /* Professional Filter Section Styles */
        .filter-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .filter-header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px 12px 0 0;
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .filter-body {
            background: white;
            border-radius: 0 0 12px 12px;
            padding: 25px;
        }

        .filter-title {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .filter-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
            margin: 5px 0 0 0;
        }

        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .filter-control {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: white;
        }

        .filter-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .filter-group {
            background: #f8fafc;
            border-radius: 10px;
            padding: 15px;
            border: 1px solid #e2e8f0;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 10px;
        }

        .btn-filter {
            flex: 1;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-apply {
            background: linear-gradient(135deg, #48bb78, #38a169);
            color: white;
        }

        .btn-apply:hover {
            background: linear-gradient(135deg, #38a169, #2f855a);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(72, 187, 120, 0.4);
        }

        .btn-reset {
            background: linear-gradient(135deg, #ed8936, #dd6b20);
            color: white;
        }

        .btn-reset:hover {
            background: linear-gradient(135deg, #dd6b20, #c05621);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(237, 137, 54, 0.4);
        }

        .btn-print {
            background: linear-gradient(135deg, #4299e1, #3182ce);
            color: white;
        }

        .btn-print:hover {
            background: linear-gradient(135deg, #3182ce, #2b6cb0);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(66, 153, 225, 0.4);
        }

        .back-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            color: white;
        }

        .toggle-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 15px;
            transition: all 0.3s ease;
        }

        .toggle-card:hover {
            border-color: #667eea;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .toggle-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
        }

        .toggle-label {
            font-weight: 600;
            color: #2d3748;
            margin: 0;
        }

        .toggle-description {
            font-size: 12px;
            color: #718096;
            margin: 2px 0 0 0;
        }

        .loading-spinner {
            display: none;
            text-align: center;
            padding: 20px;
        }
    </style>

    <!-- Professional Filters Card -->
    <div class="container py-4 no-print">
        <div class="filter-card">
            <!-- Header Section -->
            <div class="filter-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="filter-title">
                            <i class="fas fa-chart-line me-2"></i>
                           CUSTOMER BILL REPORT
                        </h3>
                        <p class="filter-subtitle">
                            Generate Detailed Customer Sales Reports With Vehicle-Numbers
                        </p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ route('sales.index') }}" class="back-btn">
                            <i class="fas fa-arrow-left me-2"></i>Back to Sales
                        </a>
                    </div>
                </div>
            </div>

            <!-- Filter Body -->
            <div class="filter-body">
                <form method="GET" action="{{ route('sales.report') }}" id="filterForm">
                    <div class="row g-4">
                        <!-- Customer Selection -->
                        <div class="col-md-4">
                            <div class="filter-group">
                                <label class="form-label">
                                    <i class="fas fa-user me-2"></i>Customer Name
                                </label>
                                <select name="customer_name" id="customer_name" class="form-control filter-control searchable-select">
                                    <option value="">All Customers</option>
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->customer_name }}" {{ request('customer_name') == $customer->customer_name ? 'selected' : '' }}>
                                        {{ $customer->customer_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Vehicle Selection -->
                        <div class="col-md-4">
                            <div class="filter-group">
                                <label class="form-label">
                                    <i class="fas fa-truck me-2"></i>Vehicle Number
                                </label>
                                <select name="vehicle_number" id="vehicle_number" class="form-control filter-control searchable-select">
                                    <option value="">All Vehicles</option>
                                    @if(request('customer_name'))
                                    @php
                                    $customerVehicles = \App\Models\Vehicle::where('customer_name', request('customer_name'))->get();
                                    @endphp
                                    @foreach($customerVehicles as $vehicle)
                                    <option value="{{ $vehicle->vehicle_number }}" {{ request('vehicle_number') == $vehicle->vehicle_number ? 'selected' : '' }}>
                                        {{ $vehicle->vehicle_number }}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <!-- Date Range -->
                        <div class="col-md-4">
                            <div class="filter-group">
                                <label class="form-label">
                                    <i class="fas fa-calendar-alt me-2"></i>Date Range
                                </label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input type="date" name="from_date" class="form-control filter-control" value="{{ request('from_date') }}" placeholder="From Date">
                                    </div>
                                    <div class="col-6">
                                        <input type="date" name="to_date" class="form-control filter-control" value="{{ request('to_date') }}" placeholder="To Date">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Options and Actions -->
                        <div class="col-md-12">
                            <div class="row g-3 align-items-center">
                                <!-- Toggle Options -->
                                <div class="col-md-4">
                                    <div class="toggle-card">
                                        <div class="d-flex align-items-center">
                                            <div class="toggle-icon bg-primary">
                                                <i class="fas fa-stamp text-white"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <label class="toggle-label" for="include_logo">
                                                    Company Stamp
                                                </label>
                                                <p class="toggle-description">Include company logo in reports</p>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="include_logo" checked style="width: 50px; height: 25px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="col-md-8">
                                    <div class="action-buttons">
                                        <button type="submit" class="btn-filter btn-apply" id="dateFilterBtn">
                                            <i class="fas fa-filter me-2"></i>Apply Date Filter
                                        </button>
                                        <a href="{{ route('sales.report') }}" class="btn-filter btn-reset">
                                            <i class="fas fa-redo me-2"></i>Reset All
                                        </a>
                                        <button type="button" class="btn-filter btn-print" onclick="printAndSaveBill()">
                                            <i class="fas fa-print me-2"></i>Print Report
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Loading Spinner -->
    <div class="loading-spinner" id="loadingSpinner">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="mt-2">Loading sales data...</p>
    </div>

    <!-- Printable Section -->
    <div id="printable-area">
        @if($sales->count() > 0)
        <div class="bill-container">
            <div class="company-header d-flex justify-content-between align-items-center">
                <div>
                    <h1 style="font-family: 'Orbitron', sans-serif; font-weight:900;">FRONTIER TRADERS</h1>
                </div>
                <div class="text-end">
                    <img id="print-logo" src="{{ asset('admin_assets/img/pso.png') }}" alt="PSO Logo" style="height:60px;">
                </div>
            </div>

            <!-- Bill Info -->
            <div class="mb-3 border p-3 rounded">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <strong>Customer:</strong>
                        <span id="bill-customer">{{ request('customer_name') ?: 'All Customers' }}</span>
                    </div>
                    <div class="col-md-6 text-end">
                        <strong>Vehicle Number:</strong>
                        <span id="bill-vehicle">{{ request('vehicle_number') ?: 'All Vehicles' }}</span>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6">
                        <strong>Date Range:</strong>
                        <span id="bill-dates">
                            @if(request('from_date') && request('to_date'))
                            {{ request('from_date') }} to {{ request('to_date') }}
                            @else
                            All Dates
                            @endif
                        </span>
                    </div>
                    <div class="col-md-6 text-end">
                        <strong>Report Date:</strong> {{ now()->format('d/m/Y') }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <strong>Bill No:</strong> <span id="billNumber">{{ $billNo ?? 1 }}</span>
                    </div>
                </div>
            </div>

            <!-- Sale Detail Table -->
            <h4 style="display:inline-block; background-color:#f39c12; color:#000; padding:5px 12px; font-weight:bold;">SALE DETAIL</h4>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>Product Name</th>
                        <th>Date</th>
                        <th>Vehicle Number</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody id="sales-table-body">
                    @foreach($sales as $sale)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sale->product->product_name ?? 'N/A' }}</td>
                        <td>{{ $sale->issue_date }}</td>
                        <td>{{ $sale->vehicle_number ?? 'N/A' }}</td>
                        <td>{{ $sale->quantity }}</td>
                        <td>{{ number_format($sale->rate,2) }}</td>
                        <td>{{ number_format($sale->quantity * $sale->rate,2) }}</td>
                    </tr>
                    @endforeach
                    <tr class="total-row">
                        <td colspan="6" style="text-align:right;">Grand Total</td>
                        <td>Rs {{ number_format($totalSales,2) }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Product Summary -->
            <h4 style="display:inline-block; background-color:#f39c12; color:#000; padding:5px 12px; font-weight:bold;">PRODUCT SUMMARY</h4>
            <table class="summary-table mt-3">
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody id="summary-table-body">
                    @php
                    $summary = [];
                    foreach($sales as $sale){
                    $pid = $sale->product_id;
                    if(!isset($summary[$pid])) $summary[$pid] = ['name'=>$sale->product->product_name ?? 'N/A', 'quantity'=>0];
                    $summary[$pid]['quantity'] += $sale->quantity;
                    }
                    @endphp
                    @foreach($summary as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['quantity'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <br><br>
            <div class="row mt-4">
                <div class="col-md-6">
                    <p><strong>Customer Signature</strong> ....................................</p>
                </div>
                <div class="col-md-6 text-end">
                    <p><strong>Authorized Signature</strong> ....................................</p>
                </div>
            </div>
        </div>
        @elseif(request()->hasAny(['customer_name', 'vehicle_number', 'from_date']))
        <div class="container py-4">
            <div class="alert alert-warning text-center">No sales data found for selected filters.</div>
        </div>
        @else
        <div class="container py-4">
            <div class="alert alert-info text-center">Please select a customer to view sales data.</div>
        </div>
        @endif
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize select2
            $('#customer_name').select2({
                placeholder: "Select Customer",
                allowClear: true
            });

            // Function to load vehicles for a customer
            function loadVehiclesForCustomer(customerName, selectedVehicle = '') {
                $('#vehicle_number').html('<option value="">Loading...</option>');

                if (customerName) {
                    $.ajax({
                        url: '/get-vehicles/' + customerName,
                        type: 'GET',
                        success: function(data) {
                            $('#vehicle_number').empty();
                            $('#vehicle_number').append('<option value="">All Vehicles</option>');
                            if (data.length > 0) {
                                $.each(data, function(key, vehicle) {
                                    var isSelected = (selectedVehicle === vehicle.vehicle_number) ? 'selected' : '';
                                    $('#vehicle_number').append('<option value="' + vehicle.vehicle_number + '" ' + isSelected + '>' + vehicle.vehicle_number + '</option>');
                                });
                            } else {
                                $('#vehicle_number').append('<option value="">No vehicles found</option>');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching vehicles:', error);
                            $('#vehicle_number').html('<option value="">Error loading vehicles</option>');
                        }
                    });
                } else {
                    $('#vehicle_number').html('<option value="">All Vehicles</option>');
                }
            }

            // Function to load sales data automatically
            function loadSalesData() {
                var customerName = $('#customer_name').val();
                var vehicleNumber = $('#vehicle_number').val();
                
                // Only load data if customer is selected
                if (customerName) {
                    $('#loadingSpinner').show();
                    
                    // Build URL with current filters
                    var url = new URL('{{ route('sales.report') }}', window.location.origin);
                    if (customerName) url.searchParams.set('customer_name', customerName);
                    if (vehicleNumber) url.searchParams.set('vehicle_number', vehicleNumber);
                    
                    // Use AJAX to load data without page refresh
                    $.ajax({
                        url: url.toString(),
                        type: 'GET',
                        success: function(data) {
                            // Update the page content with new data
                            var newDoc = new DOMParser().parseFromString(data, 'text/html');
                            var newPrintableArea = newDoc.getElementById('printable-area');
                            if (newPrintableArea) {
                                $('#printable-area').html(newPrintableArea.innerHTML);
                            }
                            $('#loadingSpinner').hide();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error loading sales data:', error);
                            $('#loadingSpinner').hide();
                            alert('Error loading sales data. Please try again.');
                        }
                    });
                }
            }

            // When customer changes, fetch vehicle numbers and load data
            $('#customer_name').on('change', function() {
                var customerName = $(this).val();
                loadVehiclesForCustomer(customerName);
                
                // Update bill customer name immediately
                $('#bill-customer').text(customerName || 'All Customers');
                
                // Load sales data after a short delay
                setTimeout(loadSalesData, 500);
            });

            // When vehicle number changes, load data automatically
            $('#vehicle_number').on('change', function() {
                var vehicleNumber = $(this).val();
                
                // Update bill vehicle number immediately
                $('#bill-vehicle').text(vehicleNumber || 'All Vehicles');
                
                // Load sales data
                loadSalesData();
            });

            // Load vehicles when page loads if customer is already selected
            @if(request('customer_name') && !empty(request('customer_name')))
                var selectedCustomer = '{{ request('customer_name') }}';
                var selectedVehicle = '{{ request('vehicle_number') }}';
                if (selectedCustomer) {
                    loadVehiclesForCustomer(selectedCustomer, selectedVehicle);
                }
            @endif

            // Monogram toggle: show/hide logo instantly
            $('#include_logo').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#print-logo').show();
                } else {
                    $('#print-logo').hide();
                }
            });

            // Change Apply Filter button to only apply date range
            $('#dateFilterBtn').on('click', function(e) {
                e.preventDefault();
                $('#filterForm').submit();
            });
        });

        function printAndSaveBill() {
            saveCurrentBill();
            var logoCheckbox = document.getElementById('include_logo');
            var logo = document.getElementById('print-logo');
            if (logo) logo.style.display = logoCheckbox.checked ? 'block' : 'none';
            window.print();
            setTimeout(() => {
                if (logo) logo.style.display = 'block';
            }, 1000);
        }

      function saveCurrentBill() {
    const printableArea = document.getElementById('printable-area');
    if (!printableArea) {
        alert('No bill data found to save!');
        return;
    }

    let customer = $('#bill-customer').text();
    let vehicle = $('#bill-vehicle').text();
    let date = new Date().toLocaleDateString();
    let totalAmountElement = document.querySelector('.total-row td:last-child');
    let totalAmount = totalAmountElement ? totalAmountElement.textContent.trim() : 'Rs 0.00';

   // Get existing bills
let savedBills = JSON.parse(localStorage.getItem('savedBills') || '[]');

// Filter only customer bills
const customerBills = savedBills.filter(bill => bill.type === 'customer');

// Calculate the next global bill number
let maxNumber = 0;
customerBills.forEach(bill => {
    let num = parseInt(bill.billNumber.replace('C-', ''));
    if (num > maxNumber) maxNumber = num;
});

const nextBillNumber = maxNumber + 1;
const billNumber = `C-${nextBillNumber}`;

    const billData = {
        id: 'bill_' + Date.now(),
        customer: customer,
        vehicle: vehicle,
        date: date,
        billNumber: billNumber,
        totalAmount: totalAmount,
        billName: `${customer} Bill #${nextBillNumber}`,
        content: printableArea.innerHTML,
        type: 'customer',
        timestamp: new Date().toLocaleString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        })
    };

    // Save the bill
    savedBills.unshift(billData);
    localStorage.setItem('savedBills', JSON.stringify(savedBills));
    
    // Update the displayed bill number
    const billNumberElement = document.getElementById('billNumber');
    if (billNumberElement) {
        billNumberElement.textContent = billNumber;
    }
    
    alert(`Bill saved successfully as ${billNumber}!`);
}
    </script>
</x-master>