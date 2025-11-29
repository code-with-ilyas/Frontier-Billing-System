<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
  public function index(Request $request)
{
    $query = Vehicle::query();

    if ($request->has('search')) {
        $search = $request->search;
        $query->where('customer_name', 'LIKE', "%{$search}%");
    }

    $vehicles = $query->orderBy('id', 'desc')->paginate(4);

    if ($request->ajax()) {
        return view('vehicles.index', compact('vehicles'));
    }

    return view('vehicles.index', compact('vehicles'));
}

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'vehicle_number' => 'required|string|max:100|unique:vehicles',
        ]);

        Vehicle::create($request->all());
        return redirect()->route('vehicles.create')->with('success', 'Vehicle added successfully.');
    }

    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'vehicle_number' => 'required|string|max:100|unique:vehicles,vehicle_number,' . $vehicle->id,
        ]);

        $vehicle->update($request->all());
        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }

  

 // ✅ FIXED: Single method for getting vehicles by customer
    public function getVehiclesByCustomer($customer_name)
    {
        $vehicles = Vehicle::where('customer_name', $customer_name)->get(['id', 'vehicle_number']);
        return response()->json($vehicles);
    }

}
