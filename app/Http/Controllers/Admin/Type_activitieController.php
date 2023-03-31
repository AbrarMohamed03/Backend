<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type_activitie;
use Illuminate\Http\Request;

class Type_activitieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type_activities = Type_activitie::all();

        return response()->json([
            'status' => true,
            'Type_activities' => $type_activities
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
            $photopath = 'TypeActivitie-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/TypeActivitie', $photopath);

            $type_activitie = Type_activitie::create([
                'name' => $request->name,
                'photo' => $photopath,
            ]);
        } else {
            $type_activitie = Type_activitie::create([
                'name' => $request->name,
                'photo' => '',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Type_activitie has been created successfully',
            'Type_activities' => $type_activitie
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $type_activitie = Type_activitie::find($request->id);

        return response()->json([
            'status' => true,
            'Type_activitie' => $type_activitie
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type_activitie $type_activitie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $updateType_activitie = Type_activitie::findOrfail($request->id);

        if ($request->has('photo')) {
            $photo = $request->file('photo');
            $photopath = 'TypeActivitie-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/TypeActivitie', $photopath);

            $updateType_activitie->update([
                'name' => $request->name,
                'photo' => $photopath,
            ]);
        } else {
            $updateType_activitie->update([
                'name' => $request->name,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'activitie has been update successfully',
            'updateType_activitie' => $updateType_activitie
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $deletedType_activitie = Type_activitie::findOrfail($request->id);
        $deletedType_activitie->delete();

        return response()->json([
            'status' => true,
            'message' => 'Type_activitie deleted successfully'
        ]);
    }
}
