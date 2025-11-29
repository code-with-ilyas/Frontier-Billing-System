<x-master>
    <div class="container-fluid mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top py-2">
                        <h5 class="mb-0 text-dark fw-bold">EDIT HEAD</h5>

                        <div>
                            <a href="{{ route('heads.report') }}" class="btn btn-warning btn-sm fw-bold me-2">Back</a>
                            <button type="submit" form="headsEditForm" class="btn btn-success btn-sm fw-bold">
                                UPDATE
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-3">
                        <form action="{{ route('heads.update', $head->id) }}" method="POST" id="headsEditForm">
                            @csrf
                            @method('PUT')

                            <!-- Head Section -->
                            <h5 class="fw-bold text-dark mt-4 mb-2">Head Information</h5>
                            <div id="dynamicFields">
                                <div class="row mb-2">
                                    <div class="col">
                                        <input type="text" id="headInput" class="form-control form-control-sm"
                                               placeholder="Head" value="{{ $head->head_name }}">
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <h5 class="fw-bold">Preview</h5>
                            <table class="table table-bordered table-sm" id="headsTable">
                                <thead class="bg-warning text-dark">
                                    <tr>
                                        <th>Head</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $head->head_name }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Hidden inputs -->
                            <input type="hidden" name="head_name" value="{{ $head->head_name }}">
                            <input type="hidden" name="unit" value="{{ $head->unit }}">
                            <input type="hidden" name="price" value="{{ $head->price }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        input.form-control,
        textarea.form-control,
        select.form-control {
            color: #000 !important;
            font-weight: 500;
        }
        input::placeholder,
        textarea::placeholder {
            color: #555 !important;
        }
        #headsTable td,
        #headsTable th {
            color: #000 !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('headsEditForm');
            const headInput = document.getElementById('headInput');
            const unitInput = document.getElementById('unitInput');
            const priceInput = document.getElementById('priceInput');

            form.addEventListener('submit', function() {
                form.querySelector('input[name="head_name"]').value = headInput.value;
                form.querySelector('input[name="unit"]').value = unitInput ? unitInput.value : '';
                form.querySelector('input[name="price"]').value = priceInput ? priceInput.value : '';
            });
        });
    </script>
</x-master>
