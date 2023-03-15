<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();

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
        $order = Order::create([
            'tourist_id' => $request->tourist_id,
            'service_id' => $request->service_id,
            'status_id' => $request->status_id
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
    public function show(Order $order)
    {
        $order = Order::findOrfail($order->id);
        
        return response()->json([
            'status' => true,
            'order' => $order
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $updateorder = Order::findOrfail($order->id);

        $updateorder->update([
            'tourist_id' => $request->tourist_id,
            'service_id' => $request->service_id,
            'status_id' => $request->status_id
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
    public function destroy(Order $order)
    {
        $deletedorder = Order::findOrfail($order->id);
        $deletedorder->delete();

        return response()->json([
            'status' => true,
            'message' => 'order with the ID : '.$order->id .' has been deleted successfully'
        ]);
    }
}
