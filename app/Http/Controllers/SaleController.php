<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Head;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $query = Sale::with(['head', 'product', 'vehicle'])->latest();

        // Column-specific filters
        $columns = ['customer_name', 'bill_month', 'bill_year', 'entry_date', 'issue_date'];

        foreach ($columns as $col) {
            if ($request->filled($col)) {
                $query->where($col, 'like', "%{$request->$col}%");
            }
        }

        // Global search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', "%$search%")
                    ->orWhere('bill_month', 'like', "%$search%")
                    ->orWhere('bill_year', 'like', "%$search%")
                    ->orWhere('entry_date', 'like', "%$search%")
                    ->orWhere('issue_date', 'like', "%$search%")
                    ->orWhereHas('head', function ($q) use ($search) {
                        $q->where('head_name', 'like', "%$search%");
                    })
                    ->orWhereHas('product', function ($q) use ($search) {
                        $q->where('product_name', 'like', "%$search%");
                    });
            });
        }

        // Pagination
        $sales = $query->paginate(10);
        $sales->appends($request->all());

        // AJAX response
        if ($request->ajax()) {
            $data = [];
            foreach ($sales as $sale) {
                $data[] = [
                    'id' => $sale->id,
                    'entry_date' => $sale->entry_date ?? '-',
                    'bill_month' => $sale->bill_month ?? '-',
                    'bill_year' => $sale->bill_year ?? '-',
                    'issue_date' => $sale->issue_date ?? '-',
                    'customer_name' => $sale->customer_name ?? '-',
                     'vehicle_number' => $sale->vehicle_number ?? '-', // ✅ Added line
                    'head' => $sale->head?->head_name ?? '-',
                    'product' => $sale->product?->product_name ?? '-',
                    'quantity' => $sale->quantity ?? 0,
                    'rate' => number_format($sale->rate, 2),
                    'total_amount' => number_format($sale->total_amount ?? ($sale->quantity * $sale->rate), 2),
                ];
            }

            return response()->json([
                'sales' => $data,
                'pagination' => [
                    'total' => $sales->total(),
                    'current_page' => $sales->currentPage(),
                    'last_page' => $sales->lastPage(),
                ]
            ]);
        }

        return view('sales.index', compact('sales'));
    }


    // Show form for creating a new sale
    public function create()
    {
        $heads = Head::all();
        // ✅ Get customers who have vehicles from vehicles table
        $customers = Vehicle::select('customer_name')->distinct()->orderBy('customer_name')->get();
        $products = Product::all();
        $vehicles = Vehicle::all();

        return view('sales.create', compact('heads', 'customers', 'products', 'vehicles'));
    }

    // AJAX: fetch products per head
    public function headProducts($headId)
    {
        $products = Product::where('head_id', $headId)
            ->get(['id', 'product_name', 'price']);
        return response()->json($products);
    }


    public function store(Request $request)
    {
        $request->validate([
            'sale_items' => 'required|array|min:1',
            'sale_items.*.issue_date' => 'required|string',
            'sale_items.*.customer_name' => 'required|string|max:255',
            'sale_items.*.head_id' => 'required|exists:heads,id',
            'sale_items.*.product_id' => 'required|exists:products,id',
            'sale_items.*.quantity' => 'required|integer|min:1',
            'sale_items.*.rate' => 'required|numeric|min:0',
            'sale_items.*.vehicle_number' => 'nullable|string|max:255', // ✅ updated
            'entry_date' => 'required|string',
            'bill_month' => 'required',
            'bill_year' => 'required',
        ]);

        // Convert entry_date once
        $entry_date = Carbon::createFromFormat('d/m/Y', $request->entry_date)->format('Y-m-d');

        foreach ($request->sale_items as $item) {
            $issue_date = Carbon::createFromFormat('d/m/Y', $item['issue_date'])->format('Y-m-d');

            Sale::create([
                'entry_date' => $entry_date,
                'bill_month' => $request->bill_month,
                'bill_year' => $request->bill_year,
                'issue_date' => $issue_date,
                'customer_name' => $item['customer_name'],
                'head_id' => $item['head_id'],
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'rate' => $item['rate'],
                'vehicle_number' => $item['vehicle_number'] ?? null, // ✅ store vehicle number
            ]);
        }

        return redirect()->route('sales.index')->with('success', 'Sale created successfully.');
    }




    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        $heads = Head::all();

        // Get customers who have vehicles (same as create)
        $customers = Vehicle::select('customer_name')
            ->distinct()
            ->orderBy('customer_name')
            ->get();

        $products = Product::all();
        $vehicles = Vehicle::all();

        return view('sales.edit', compact('sale', 'heads', 'customers', 'products', 'vehicles'));
    }



    // Show single sale
    public function show(Sale $sale)
    {
        $sale->load(['head', 'product', 'vehicle']);
        return view('sales.show', compact('sale'));
    }

    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'entry_date' => 'required|string',
            'bill_month' => 'required',
            'bill_year' => 'required',
            'issue_date' => 'required|string',
            'customer_name' => 'required|string|max:255',
            'head_id' => 'required|exists:heads,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'rate' => 'required|numeric|min:0',
            'vehicle_number' => 'nullable|string|max:255',
        ]);

        $entry_date = Carbon::createFromFormat('d/m/Y', $request->entry_date)->format('Y-m-d');
        $issue_date = Carbon::createFromFormat('d/m/Y', $request->issue_date)->format('Y-m-d');

        $sale->update([
            'entry_date' => $entry_date,
            'bill_month' => $request->bill_month,
            'bill_year' => $request->bill_year,
            'issue_date' => $issue_date,
            'customer_name' => $request->customer_name,
            'head_id' => $request->head_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'rate' => $request->rate,
            'vehicle_number' => $request->vehicle_number ?? null,
        ]);

        return redirect()->route('sales.index')->with('success', 'Sale updated successfully.');
    }

    // Delete sale
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }

   public function report(Request $request)
{
    $query = Sale::with(['head', 'product', 'vehicle']);
    $hasFilters = false;

    if ($request->filled('customer_name')) {
        $query->where('customer_name', $request->customer_name);
        $hasFilters = true;
    }

    // Add vehicle number filter
    if ($request->filled('vehicle_number')) {
        $query->where('vehicle_number', $request->vehicle_number);
        $hasFilters = true;
    }

    if ($request->filled('from_date') && $request->filled('to_date')) {
        $query->whereBetween('issue_date', [$request->from_date, $request->to_date]);
        $hasFilters = true;
    }

    $sales = $hasFilters ? $query->orderBy('created_at', 'desc')->get() : collect([]);
    $totalSales = $sales->sum(fn($s) => $s->quantity * $s->rate);
    
    // Get customers from vehicles table
    $customers = Vehicle::select('customer_name')->distinct()->orderBy('customer_name')->get();
    $heads = Head::orderBy('head_name')->get();

    // Generate sequential bill number
    $billNo = 1; // Default bill number
    if ($sales->count() > 0) {
        // You can use different logic for bill numbering:
        // Option 1: Simple sequential based on count
        $billNo = $sales->count();
        
        // Option 2: Get the latest bill number from database and increment
        // $latestBill = Sale::orderBy('id', 'desc')->first();
        // $billNo = $latestBill ? $latestBill->id + 1 : 1;
        
        // Option 3: Use the first sale ID in the results
        // $billNo = $sales->first()->id;
    }

    return view('sales.report', compact('sales', 'totalSales', 'customers', 'heads', 'billNo'));
}
    // Show reports form
    public function form()
    {
        // ✅ FIX: Get customers from vehicles table
        $customers = Vehicle::select('customer_name')->distinct()->orderBy('customer_name')->get();
        return view('sales.form', compact('customers'));
    }

    // Show report results
    public function view(Request $request)
    {
        $customer_name = $request->customer_name;
        $date = $request->date;

        $sales = Sale::with('product', 'vehicle')
            ->where('customer_name', $customer_name)
            ->whereDate('issue_date', $date)
            ->get();

        $total = $sales->sum(fn($sale) => $sale->quantity * $sale->rate);

        return view('sales.view', compact('sales', 'total'));
    }

    // Saved bills
    public function savedBills()
    {
        return view('saved_bill');
    }

    // Vehicle-wise bills
    public function vehicleBills()
    {
        $vehicles = Vehicle::all();
        $sales = Sale::query();

        if (request('vehicle_number')) {
            $sales->where('vehicle_number', request('vehicle_number'));
        }

        $sales = $sales->with(['product', 'head'])->get();
        $totalSales = $sales->sum(fn($sale) => $sale->quantity * $sale->rate);

        return view('vehicle_bill', compact('vehicles', 'sales', 'totalSales'));
    }
}
