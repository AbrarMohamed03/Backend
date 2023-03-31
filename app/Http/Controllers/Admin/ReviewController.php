<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $review = Review::paginate(10);

        return response()->json([
            'status' => true,
            'reviews' => $review
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
        $review = Review::create([
            'rate' => $request->rate,
            'comment' => $request->comment,
            'service_id' => $request->service_id,
            'tourist_id' => $request->tourist_id,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'review has been created successfully',
            'reviews' => $review
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $review = Review::findOrfail($request->id);

        return response()->json([
            'status' => true,
            'review' => $review
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $updatedreview = Review::findOrfail($request->id);

        $updatedreview->update([
            'rate' => $request->rate,
            'comment' => $request->comment,
            'service_id' => $request->service_id,
            'tourist_id' => $request->tourist_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'review has been updates successfully',
            'updatedreview' => $updatedreview
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $deletedreview = Review::findOrfail($request->id);
        $deletedreview->delete();

        return response()->json([
            'status' => true,
            'message' => 'review has been deleted successfully'
        ]);
    }
}
