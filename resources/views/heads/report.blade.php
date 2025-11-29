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

        #searchInput {
            width: 300px;
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
                <h4 class="fw-bold text-dark mb-0">🧾 Heads & Products Report</h4>
                <div class="d-flex gap-2">
                    <input type="text" id="searchInput" placeholder="Search by Head or Product...">
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success text-center fw-bold shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-container">
                <table class="table table-bordered table-hover align-middle" id="headsTable">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Head</th>
                            <th>Product Name</th>
                            <th>Manufacture</th>
                            <th>Units</th>
                            <th>Price</th>
                           
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="headData">
                        @php
                            $groupedHeads = $heads->groupBy('head_name');
                        @endphp

                        @forelse($groupedHeads as $headName => $headGroup)
                            @foreach($headGroup as $head)
                                @if($loop->first)
                                    @foreach($head->products as $index => $product)
                                    <tr>
                                        @if($index === 0)
                                            <td rowspan="{{ $headGroup->sum(fn($h) => $h->products->count()) }}">{{ $loop->parent->iteration }}</td>
                                            <td rowspan="{{ $headGroup->sum(fn($h) => $h->products->count()) }}">{{ $headName }}</td>
                                        @endif
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->manufacture ?? '-' }}</td>
                                        <td>{{ $product->units }}</td>
                                        <td>{{ $product->price }}</td>
                                        
                                        @if($index === 0)
                                            <td rowspan="{{ $headGroup->sum(fn($h) => $h->products->count()) }}">
                                                <form action="{{ route('heads.destroy', $head->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this head?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-delete">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                @endif
                            @endforeach

                            @if($headGroup->sum(fn($h) => $h->products->count()) === 0)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $headName }}</td>
                                    <td colspan="5" class="text-muted">No Products</td>
                                    <td>
                                        <form action="{{ route('heads.destroy', $headGroup->first()->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this head?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-delete">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted fw-bold">No Records Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

           

            <div class="mt-3" id="paginationContainer">
                {{ $heads->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function () {
            let query = this.value;
            fetch(`{{ route('heads.report') }}?search=${query}`)
                .then(response => response.text())
                .then(data => {
                    const parser = new DOMParser();
                    const htmlDoc = parser.parseFromString(data, 'text/html');
                    const newTable = htmlDoc.querySelector('#headData').innerHTML;
                    const newPagination = htmlDoc.querySelector('#paginationContainer').innerHTML;
                    document.querySelector('#headData').innerHTML = newTable;
                    document.querySelector('#paginationContainer').innerHTML = newPagination;
                });
        });
    </script>
</x-master>
