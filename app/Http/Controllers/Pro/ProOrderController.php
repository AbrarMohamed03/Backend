<?php

namespace App\Http\Controllers\Pro;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ProOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        // $activitie = Activitie::select('a.*')
        // ->from('activities as a')
        // ->join('services as s', 'a.service_id', '=', 's.id')
        // ->where('s.pro_id', $id)
        // ->get();
        $orders = Order::select('o.*')
        ->from('orders as o')
        ->join('services as s', 'o.service_id', '=', 's.id')
        ->where('s.pro_id', $id)
        ->get();

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $activities = Order::findOrfail($request->id);

        return response()->json([
            'status' => true,
            'Activities' => $activities
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
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
}

