<x-master>
    <style>
        body {
            background: linear-gradient(135deg, #e0c446ff, #ffecb3);
        }

        .card-custom {
            background: linear-gradient(145deg, #d6a922ff, #ffecb3);
            border: 2px solid #b38b00;
            border-radius: 1rem;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .btn-warning-custom {
            background-color: #ffc107;
            color: #000;
            font-weight: bold;
            border-radius: 0.5rem;
            transition: 0.3s;
        }

        .btn-warning-custom:hover {
            background-color: #d4c329ff;
            color: #000;
        }

        table.table th,
        table.table td {
            color: #000 !important;
        }
    </style>

    <div class="container d-flex justify-content-center align-items-start mt-5">
        <div class="card shadow-lg p-4 card-custom" style="min-width: 420px;">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold text-dark mb-0">🟡 Add Head</h4>
                <button type="submit" id="saveBtn" form="headsForm" class="btn btn-warning-custom px-3">Save</button>
            </div>

            @if(session('success'))
                <div class="alert alert-success fw-bold text-center p-2 mb-3" id="successMessage">
                    {{ session('success') }}
                </div>
            @endif

            <form id="headsForm" action="{{ route('heads.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold text-dark">Head Name:</label>
                    <input type="text" id="headInput" class="form-control border-dark enter-field" placeholder="Enter Head" autofocus>
                </div>

                <div class="mb-3 text-end">
                    <button type="button" class="btn btn-success btn-sm btn-add">Add</button>
                </div>

                <table class="table table-bordered table-sm" id="headsTable">
                    <thead class="bg-warning text-dark">
                        <tr>
                            <th>S.No</th>
                            <th>Head</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tableBody = document.querySelector('#headsTable tbody');
            const headInput = document.getElementById('headInput');
            const form = document.getElementById('headsForm');
            const saveBtn = document.getElementById('saveBtn');
            let count = 1;

            function addHead() {
                const head = headInput.value.trim();
                if (!head) {
                    alert('Please enter Head name!');
                    return;
                }

                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${count++}</td>
                    <td>${head}</td>
                    <td><button type="button" class="btn btn-danger btn-sm btn-remove">Remove</button></td>
                `;
                tableBody.appendChild(tr);

                const hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'head_name[]';
                hidden.value = head;
                form.appendChild(hidden);

                headInput.value = '';
                headInput.focus();
            }

            // Add button click
            document.querySelector('.btn-add').addEventListener('click', addHead);

            // Press Enter to add, then focus Save button
            headInput.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addHead();
                    saveBtn.focus();
                }
            });

            // Remove row
            tableBody.addEventListener('click', (e) => {
                if (e.target.classList.contains('btn-remove')) {
                    const row = e.target.closest('tr');
                    const head = row.children[1].innerText;

                    form.querySelectorAll('input[name="head_name[]"]').forEach(i => {
                        if (i.value === head) i.remove();
                    });
                    row.remove();
                }
            });
        });
    </script>
</x-master>
