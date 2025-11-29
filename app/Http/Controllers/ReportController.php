<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Sale;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::all();
        $sales = collect(); // empty collection initially

        // Build query
        $query = Sale::with(['saleItems.product', 'customer']);

        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('date', [$request->from_date, $request->to_date]);
        }

        // Only fetch if customer is selected
        if ($request->filled('customer_id')) {
            $sales = $query->get();
        }

        return view('reports.index', compact('customers', 'sales'));
    }

    public function create()
{
    $customers = \App\Models\Customer::all();
    $products  = \App\Models\Product::all();
    return view('reports.create', compact('customers', 'products'));
}

public function store(Request $request)
{
    $request->validate([
        'customer_id' => 'required',
        'head' => 'required|string',
        'from_date' => 'required|date',
        'to_date'   => 'required|date',
        'products.*.product_id' => 'required',
        'products.*.quantity'   => 'required|numeric|min:1',
        'products.*.rate'       => 'required|numeric|min:0',
        'products.*.date'       => 'required|date',
    ]);

    foreach ($request->products as $product) {
        $sale = \App\Models\Sale::create([
            'customer_id' => $request->customer_id,
            'head'        => $request->head,
            'date'        => $product['date'],
        ]);

        $sale->saleItems()->create([
            'product_id' => $product['product_id'],
            'quantity'   => $product['quantity'],
            'rate'       => $product['rate'],
        ]);
    }

    // 👉 Redirect directly to the report page with filters applied
    return redirect()->route('reports.index', [
        'customer_id' => $request->customer_id,
        'from_date'   => $request->from_date,
        'to_date'     => $request->to_date,
    ])->with('success', 'Entries saved and report ready to print!');
}


}
