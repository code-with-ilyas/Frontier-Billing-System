<x-master>
    <style>
        /* ---------------------- Page & Container ---------------------- */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            background: linear-gradient(180deg, #f3f6fb 0%, #eaf2ff 100%);
            font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            color: #1f2937;
        }

        .page-wrap {
            max-width: 1280px;
            margin: 24px auto;
            padding: 18px;
        }

        /* ---------------------- Filter Card Design ---------------------- */
        .filter-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 24px;
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

        .back-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            color: white;
        }

        /* ---------------------- Stats Bar ---------------------- */
        .stats-bar {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 12px;
        }

        .stat-card {
            background: linear-gradient(135deg, #e6f0ff, #d2e8ff);
            border-radius: 10px;
            padding: 10px 14px;
            min-width: 160px;
            box-shadow: 0 6px 18px rgba(11, 86, 163, 0.06);
            border: 1px solid rgba(11, 86, 163, 0.06);
        }

        .stat-number {
            font-weight: 700;
            color: #063970;
            font-size: 1.2rem;
        }

        .stat-label {
            font-size: 0.85rem;
            color: #475569;
            margin-top: 4px;
        }

        /* ---------------------- Search ---------------------- */
        .search-input {
            padding: 10px 14px;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            width: 100%;
            outline: none;
            box-shadow: none;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        /* ---------------------- Grid ---------------------- */
        .bills-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-top: 18px;
        }

        /* Responsive columns */
        @media (max-width: 1100px) {
            .bills-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 900px) {
            .bills-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 520px) {
            .bills-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ---------------------- Bill Card ---------------------- */
        .bill-card {
            background: white;
            border-radius: 12px;
            padding: 14px;
            box-shadow: 0 8px 30px rgba(3, 40, 80, 0.05);
            border: 1px solid rgba(11, 86, 163, 0.06);
            transition: transform 180ms ease, box-shadow 180ms ease;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-height: 120px;
            position: relative;
            overflow: hidden;
        }

        .bill-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 40px rgba(3, 40, 80, 0.09);
        }

        .bill-summary {
            background: linear-gradient(90deg, #0b56a3, #3b82f6);
            color: white;
            padding: 10px 14px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            font-size: 0.95rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .bill-body {
            margin-top: 10px;
        }

        .bill-mid {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .bill-date {
            color: #64748b;
            font-size: 0.9rem;
        }

        .bill-amount {
            font-size: 1rem;
            font-weight: 700;
            color: #0b56a3;
        }

        .bill-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }

        .bill-id {
            font-size: 0.78rem;
            color: #94a3b8;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-view {
            background: #0b56a3;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 8px;
            font-size: 0.85rem;
            cursor: pointer;
        }

        .btn-del {
            background: #ef4444;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 8px;
            font-size: 0.85rem;
            cursor: pointer;
        }

        /* Type badges */
        .type-badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .type-customer {
            background: linear-gradient(135deg, #48bb78, #38a169);
            color: white;
        }

        .type-vehicle {
            background: linear-gradient(135deg, #ed8936, #dd6b20);
            color: white;
        }

        .type-unknown {
            background: linear-gradient(135deg, #a0aec0, #718096);
            color: white;
        }

        /* Empty state card */
        .empty-state {
            grid-column: 1 / -1;
            background: white;
            border-radius: 12px;
            padding: 28px;
            text-align: center;
            box-shadow: 0 8px 30px rgba(3, 40, 80, 0.04);
            color: #334155;
        }

        /* print / view window small tweaks */
        .view-window .bill-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 18px;
            background: white;
            color: #000;
        }
    </style>

    <div class="page-wrap">
        <!-- Filter Card Section -->
        <div class="filter-card">
            <!-- Header Section -->
            <div class="filter-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="filter-title">
                            <i class="fas fa-history me-2"></i>
                            SAVED BILLS HISTORY
                        </h3>
                        <p class="filter-subtitle">
                            View, search and filter your saved bills
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
                <div class="row g-4">
                    <!-- Search Filter -->
                    <div class="col-md-6">
                        <div class="filter-group">
                            <label class="form-label">
                                <i class="fas fa-search me-2"></i>Search Bills
                            </label>
                            <input id="billSearch" class="form-control filter-control search-input" 
                                   placeholder="Search by customer, vehicle, bill number, amount...">
                        </div>
                    </div>

                    <!-- Type Filter -->
                    <div class="col-md-3">
                        <div class="filter-group">
                            <label class="form-label">
                                <i class="fas fa-filter me-2"></i>Filter by Type
                            </label>
                            <select id="typeFilter" class="form-control filter-control">
                                <option value="all">All Types</option>
                                <option value="customer">Customer Bills</option>
                                <option value="vehicle">Vehicle Bills</option>
                            </select>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-md-3">
                        <div class="filter-group">
                            <label class="form-label">&nbsp;</label>
                            <div class="action-buttons">
                                <button type="button" class="btn-filter btn-reset" onclick="resetFilters()">
                                    <i class="fas fa-redo me-2"></i>Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Bar -->
                <div class="stats-bar" id="statsBar">
                    <!-- JS populates stat cards -->
                </div>
            </div>
        </div>

        <!-- Bills Grid -->
        <div class="bills-grid" id="savedBillsList">
            <!-- JS will render bill-cards here -->
        </div>
    </div>

    {{-- ============================
        Bill Card Template - SIMPLIFIED VERSION
       ============================ --}}
    <script>
        const billCardTemplate = bill => {
            // Determine bill type and styling - SIMPLIFIED
            let typeClass = 'type-unknown';
            let typeLabel = 'Unknown';
            let displayName = 'Bill';
            
            if (bill.type === 'vehicle') {
                typeClass = 'type-vehicle';
                typeLabel = 'Vehicle ';
                displayName = 'Vehicle ';
            } else if (bill.type === 'customer') {
                typeClass = 'type-customer';
                typeLabel = 'Customer';
                displayName = 'Customer';
            }
            
            return `
        <div class="bill-card" data-id="${bill.id}">
            
            <!-- Bill Summary Section -->
            <div class="bill-summary">
                <div style="text-align:left;">
                    <div style="font-size:0.9rem; font-weight:bold;"> BILL NUMBER # ${bill.billNumber || 'No Number'}</div>
                   
                </div>
                <div style="text-align:right;">
                    <span class="type-badge ${typeClass}">${typeLabel}</span>
                </div>
            </div>

            <!-- Card Body -->
            <div class="bill-body">
                <div class="bill-mid">
                    <div class="bill-date">
                        ${bill.date || bill.timestamp || 'No Date'}
                    </div>
                    <div class="bill-amount">
                        ${bill.totalAmount || 'Rs 0.00'}
                    </div>
                </div>

               
                    <div class="action-buttons">
                        <button class="btn-del" onclick="event.stopPropagation(); deleteSavedBill('${bill.id}')">
                            🗑 Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
        };
    </script>

    <script>
        // ========== Data helpers ==========
        function getSavedBills() {
            try {
                return JSON.parse(localStorage.getItem('savedBills') || '[]');
            } catch (e) {
                console.error('Invalid savedBills JSON', e);
                return [];
            }
        }

        function setSavedBills(list) {
            localStorage.setItem('savedBills', JSON.stringify(list));
        }

        // ========== SIMPLIFIED Bill Type Detection ==========
        function detectBillType(bill) {
            // If type is explicitly set, use it
            if (bill.type) return bill.type;
            
            // Auto-detect based on available fields
            if (bill.vehicle) return 'vehicle';
            if (bill.customer) return 'customer';
            
            return 'unknown';
        }

        // ========== Render / Stats / Search ==========
        function loadStats() {
            const bills = getSavedBills();
            const totalBills = bills.length;
            const totalAmount = bills.reduce((sum, b) => {
                const n = parseFloat((b.totalAmount || '').toString().replace(/[^\d.-]/g, '')) || 0;
                return sum + n;
            }, 0);
            
            // SIMPLIFIED counting
            let customerBills = 0;
            let vehicleBills = 0;
            let unknownBills = 0;
            
            bills.forEach(bill => {
                const detectedType = detectBillType(bill);
                switch(detectedType) {
                    case 'customer': customerBills++; break;
                    case 'vehicle': vehicleBills++; break;
                    default: unknownBills++; break;
                }
            });

            const statsBar = document.getElementById('statsBar');
            statsBar.innerHTML = `
                <div class="stat-card">
                    <div class="stat-number">${totalBills}</div>
                    <div class="stat-label">Total Bills</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">Rs ${totalAmount.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})}</div>
                    <div class="stat-label">Total Amount</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">${customerBills}</div>
                    <div class="stat-label">Customer Bills</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">${vehicleBills}</div>
                    <div class="stat-label">Vehicle Bills</div>
                </div>
            `;
        }

        function renderBills(list) {
            const wrapper = document.getElementById('savedBillsList');
            if (!list || list.length === 0) {
                wrapper.innerHTML = `
                    <div class="empty-state">
                        <i style="font-size:36px;color:#0b56a3;">📄</i>
                        <h3 style="margin:12px 0 6px;">No Saved Bills Found</h3>
                        <p style="margin:0;color:#64748b;">No bills match your current filters. Try adjusting your search criteria.</p>
                    </div>
                `;
                return;
            }
            
            // Enhance bills with detected types for display
            const enhancedBills = list.map(bill => ({
                ...bill,
                displayType: detectBillType(bill)
            }));
            
            wrapper.innerHTML = enhancedBills.map(b => billCardTemplate(b)).join('');
            
            // attach click to whole card to view as well
            wrapper.querySelectorAll('.bill-card').forEach(node => {
                node.addEventListener('click', () => viewSavedBill(node.getAttribute('data-id')));
            });
        }

        // ========== Filter Functions ==========
        function filterBills() {
            const searchTerm = document.getElementById('billSearch').value.trim().toLowerCase();
            const typeFilter = document.getElementById('typeFilter').value;
            const allBills = getSavedBills();

            const filtered = allBills.filter(bill => {
                // Enhanced type filtering with detection
                if (typeFilter !== 'all') {
                    const detectedType = detectBillType(bill);
                    if (detectedType !== typeFilter) {
                        return false;
                    }
                }

                // Search filter
                if (!searchTerm) return true;

                const searchFields = [
                    bill.customer || '',
                    bill.vehicle || '',
                    bill.billNumber || '',
                    bill.totalAmount || '',
                    bill.date || '',
                    bill.timestamp || '',
                    detectBillType(bill)
                ];

                return searchFields.some(field => 
                    field.toString().toLowerCase().includes(searchTerm)
                );
            });

            renderBills(filtered);
        }

        function resetFilters() {
            document.getElementById('billSearch').value = '';
            document.getElementById('typeFilter').value = 'all';
            filterBills();
        }

        // ========== Delete & View functions ==========
        function deleteSavedBill(billId) {
            if (!confirm('Delete this bill? This action cannot be undone.')) return;
            const list = getSavedBills().filter(b => b.id !== billId);
            setSavedBills(list);
            filterBills();
            loadStats();
        }

        function viewSavedBill(billId) {
            const bills = getSavedBills();
            const bill = bills.find(b => b.id === billId);
            if (!bill) {
                alert('Bill not found');
                return;
            }

            const detectedType = detectBillType(bill);
            const title = detectedType === 'vehicle' ? 'Vehicle Bill' : 'Customer Bill';

            const win = window.open('', '_blank');
            win.document.write(`
                <!doctype html>
                <html>
                <head>
                    <meta charset="utf-8" />
                    <title>Bill - ${title}</title>
                    <meta name="viewport" content="width=device-width,initial-scale=1" />
                    <style>
                        body { font-family: Arial, Helvetica, sans-serif; margin:20px; background:#f8fafc; color:#000; }
                        .bill-container { max-width:900px; margin:0 auto; background:#fff; padding:18px; border-radius:8px; box-shadow:0 8px 30px rgba(3,40,80,0.06); }
                        .btns { margin-bottom:14px; text-align:center; }
                        .btn { padding:10px 16px; border-radius:8px; border:none; cursor:pointer; margin:0 6px; font-weight:700; }
                        .print { background: linear-gradient(90deg,#0b56a3,#3b82f6); color:#fff; }
                        .close { background:#ef4444; color:#fff; }
                        .items { width:100%; border-collapse:collapse; margin-top:12px; }
                        .items th { background:#dbeafe; color:#063970; padding:8px; text-align:left; }
                        .items td { padding:8px; border-bottom:1px solid #eee; }
                        @media print { .btns { display:none; } body { background:#fff; } }
                    </style>
                </head>
                <body>
                    <div class="btns">
                        <button class="btn print" onclick="window.print()">Print</button>
                        <button class="btn close" onclick="window.close()">Close</button>
                    </div>

                    <div class="bill-container">
                        ${bill.content || ('<h2>' + title + '</h2><p>Type: ' + detectedType + '</p>')}
                        
                        ${bill.items && Array.isArray(bill.items) ? `
                            <table class="items">
                                <thead><tr><th>Item</th><th>Qty</th><th>Rate</th><th>Amount</th></tr></thead>
                                <tbody>
                                    ${bill.items.map(it=>`<tr><td>${it.name}</td><td>${it.qty}</td><td>${it.rate}</td><td>${it.amount}</td></tr>`).join('')}
                                </tbody>
                            </table>
                        ` : ''}
                    </div>
                </body>
                </html>
            `);
            win.document.close();
        }

        // ========== Load logic & search ==========
        function loadSavedBills() {
            const bills = getSavedBills();
            renderBills(bills);
            loadStats();
        }

        // ========== Boot ==========
        document.addEventListener('DOMContentLoaded', function() {
            // Load initial bills & stats
            loadSavedBills();

            // Hook up search and filter events
            const search = document.getElementById('billSearch');
            const typeFilter = document.getElementById('typeFilter');
            
            let searchTimeout = null;
            search.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => filterBills(), 150);
            });

            typeFilter.addEventListener('change', filterBills);
        });
    </script>
</x-master>