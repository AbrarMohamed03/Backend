<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type_rental;
use Illuminate\Http\Request;

class Type_rentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type_rentals = Type_rental::all();

        return response()->json([
            'status' => true,
            'Type_rentals' => $type_rentals
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
        if ($request->has('photo')) {
            $photo = $request->file('photo');
            $photopath = 'TypeRental-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/TypeRental', $photopath);

            $type_rental = Type_rental::create([
                'name' => $request->name,
                'photo' => $photopath,
            ]);
        } else {
            $type_rental = Type_rental::create([
                'name' => $request->name,
                'photo' => '',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Type_rental has been created successfully',
            'Type_rentals' => $type_rental
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $type_rental = Type_rental::find($request->id);

        return response()->json([
            'status' => true,
            'Type_rental' => $type_rental
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type_rental $type_rental)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $updateType_rental = Type_rental::findOrfail($request->id);

        if ($request->has('photo')) {
            $photo = $request->file('photo');
            $photopath = 'TypeRental-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/TypeRental', $photopath);

            $updateType_rental->update([
                'name' => $request->name,
                'photo' => $photopath,
            ]);
        } else {
            $updateType_rental->update([
                'name' => $request->name,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'activitie has been update successfully',
            'updateType_rental' => $updateType_rental
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $deletedType_rental = Type_rental::findOrfail($request->id);
        $deletedType_rental->delete();

        return response()->json([
            'status' => true,
            'message' => 'Type_rental deleted successfully'
        ]);
    }
}
