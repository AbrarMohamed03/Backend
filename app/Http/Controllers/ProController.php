<?php

namespace App\Http\Controllers;

use App\Models\Pro;
use Illuminate\Http\Request;

class ProController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pros = Pro::all();

        return response()->json([
            'status' => true,
            'posts' => $pros
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
        $pros = Pro::create([
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
            'CIN' => $request->CIN,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'pro customer has been created successfully',
            'posts' => $pros
        ] ,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pro $pro)
    {
        $pro = Pro::findOrfail($pro->id);
        
        return response()->json([
            'status' => true,
            'pro User' => $pro
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pro $pro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pro $pro)
    {
        $updatepro = Pro::findOrfail($pro->id);

        $updatepro->update([
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
            'CIN' => $request->CIN,
        ]);
        
        return response()->json([
            'status' => true,
            'message' => 'pro has been updates successfully',
            'pro' => $updatepro
        ] ,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pro $pro)
    {
        $deletedpro = Pro::findOrfail($pro->id);
        $deletedpro->delete();

        return response()->json([
            'status' => true,
            'message' => 'pro user with the ID : '.$pro->id .' has been deleted successfully'
        ]);
    }
}
