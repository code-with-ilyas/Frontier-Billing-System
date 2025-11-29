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

        #filterSelect {
            border-radius: 8px;
            border: 2px solid #b38b00;
            padding: 6px 10px;
            outline: none;
            background: white;
            transition: 0.3s ease;
        }

        #filterSelect:focus {
            box-shadow: 0 0 8px rgba(179, 139, 0, 0.5);
        }
    </style>

    <div class="container mt-5">
        <div class="card-custom">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold text-dark mb-0">🍔 Products List</h4>
                <a href="{{ route('products.create') }}" class="btn btn-gold px-3">
                    <i class="fas fa-plus-circle me-1"></i> Add Product
                </a>
            </div>

            <!-- Search + Filter -->
            <div class="d-flex align-items-center gap-2 mb-4">
                <input type="text" id="searchInput" placeholder="Search products...">
                <select id="filterSelect">
                    <option value="all">All</option>
                    <option value="head">Head</option>
                    <option value="product">Product</option>
                    <option value="manufacture">Manufacture</option>
                    <option value="units">Units</option>
                    <option value="price">Price</option>
                   
                </select>
            </div>

            @if(session('success'))
                <div class="alert alert-success text-center fw-bold shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle" id="productsTable">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>Head</th>
                            <th>Product Name</th>
                            <th>Manufacture</th>
                            <th>Units</th>
                            <th>Price</th>
                           
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productsTableBody">
                        @forelse($products as $product)
                            <tr>
                                <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
                                <td class="head">{{ $product->head->head_name ?? 'N/A' }}</td>
                                <td class="product">{{ $product->product_name }}</td>
                                <td class="manufacture">{{ $product->manufacture ?? '-' }}</td>
                                <td class="units">{{ $product->units }}</td>
                                <td class="price">{{ $product->price }}</td>
                               
                                <td class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this product?');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-delete">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center fw-bold text-muted">No products found 🍽️</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <!-- ✅ Client-side Search + Filter -->
    <script>
        const searchInput = document.getElementById('searchInput');
        const filterSelect = document.getElementById('filterSelect');
        const tableRows = document.querySelectorAll('#productsTableBody tr');

        searchInput.addEventListener('keyup', filterTable);
        filterSelect.addEventListener('change', filterTable);

        function filterTable() {
            const searchText = searchInput.value.toLowerCase();
            const filter = filterSelect.value;

            tableRows.forEach(row => {
                const head = row.querySelector('.head').textContent.toLowerCase();
                const product = row.querySelector('.product').textContent.toLowerCase();
                const manufacture = row.querySelector('.manufacture').textContent.toLowerCase();
                const units = row.querySelector('.units').textContent.toLowerCase();
                const price = row.querySelector('.price').textContent.toLowerCase();
              

                let match = false;

                switch (filter) {
                    case 'head': match = head.includes(searchText); break;
                    case 'product': match = product.includes(searchText); break;
                    case 'manufacture': match = manufacture.includes(searchText); break;
                    case 'units': match = units.includes(searchText); break;
                    case 'price': match = price.includes(searchText); break;
                   
                    default:
                        match = head.includes(searchText) || product.includes(searchText) ||
                            manufacture.includes(searchText) || units.includes(searchText) ||
                            price.includes(searchText) || category.includes(searchText);
                }

                row.style.display = match ? '' : 'none';
            });
        }
    </script>

    <style>
        table.table td, table.table th {
            color: #000 !important;
        }
    </style>
</x-master>
