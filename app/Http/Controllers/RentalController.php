<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rentals = Rental::paginate(5);

        return response()->json([
            'status' => true,
            'rentals' => $rentals,
        ] ,200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rental = Rental::create([
            'name' => $request->name,
            'type' => $request->type,
            'desc' => $request->desc,
            'adress' => $request->adress,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'max_persons' => $request->max_persons,
            'price_per_night' => $request->price_per_night,
            'service_id' => $request->service_id,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'rental has been created successfully',
            'rental' => $rental
        ] ,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $rental = Rental::findOrfail($request->id);
        
        return response()->json([
            'status' => true,
            'rental' => $rental
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rental $rental)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $updatedrental = Rental::findOrfail($request->id);
        
        $updatedrental->update([
            'name' => $request->name,
            'type' => $request->type,
            'desc' => $request->desc,
            'adress' => $request->adress,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'max_persons' => $request->max_persons,
            'price_per_night' => $request->price_per_night,
            'service_id' => $request->service_id,
        ]);
        
        return response()->json([
            'status' => true,
            'message' => 'Rental has been updates successfully',
            'updatedrental' => $updatedrental
        ] ,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $deletedrental = Rental::findOrfail($request->id);
        $deletedrental->delete();

        return response()->json([
            'status' => true,
            'message' => 'Rental deleted successfully'
        ]);
    }
}
