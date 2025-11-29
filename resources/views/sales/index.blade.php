<x-master>
    <style>
        body {
            background: linear-gradient(135deg, #fff9c4, #ffecb3);
        }

        .card-custom {
            background: linear-gradient(145deg, #fff8dc, #ffe082);
            border-radius: 1rem;
            border: 2px solid #b38b00;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            padding: 1.5rem;
        }

        .table th {
            background-color: #f9e79f;
            color: #5a4d00;
            text-align: center;
            font-weight: 700;
            font-size: 13px; /* smaller */
            white-space: nowrap; /* keep in one line */
            vertical-align: middle;
            padding: 6px 8px;
        }

        .table td {
            vertical-align: middle;
            text-align: center;
            font-weight: 500;
            font-size: 13px; /* smaller */
            white-space: nowrap; /* one line only */
            padding: 6px 8px;
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

        .btn-edit {
            background: linear-gradient(135deg, #28a745, #a8e063);
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            border: none;
            transition: 0.3s ease;
        }

        .btn-edit:hover {
            background: linear-gradient(135deg, #2ecc71, #7dff8c);
            transform: scale(1.05);
        }

        .btn-delete {
            background: linear-gradient(135deg, #e74c3c, #ff7675);
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            border: none;
            transition: 0.3s ease;
        }

        .btn-delete:hover {
            background: linear-gradient(135deg, #ff3d3d, #ff6f61);
            transform: scale(1.05);
        }

        .table-hover tbody tr:hover {
            background-color: #fff9c4;
        }

        .pagination {
            justify-content: center;
        }

        .pagination .page-item.active .page-link {
            background-color: #b38b00;
            border-color: #b38b00;
        }

        /* 🔍 Search Bar Styling */
        #searchInput {
            width: 280px;
            border-radius: 8px;
            border: 2px solid #b38b00;
            padding: 6px 10px;
            outline: none;
            transition: 0.3s ease;
        }

        #searchInput:focus {
            box-shadow: 0 0 8px rgba(179, 139, 0, 0.5);
        }

        table.table td,
        table.table th {
            color: #000 !important;
        }
    </style>

    <div class="container mt-5">
        <div class="card-custom">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold text-dark mb-0">💰 All Sales</h4>
                <a href="{{ route('sales.create') }}" class="btn btn-gold px-3">
                    <i class="fas fa-plus-circle me-1"></i> Add Sale
                </a>
            </div>

            <!-- Search Bar -->
            <div class="d-flex align-items-center gap-2 mb-4">
                <input type="text" id="searchInput" placeholder="Search by Customer Name or ID...">
            </div>

            @if(session('success'))
                <div class="alert alert-success text-center fw-bold shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle" id="salesTable">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Entry Date</th>
                            <th>Bill Month</th>
                            <th>Bill Year</th>
                            <th>Issue Date</th>
                            <th>Customer</th>
                            <th>Vehicle Number</th>
                            <th>Head</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Rate</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                            <tr>
                                <td>{{ ($sales->currentPage()-1)*$sales->perPage() + $loop->iteration }}</td>
                                <td>{{ $sale->entry_date ?? '-' }}</td>
                                <td>{{ $sale->bill_month ?? '-' }}</td>
                                <td>{{ $sale->bill_year ?? '-' }}</td>
                                <td>{{ $sale->issue_date ?? '-' }}</td>
                                <td>{{ $sale->customer_name ?? '-' }}</td>
                                <td>{{ $sale->vehicle_number ?? '-' }}</td>

                                <td>{{ $sale->head->head_name ?? '-' }}</td>
                                <td>{{ $sale->product->product_name ?? '-' }}</td>
                                <td>{{ $sale->quantity ?? 0 }}</td>
                                <td>{{ number_format($sale->rate,2) }}</td>
                                <td>{{ number_format($sale->total_amount ?? ($sale->quantity * $sale->rate),2) }}</td>
                                <td class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-sm btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('sales.destroy', $sale->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure want to delete?');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="text-center fw-bold text-muted">No sales found 💸</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $sales->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('#salesTable tbody tr');

        searchInput.addEventListener('keyup', function() {
            const searchText = this.value.toLowerCase();

            tableRows.forEach(row => {
                let match = false;
                row.querySelectorAll('td').forEach(td => {
                    if (td.textContent.toLowerCase().includes(searchText)) {
                        match = true;
                    }
                });
                row.style.display = match ? '' : 'none';
            });
        });
    </script>
</x-master>
