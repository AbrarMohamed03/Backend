<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $service = Service::paginate(10);

        return response()->json([
            'status' => true,
            'posts' => $service
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
        $service = Service::create([
            'pro_id' => $request->pro_id
        ]);
        return response()->json([
            'status' => true,
            'message' => 'service has been created successfully',
            'posts' => $service
        ] ,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
    }
}
