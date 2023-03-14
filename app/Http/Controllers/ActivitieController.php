<?php

namespace App\Http\Controllers;

use App\Models\Activitie;
use Illuminate\Http\Request;

class ActivitieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = Activitie::all();

        return response()->json([
            'status' => true,
            'Activities' => $activities
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
        $activitie = Activitie::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'location' => $request->location,
            'duration' => $request->duration,
            'duration_type' => $request->duration_type,
            'price_per_person' => $request->price_per_person,
            'service_id' => $request->service_id,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'activitie has been created successfully',
            'admins' => $activitie
        ] ,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Activitie $activitie)
    {
        $activities = Activitie::findOrfail($activitie->id);
        
        return response()->json([
            'status' => true,
            'Activities' => $activities
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activitie $activitie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activitie $activitie)
    {
        $updateactivitie = Activitie::findOrfail($activitie->id);

        $updateactivitie->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'location' => $request->location,
            'duration' => $request->duration,
            'duration_type' => $request->duration_type,
            'price_per_person' => $request->price_per_person,
            'service_id' => $request->service_id,
        ]);
        
        return response()->json([
            'status' => true,
            'message' => 'activitie has been update successfully',
            'updateactivitie' => $updateactivitie
        ] ,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activitie $activitie)
    {
        $deletedactivitie = Activitie::findOrfail($activitie->id);
        $deletedactivitie->delete();

        return response()->json([
            'status' => true,
            'message' => 'admin with the ID : '.$activitie->id .' has been deleted successfully'
        ]);
    }
}
