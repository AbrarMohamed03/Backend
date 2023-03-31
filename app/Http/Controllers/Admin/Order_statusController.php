<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order_status;
use Illuminate\Http\Request;

class Order_statusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order_status::all();

        return response()->json([
            'status' => true,
            'Orders' => $orders
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
        $order = Order_status::create([
            'stats' => $request->stats,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'order has been created successfully',
            'Orders' => $order
        ] ,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $order = Order_status::findOrfail($request->id);
        
        return response()->json([
            'status' => true,
            'order' => $order
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $updateorder = Order_status::findOrfail($request->id);

        $updateorder->update([
            'stats' => $request->stats,
        ]);
        
        return response()->json([
            'status' => true,
            'message' => 'activitie has been update successfully',
            'updateorder' => $updateorder
        ] ,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $deletedorder = Order_status::findOrfail($request->id);
        $deletedorder->delete();

        return response()->json([
            'status' => true,
            'message' => 'order deleted successfully'
        ]);
    }
}
