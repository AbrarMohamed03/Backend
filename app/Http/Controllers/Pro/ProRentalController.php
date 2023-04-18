<?php

namespace App\Http\Controllers\Pro;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\Service;
use Illuminate\Http\Request;

class ProRentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $rental = Rental::select('r.*')
            ->from('rentals as r')
            ->join('services as s', 'r.service_id', '=', 's.id')
            ->where('s.pro_id', $id)
            ->get();

        return response()->json([
            'status' => true,
            'activitie' => $rental,
        ], 200);
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
        $service = Service::create([
            'pro_id'=>$request->pro_id
        ]);

        $NewserviceId = $service->id;

        $rental = Rental::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'adress' => $request->adress,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'max_persons' => $request->max_persons,
            'price_per_night' => $request->price_per_night,
            'type_id' => $request->type_id,
            'city_id' => $request->city_id,
            'service_id' => $NewserviceId,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'rental has been created successfully',
            'rental' => $rental,
            'service' => $service,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $rental = Rental::find($request->id);

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
        // return $request;
        $updatedrental = Rental::find($request->id);

        $updatedrental->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'adress' => $request->adress,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'max_persons' => $request->max_persons,
            'price_per_night' => $request->price_per_night,
            'type_id' => $request->type_id,
            'city_id' => $request->city_id,
            'service_id' => $request->service_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Rental has been updates successfully',
            'updatedrental' => $updatedrental
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $deletedrental = Rental::find($request->id);
        $deletedrental->delete();

        return response()->json([
            'status' => true,
            'message' => 'Rental deleted successfully'
        ]);
    }
}
