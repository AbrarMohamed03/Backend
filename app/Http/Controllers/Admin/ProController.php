<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pros = Pro::paginate(50);

        return response()->json([
            'status' => true,
            'pros' => $pros
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
            'email' => ['required', 'string', 'max:255', 'unique:pros,email'],
            'password' => ['required', 'min:8']
        ]);

        if ($request->has('photo')) {

            $photo = $request->file('photo');
            $photopath = 'pro-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/profile', $photopath);

            $pro = Pro::create([
                'email' => $request->email,
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'phoneNumber' => $request->phoneNumber,
                'password' => Hash::make($request->password),
                'CIN' => $request->CIN,
                'photo' => $photopath,
            ]);
        } else {
            $pro = Pro::create([
                'email' => $request->email,
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'phoneNumber' => $request->phoneNumber,
                'password' => Hash::make($request->password),
                'CIN' => $request->CIN,
                'photo' => '',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'pro has been created successfully',
            'pros' => $pro
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $pro = Pro::find($request->id);

        return response()->json([
            'status' => true,
            'pro' => $pro
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
    public function update(Request $request)
    {
        $updatePro = Pro::findOrfail($request->id);

        if ($request->has('photo')) {
            $photo = $request->file('photo');
            $photopath = 'pro-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/profile', $photopath);

            $updatePro->update([
                'email' => $request->email,
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'phoneNumber' => $request->phoneNumber,
                'password' => Hash::make($request->password),
                'CIN' => $request->CIN,
                'photo' => $photopath,
            ]);
        } else {
            $updatePro->update([
                'email' => $request->email,
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'phoneNumber' => $request->phoneNumber,
                'password' => Hash::make($request->password),
                'CIN' => $request->CIN,
                'photo' => '',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'pro has been update successfully',
            'updatePro' => $updatePro
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $deletedPro = Pro::findOrfail($request->id);
        $deletedPro->delete();

        return response()->json([
            'status' => true,
            'message' => 'pro deleted successfully'
        ]);
    }
}
