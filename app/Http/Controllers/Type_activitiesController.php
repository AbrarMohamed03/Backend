<?php

namespace App\Http\Controllers;

use App\Models\Type_activities;
use Illuminate\Http\Request;

class Type_activitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Types = Type_activities::all();

        return response()->json([
            'status' => true,
            'Types' => $Types
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
        $Types = Type_activities::create([
            'name' => $request->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Type has been created successfully',
            'Types' => $Types
        ] ,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $Types = Type_activities::findOrfail($request->id);
        
        return response()->json([
            'status' => true,
            'Types' => $Types
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type_activities $type_activities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $updatedType = Type_activities::findOrfail($request->id);

        $updatedType->update([
            'name' => $request->name,

        ]);
        
        return response()->json([
            'status' => true,
            'message' => 'Type has been update successfully',
            'updateTypes' => $updatedType
        ] ,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $deletedType = Type_activities::findOrfail($request->id);
        $deletedType->delete();

        return response()->json([
            'status' => true,
            'message' => 'Type deleted successfully'
        ]);
    }
}
