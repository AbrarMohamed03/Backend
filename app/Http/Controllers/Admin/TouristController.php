<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tourist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class TouristController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tourists = Tourist::paginate(50);

        return response()->json([
            'status' => true,
            'Tourists' => $tourists
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
        $validated = $request->validate([
            'email' => ['required', 'string', 'max:255', 'unique:tourists,email'],
            'password' => ['required', 'min:8']
        ]);

        if ($request->has('photo')) {

            $photo = $request->file('photo');
            $photopath = 'Tourist-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/profile', $photopath);

            $tourist = Tourist::create([
                'email' => $request->email,
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'phoneNumber' => $request->phoneNumber,
                'password' => Hash::make($request->password),
                'photo' => $photopath,
            ]);
        } else {
            $tourist = Tourist::create([
                'email' => $request->email,
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'phoneNumber' => $request->phoneNumber,
                'password' => Hash::make($request->password),
                'photo' => '',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Tourist has been created successfully',
            'Tourists' => $tourist
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $tourist = Tourist::find($request->id);

        return response()->json([
            'status' => true,
            'Tourist' => $tourist
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
    public function update(Request $request)
    {
        $updateTourist = Tourist::findOrfail($request->id);

        if ($request->has('photo')) {
            $photo = $request->file('photo');
            $photopath = 'Tourist-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/profile', $photopath);

            $updateTourist->update([
                'email' => $request->email,
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'phoneNumber' => $request->phoneNumber,
                'password' => Hash::make($request->password),
                'photo' => $photopath,
            ]);
        } else {
            $updateTourist->update([
                'email' => $request->email,
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'phoneNumber' => $request->phoneNumber,
                'password' => Hash::make($request->password),
                'photo' => '',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Tourist has been update successfully',
            'updateTourist' => $updateTourist
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $deletedTourist = Tourist::findOrfail($request->id);
        $deletedTourist->delete();

        return response()->json([
            'status' => true,
            'message' => 'Tourist deleted successfully'
        ]);
    }
}

