<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $review = Review::all();

        return response()->json([
            'status' => true,
            'reviews' => $review
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
        $review = Review::create([
            'rate' => $request->rate,
            'emcommentail' => $request->comment,
            'service_id' => $request->service_id,
            'tourist_id' => $request->tourist_id,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'review has been created successfully',
            'reviews' => $review
        ] ,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        $review = Review::findOrfail($review->id);
        
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
    public function update(Request $request, Review $review)
    {
        $updatedreview = Review::findOrfail($review->id);

        $updatedreview->update([
            'rate' => $request->rate,
            'emcommentail' => $request->comment,
            'service_id' => $request->service_id,
            'tourist_id' => $request->tourist_id,
        ]);
        
        return response()->json([
            'status' => true,
            'message' => 'review has been updates successfully',
            'updatedreview' => $updatedreview
        ] ,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $deletedreview = Review::findOrfail($review->id);
        $deletedreview->delete();

        return response()->json([
            'status' => true,
            'message' => 'review has been deleted successfully'
        ]);
    }
}
