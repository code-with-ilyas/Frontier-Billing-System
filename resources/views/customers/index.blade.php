<x-master>
    <div class="container mt-4">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top py-2">
                <h5 class="mb-0 fw-bold">CUSTOMERS LIST</h5>
            </div>
            <br>

            <!-- Sexy Yellow Search Bar (Live AJAX) -->
            <div class="mb-4">
                <div class="d-flex align-items-center bg-white shadow rounded-pill px-3 py-2"
                    style="border: 2px solid #ffc107; backdrop-filter: blur(6px);">

                    <!-- Search Icon -->
                    <i class="fas fa-search me-2" style="color: #ffc107; font-size:18px;"></i>

                    <!-- Input -->
                    <input type="text" id="searchInput"
                        class="form-control border-0 bg-transparent"
                        style="box-shadow: none; font-size: 16px; color:#343a40;"
                        placeholder="Search by Customer Name or ID Number...">
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle mb-0">
                        <thead class="bg-primary text-dark">
                            <tr>
                                <th>S.No</th>
                                <th>Customer Name</th>
                                <th>Description</th>
                                <th>Starting Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="customersTableBody" class="text-dark">
                            @forelse ($customers as $customer)
                            <tr>
                                <td>{{ ($customers->currentPage() - 1) * $customers->perPage() + $loop->iteration }}</td>
                                <td>{{ $customer->customer_name }}</td>
                                <td>{{ $customer->description ?? '-' }}</td>
                                <td>{{ $customer->starting_date ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-info btn-sm">Show</a>
                                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure to delete this customer?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No customers found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination Links -->
        <div class="mt-3">
            {{ $customers->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <style>
        table.table td,
        table.table th {
            color: #000 !important;
        }
    </style>

    <!-- ✅ Live Search Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById("searchInput");
            const tableBody = document.getElementById("customersTableBody");

            let timer;
            searchInput.addEventListener("keyup", function () {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    fetch(`{{ route('customers.index') }}?search=${searchInput.value}`, {
                        headers: { "X-Requested-With": "XMLHttpRequest" }
                    })
                    .then(res => res.json())
                    .then(data => {
                        tableBody.innerHTML = "";
                        if (data.customers.length > 0) {
                            let serial = 1; // Start serial at 1 for search results
                            data.customers.forEach(customer => {
                                tableBody.innerHTML += `
                                    <tr>
                                        <td>${serial++}</td>
                                        <td>${customer.customer_name}</td>
                                        <td>${customer.description ?? '-'}</td>
                                        <td>${customer.starting_date ?? '-'}</td>
                                        <td class="text-center">
                                            <a href="/customers/${customer.id}" class="btn btn-info btn-sm">Show</a>
                                            <a href="/customers/${customer.id}/edit" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="/customers/${customer.id}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure to delete this customer?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                `;
                            });
                        } else {
                            tableBody.innerHTML = `
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No customers found</td>
                                </tr>
                            `;
                        }
                    });
                }, 400); // debounce 400ms
            });
        });
    </script>
</x-master>
