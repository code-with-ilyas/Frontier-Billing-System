<x-master>
    <div class="container-fluid mt-3">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <h5 class="mb-0">Sale Details #{{ $sale->id }}</h5>
                <a href="{{ route('sales.index') }}" class="btn btn-light btn-sm">Back to List</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th>Customer Name:</th>
                                <td>{{ $sale->customer_name }}</td>
                            </tr>
                            <tr>
                                <th>Head:</th>
                                <td>{{ $sale->head->head_name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Product:</th>
                                <td>{{ $sale->product->product_name ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th>Entry Date:</th>
                                <td>{{ $sale->entry_date }}</td>
                            </tr>
                            <tr>
                                <th>Issue Date:</th>
                                <td>{{ $sale->issue_date }}</td>
                            </tr>
                            <tr>
                                <th>Bill Month/Year:</th>
                                <td>{{ $sale->bill_month }}/{{ $sale->bill_year }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th>Quantity:</th>
                                <td>{{ $sale->quantity }}</td>
                            </tr>
                            <tr>
                                <th>Rate:</th>
                                <td>Rs {{ number_format($sale->rate, 2) }}</td>
                            </tr>
                            <tr class="table-warning">
                                <th>Total Amount:</th>
                                <td>Rs {{ number_format($sale->quantity * $sale->rate, 2) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-master>