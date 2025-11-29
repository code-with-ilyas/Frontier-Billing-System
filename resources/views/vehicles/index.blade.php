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
        }

        .table td {
            vertical-align: middle;
            text-align: center;
            font-weight: 500;
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

        .table-container {
            overflow-x: auto;
        }

        .pagination {
            justify-content: center;
        }

        .pagination .page-item.active .page-link {
            background-color: #b38b00;
            border-color: #b38b00;
        }

        /* 🔍 Search input styling */
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
    </style>

    <div class="container mt-5">
        <div class="card-custom">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold text-dark mb-0">🚗 Vehicles & Customers Records</h4>
                <div class="d-flex gap-2">
                    <input type="text" id="searchInput" placeholder="Search by Customer Name...">
                    <a href="{{ route('vehicles.create') }}" class="btn btn-gold px-3">
                        <i class="fas fa-plus-circle me-1"></i> Add Vehicle
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success text-center fw-bold shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-container">
                <table class="table table-bordered table-hover align-middle" id="vehiclesTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Vehicle Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="vehicleData">
                        @forelse($vehicles as $vehicle)
                            <tr>
                               <td>{{ $vehicles->firstItem() + $loop->index }}</td>

                                <td>{{ $vehicle->customer_name }}</td>
                                <td>{{ $vehicle->vehicle_number }}</td>
                                <td>
                                    <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn btn-sm btn-edit me-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-delete" onclick="return confirm('Are you sure to delete this vehicle?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center fw-bold text-muted">No Vehicles Found 🚗</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

             <div class="mt-3" id="paginationContainer">
                {{ $vehicles->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>

    <script>
        // ✅ Live Search (AJAX)
        document.getElementById('searchInput').addEventListener('keyup', function () {
            let query = this.value;

            fetch(`{{ route('vehicles.index') }}?search=${query}`)
                .then(response => response.text())
                .then(data => {
                    const parser = new DOMParser();
                    const htmlDoc = parser.parseFromString(data, 'text/html');
                    const newTable = htmlDoc.querySelector('#vehicleData').innerHTML;
                    const newPagination = htmlDoc.querySelector('#paginationContainer').innerHTML;
                    document.querySelector('#vehicleData').innerHTML = newTable;
                    document.querySelector('#paginationContainer').innerHTML = newPagination;
                });
        });
    </script>
</x-master>
