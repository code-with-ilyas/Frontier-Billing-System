<x-master>
    <style>
        /* ✅ Keep same clean layout */
        .light-yellow-bg {
            background-color: #fff9c4;
        }

        .bill-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #000;
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

        html,
        body {
            height: auto;
            overflow-x: hidden;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #printable-tables,
            #printable-tables * {
                visibility: visible;
            }

            #printable-tables {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .no-print {
                display: none !important;
            }
        }

        .btn-primary.custom-btn {
            background: linear-gradient(135deg, #007bff, #339cff) !important;
            color: #fff !important;
            border: none;
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

        /* Date Range Styles */
        .date-range-group {
            display: flex;
            gap: 15px;
            align-items: end;
        }

        .date-input-group {
            flex: 1;
        }

        .date-range-btn {
            background: linear-gradient(135deg, #9f7aea, #805ad5);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .date-range-btn:hover {
            background: linear-gradient(135deg, #805ad5, #6b46c1);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(159, 122, 234, 0.4);
        }
    </style>

    <!-- Professional Filters Card for Vehicle Bills -->
    <div class="container py-4 no-print">
        <div class="filter-card">
            <!-- Header Section -->
            <div class="filter-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="filter-title">
                            <i class="fas fa-truck me-2"></i>
                            VEHICLE BILL REPORT 
                        </h3>
                        <p class="filter-subtitle">
                            Generate detailed vehicle-wise sales reports with date filtering
                        </p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ route('sales.report') }}" class="back-btn">
                            <i class="fas fa-arrow-left me-2"></i>Back to Reports
                        </a>
                    </div>
                </div>
            </div>

            <!-- Filter Body -->
            <div class="filter-body">
                <form method="GET" action="{{ route('vehicle.bills') }}" id="filterForm">
                    <div class="row g-4">
                        <!-- Vehicle Selection -->
                        <div class="col-md-4">
                            <div class="filter-group">
                                <label class="form-label">
                                    <i class="fas fa-truck me-2"></i>Select Vehicle
                                </label>
                                <select name="vehicle_number" id="vehicle_number" class="form-control filter-control searchable-select">
                                    <option value="">Select Vehicle</option>
                                    @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->vehicle_number }}" {{ request('vehicle_number') == $vehicle->vehicle_number ? 'selected' : '' }}>
                                        {{ $vehicle->vehicle_number }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Date Range Selection -->
                        <div class="col-md-5">
                            <div class="filter-group">
                                <label class="form-label">
                                    <i class="fas fa-calendar-alt me-2"></i>Date Range
                                </label>
                                
                                <div class="date-range-group">
                                    <div class="date-input-group">
                                        <label class="form-label small">From Date</label>
                                        <input type="date" name="from_date" id="from_date" class="form-control filter-control" 
                                               value="{{ request('from_date') }}">
                                    </div>
                                    <div class="date-input-group">
                                        <label class="form-label small">To Date</label>
                                        <input type="date" name="to_date" id="to_date" class="form-control filter-control" 
                                               value="{{ request('to_date') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Options and Actions -->
                        <div class="col-md-3">
                            <div class="row g-3 align-items-center h-100">
                                <!-- Toggle Options -->
                                <div class="col-12">
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
                                <div class="col-12">
                                    <div class="action-buttons">
                                        <a href="{{ route('vehicle.bills') }}" class="btn-filter btn-reset">
                                            <i class="fas fa-redo me-2"></i>Reset
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

    <!-- Printable Section -->
    @if($sales->count() > 0 && request('vehicle_number'))
    <div id="printable-tables">
        <div class="bill-container">
            <!-- Header -->
            <div class="company-header d-flex justify-content-between align-items-center mb-4">
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
                        <strong>Vehicle:</strong>
                        <span id="vehicle-number">{{ request('vehicle_number') }}</span>
                    </div>
                    <div class="col-md-6 text-end">
                        <strong>Report Type:</strong> Vehicle-wise Report
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6">
                        <strong>Date Range:</strong> 
                        @if(request('from_date') && request('to_date'))
                            {{ date('d/m/Y', strtotime(request('from_date'))) }} - {{ date('d/m/Y', strtotime(request('to_date'))) }}
                        @else
                            All Time
                        @endif
                    </div>
                    <div class="col-md-6 text-end">
                        <strong>Generated:</strong> {{ now()->format('d/m/Y') }}
                    </div>
                </div>

                <div class="row"> <div class="col-md-12 text-center"> <strong>Bill No:</strong> <span id="billNumber">{{ $billNo ?? 1 }}</span> </div> </div>
            </div>

            <!-- Sales Table -->
            <h4 class="px-2 py-1 bg-warning fw-bold">SALE DETAIL</h4>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>Product Name</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sale->product->product_name ?? 'N/A' }}</td>
                        <td>{{ $sale->customer_name }}</td>
                        <td>{{ $sale->issue_date }}</td>
                        <td>{{ $sale->quantity }}</td>
                        <td>{{ number_format($sale->rate, 2) }}</td>
                        <td>{{ number_format($sale->quantity * $sale->rate, 2) }}</td>
                    </tr>
                    @endforeach
                    <tr class="total-row">
                        <td colspan="6" class="text-end fw-bold">Grand Total</td>
                        <td id="total-amount">Rs {{ number_format($totalSales, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Product Summary -->
            <h4 class="px-2 py-1 bg-warning fw-bold">PRODUCT SUMMARY</h4>
            <table class="summary-table mt-3">
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
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

            <!-- Signatures -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <p><strong>Vehicle Owner Signature</strong> ....................................</p>
                </div>
                <div class="col-md-6 text-end">
                    <p><strong>Authorized Signature</strong> ....................................</p>
                </div>
            </div>
        </div>
    </div>

    @elseif(request('vehicle_number'))
        <div class="container py-4">
            <div class="alert alert-warning text-center">
                No sales data found for selected vehicle
                @if(request('from_date') && request('to_date'))
                    in the date range {{ date('d/m/Y', strtotime(request('from_date'))) }} - {{ date('d/m/Y', strtotime(request('to_date'))) }}
                @endif
                .
            </div>
        </div>
    @else
        <div class="container py-4">
            <div class="alert alert-info text-center">Please select a vehicle to generate report.</div>
        </div>
    @endif

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('#vehicle_number').select2({ 
                placeholder: "Select Vehicle", 
                allowClear: true 
            });
            
            // Auto-submit when vehicle changes
            $('#vehicle_number').on('change', function() { 
                $('#filterForm').submit();
            });

            // Auto-submit when date changes
            $('#from_date, #to_date').on('change', function() {
                if ($('#vehicle_number').val()) {
                    $('#filterForm').submit();
                }
            });

            // Toggle logo visibility
            $('#include_logo').on('change', function() {
                $('#print-logo').toggle(this.checked);
            });

            // Set default dates if not set (current month)
            if (!$('#from_date').val() && !$('#to_date').val()) {
                const today = new Date();
                const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
                
                // Format date as YYYY-MM-DD for input fields
                function formatDate(date) {
                    const year = date.getFullYear();
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const day = String(date.getDate()).padStart(2, '0');
                    return `${year}-${month}-${day}`;
                }
                
                $('#from_date').val(formatDate(firstDay));
                $('#to_date').val(formatDate(today));
            }
        });

        function printAndSaveBill() {
            saveCurrentBill();
            const logo = document.getElementById('print-logo');
            const checkbox = document.getElementById('include_logo');
            if (logo) logo.style.display = checkbox.checked ? 'block' : 'none';
            window.print();
            setTimeout(() => { if (logo) logo.style.display = 'block'; }, 1000);
        }

        function saveCurrentBill() {
    const printableArea = document.getElementById('printable-tables');
    if (!printableArea) return alert('No report data found to save!');

    const vehicleElement = document.getElementById('vehicle-number');
    const vehicle = vehicleElement ? vehicleElement.textContent.trim() : 'Unknown Vehicle';
    const date = new Date().toLocaleDateString();
    const billNumberElement = document.getElementById('billNumber');
    const totalAmount = document.getElementById('total-amount')?.textContent.trim() || 'Rs 0.00';
    
    // Get date range for bill name
    const fromDate = document.querySelector('#from_date')?.value || '';
    const toDate = document.querySelector('#to_date')?.value || '';
    let dateRangeText = '';
    
    if (fromDate && toDate) {
        const from = new Date(fromDate).toLocaleDateString();
        const to = new Date(toDate).toLocaleDateString();
        dateRangeText = ` (${from} to ${to})`;
    }

    // Get existing bills to calculate next number
    let savedBills = JSON.parse(localStorage.getItem('savedBills') || '[]');
    
    // Calculate next bill number for this vehicle
    const vehicleBills = savedBills.filter(bill => bill.type === 'vehicle' && bill.vehicle === vehicle);
    const nextBillNumber = vehicleBills.length + 1;
    const billNumber = `V-${nextBillNumber}`;

    const billData = {
        id: 'vehicle_bill_' + Date.now(),
        vehicle,
        date,
        billNumber,
        totalAmount,
        billName: `${vehicle} Report #${nextBillNumber}${dateRangeText}`,
        content: printableArea.innerHTML,
        type: 'vehicle',
        timestamp: new Date().toLocaleString()
    };

    // Save the bill
    savedBills.unshift(billData);
    
    // Keep only last 50 bills
    savedBills = savedBills.slice(0, 50);
    localStorage.setItem('savedBills', JSON.stringify(savedBills));
    
    // Update the displayed bill number
    if (billNumberElement) {
        billNumberElement.textContent = billNumber;
    }
    
    alert(`Report saved successfully as ${billNumber}! You can view it later in "Saved Reports".`);
}
    </script>
</x-master>