<?php

namespace App\Http\Controllers;

use App\Models\Tourist;
use Illuminate\Http\Request;

class TouristController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tourist = Tourist::all();

        return response()->json([
            'status' => true,
            'Admins' => $tourist
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
        $tourist = Tourist::create([
            'username' => $request->username,
            'password' => $request->password,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'tourist(s) has been created successfully',
            'tourist' => $tourist
        ] ,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tourist $tourist)
    {
        $tourist = Tourist::findOrfail($tourist->id);
        
        return response()->json([
            'status' => true,
            'tourist' => $tourist
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tourist $tourist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tourist $tourist)
    {
        $updatetourist = Tourist::findOrfail($tourist->id);

        $updatetourist->update([
            'username' => $request->username,
            'password' => $request->password,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
        ]);
        
        return response()->json([
            'status' => true,
            'message' => 'tourist has been updates successfully',
            'updatetourist' => $updatetourist
        ] ,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tourist $tourist)
    {
        $deletedtourist = Tourist::findOrfail($tourist->id);
        $deletedtourist->delete();

        return response()->json([
            'status' => true,
            'message' => 'tourist has been deleted successfully'
        ]);
    }
}
