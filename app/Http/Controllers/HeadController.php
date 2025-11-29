<?php

namespace App\Http\Controllers;

use App\Models\Head;
use Illuminate\Http\Request;

class HeadController extends Controller
{
    // 🔹 Show the create form
    public function create()
    {
        return view('heads.create');
    }

    // 🔹 Store new head(s)
    public function store(Request $request)
    {
        $request->validate([
            'head_name.*' => 'required|string',
        ]);

        foreach ($request->head_name as $headName) {
            // Check if the head already exists
            $head = Head::where('head_name', $headName)->first();

            if (!$head) {
                // Create new head if it doesn't exist
                Head::create([
                    'head_name' => $headName,
                ]);
            }
        }

        return redirect()->route('heads.create')->with('success', 'Heads added successfully.');
    }

    // 🔹 Edit a specific head (by ID)
    public function edit($id)
    {
        $head = Head::findOrFail($id);
        return view('heads.edit', compact('head'));
    }

    // 🔹 Update a specific head
    public function update(Request $request, Head $head)
    {
        $request->validate([
            'head_name' => 'required|string',
        ]);

        $head->update([
            'head_name' => $request->head_name,
        ]);

        return redirect()->route('heads.report')->with('success', 'Head updated successfully.');
    }

    // 🔹 Delete a head
    public function destroy(Head $head)
    {
        $head->delete();
        return redirect()->route('heads.report')->with('success', 'Head deleted successfully.');
    }

     // 🔹 Report page with search + pagination
    public function report(Request $request)
    {
        $search = $request->input('search');

        $heads = Head::with('products')
            ->when($search, function ($query, $search) {
                $query->where('head_name', 'like', "%{$search}%")
                    ->orWhereHas('products', function ($q) use ($search) {
                        $q->where('product_name', 'like', "%{$search}%")
                            ->orWhere('manufacture', 'like', "%{$search}%")
                            ->orWhere('category', 'like', "%{$search}%")
                            ->orWhere('units', 'like', "%{$search}%")
                            ->orWhere('price', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(1)
            ->withQueryString(); // keep search in pagination links

        // For AJAX search (JS fetch)
        if ($request->ajax()) {
            $view = view('heads.partials.table', compact('heads'))->render();
            $pagination = view('heads.partials.pagination', compact('heads'))->render();
            return response()->json([
                'table' => $view,
                'pagination' => $pagination,
            ]);
        }

        return view('heads.report', compact('heads', 'search'));
    }
}