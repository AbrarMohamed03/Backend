<?php

namespace App\Http\Controllers;

use App\Models\Tourist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
        $Newphotopath = '';
        if ($request->has('photo')) {

            $Newphotopath = 'Tourist-' . random_int(10000, 100000) . '.' .  $request->photo->getClientOriginalExtension();
            Storage::disk('public')->put('Profils/' . $Newphotopath, file_get_contents($request->photo));
        }

        $tourist = Tourist::create([
            'password' => $request->password,
            'email' => $request->email,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'phoneNumber' => $request->phoneNumber,
            'photo' => $Newphotopath,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'tourist created successfully',
            'pros' => $tourist
        ], 200);
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
    public function update(Request $request, $id)
    {
        $updatedtourist = Tourist::find($id);

        if ($request->has('photo')) {
            $Oldphotopath = $updatedtourist->photo;
            $Newphotopath = 'Tourist-' . random_int(10000, 100000) . '.' .  $request->photo->getClientOriginalExtension();
            Storage::disk('public')->put('Profils/' . $Newphotopath, file_get_contents($request->photo));
            Storage::disk('public')->delete('Profils/' . $Oldphotopath);
            $updatedtourist->update([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password,
                'CIN' => $request->CIN,
                'photo' => $Newphotopath,
            ]);
        } else {
            $updatedtourist->update([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password,
                'CIN' => $request->CIN,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Pro user updated successfully',
            'updatedtourist' => $updatedtourist
        ], 200);
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
