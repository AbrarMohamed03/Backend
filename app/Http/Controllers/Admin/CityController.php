<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citys = city::all();

        return response()->json([
            'status' => true,
            'citys' => $citys
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
            $photopath = 'city-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/cities', $photopath);

            $city = city::create([
                'name' => $request->name,
                'photo' => $photopath,
            ]);
        } else {
            $city = city::create([
                'name' => $request->name,
                'photo' => '',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'city has been created successfully',
            'citys' => $city
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $city = city::find($request->id);

        return response()->json([
            'status' => true,
            'city' => $city
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(city $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $updatecity = city::findOrfail($request->id);

        if ($request->has('photo')) {
            $photo = $request->file('photo');
            $photopath = 'city-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/cities', $photopath);

            $updatecity->update([
                'name' => $request->name,
                'photo' => $photopath,
            ]);
        } else {
            $updatecity->update([
                'name' => $request->name,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'activitie has been update successfully',
            'updatecity' => $updatecity
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $deletedcity = city::findOrfail($request->id);
        $deletedcity->delete();

        return response()->json([
            'status' => true,
            'message' => 'city deleted successfully'
        ]);
    }
}
