<x-master>
    <style>
        /* ✅ Fit full card — top aligned */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background: linear-gradient(135deg, #fff9c4, #ffecb3);
        }

        .container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* 👈 align card to top */
            padding-top: 20px; /* add small spacing from top */
        }

        .card-custom {
            background: linear-gradient(145deg, #fff8dc, #ffe082);
            border-radius: 1rem;
            border: 2px solid #b38b00;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            padding: 1.5rem;
            width: 95%;
            max-width: 1300px;
            max-height: 90vh;
            overflow-y: auto; /* scroll only inside card if data is large */
        }

        .table th {
            background-color: #f9e79f;
            color: #5a4d00;
            text-align: center;
            font-weight: 700;
        }

        .table td {
            vertical-align: middle;
            text-align: center;
            font-weight: 500;
            color: #000 !important;
        }

        .table-hover tbody tr:hover {
            background-color: #fff9c4;
        }

        h1, h5 {
            color: #5a4d00;
        }

        /* Optional — nicer scroll inside card */
        .card-custom::-webkit-scrollbar {
            width: 8px;
        }

        .card-custom::-webkit-scrollbar-thumb {
            background-color: #b38b00;
            border-radius: 10px;
        }
    </style>

    <div class="container">
        <div class="card-custom">
            <!-- Company Name -->
            <div class="text-center mb-3">
                <h1 style="font-family: 'Orbitron', sans-serif; font-weight:900;">FRONTIER TRADERS</h1>
            </div>

            <!-- Sales Detail Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Head</th>
                            <th>Product</th>
                            <th>Date</th>
                            <th>Qty</th>
                            <th>Rate</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                            <tr>
                                <td>{{ $sale->customer_name }}</td>
                                <td>{{ $sale->head ? $sale->head->head_name : 'N/A' }}</td>
                                <td>{{ $sale->product ? $sale->product->product_name : 'N/A' }}</td>
                                <td>{{ $sale->issue_date }}</td>
                                <td>{{ $sale->quantity }}</td>
                                <td>{{ number_format($sale->rate, 2) }}</td>
                                <td>{{ number_format($sale->quantity * $sale->rate, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-danger">No sales found for this customer/date</td>
                            </tr>
                        @endforelse

                        @if($sales->count() > 0)
                        <tr class="fw-bold">
                            <td colspan="6" class="text-end">Grand Total</td>
                            <td>Rs {{ number_format($total, 2) }}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Product Summary Table -->
            @if($sales->count() > 0)
            <div class="mt-4">
                <h5 class="fw-bold">Product Summary</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Total Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $summary = $sales->groupBy('product_id')->map(function($group) {
                                    return $group->sum('quantity');
                                });
                            @endphp

                            @foreach($summary as $productId => $qty)
                                <tr>
                                    <td>{{ optional($sales->firstWhere('product_id', $productId)->product)->product_name }}</td>
                                    <td>{{ $qty }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-master>
