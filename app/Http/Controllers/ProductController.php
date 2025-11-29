<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Head;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function index(Request $request)
{
    $query = Product::with('head');

    // 🔍 Apply search filter
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('product_name', 'LIKE', "%{$search}%")
              ->orWhere('manufacture', 'LIKE', "%{$search}%")
             
              ->orWhere('units', 'LIKE', "%{$search}%")
              ->orWhere('price', 'LIKE', "%{$search}%")
              ->orWhereHas('head', function ($subQuery) use ($search) {
                  $subQuery->where('head_name', 'LIKE', "%{$search}%");
              });
        });
    }

    // ✅ Pagination (10 per page) and preserve search
    $products = $query->latest()->paginate(1)->appends($request->all());

    $heads = Head::all();

    // ✅ Return AJAX if request is AJAX (for live search)
    if ($request->ajax()) {
        return view('products.partials.table', compact('products'))->render();
    }

    return view('products.index', compact('products', 'heads'));
}


    public function create()
    {
        $heads = Head::all();
        return view('products.create', compact('heads'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'head_id' => 'required|exists:heads,id',
            'product_name' => 'required|string|max:255',
            'manufacture' => 'nullable|string|max:255',
            'units' => 'required|integer',
            'price' => 'required|numeric',
            
        ]);

        Product::create($request->all());
        return redirect()->route('products.create')->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $heads = Head::all();
        return view('products.edit', compact('product', 'heads'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'head_id' => 'required|exists:heads,id',
            'product_name' => 'required|string|max:255',
            'manufacture' => 'nullable|string|max:255',
            'units' => 'required|integer',
            'price' => 'required|numeric',
            
        ]);

        Product::findOrFail($id)->update($request->all());
        return redirect()->route('heads.report')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

  public function getProductsByHead($headId)
{
    // Fetch only products for the selected head
    $products = \App\Models\Product::where('head_id', $headId)
                ->select('id', 'product_name') // select only needed fields
                ->get();

    return response()->json($products);
}

}
