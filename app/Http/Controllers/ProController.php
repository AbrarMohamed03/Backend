<?php

namespace App\Http\Controllers;

use App\Models\Pro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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

            $Newphotopath = 'Pro-' . random_int(10000, 100000) . '.' .  $request->photo->getClientOriginalExtension();
            Storage::disk('public')->put('Profils/' . $Newphotopath, file_get_contents($request->photo));
        }

        $pros = Pro::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
            'CIN' => $request->CIN,
            'photo' => $Newphotopath,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Pro User created successfully',
            'pros' => $pros
        ], 200);
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
    public function update(Request $request, $id)
    {
        $updatedpro = Pro::find($id);

        if ($request->has('photo')) {
            $Oldphotopath = $updatedpro->photo;
            $Newphotopath = 'Pro-' . random_int(10000, 100000) . '.' .  $request->photo->getClientOriginalExtension();
            Storage::disk('public')->put('Profils/' . $Newphotopath, file_get_contents($request->photo));
            Storage::disk('public')->delete('Profils/' . $Oldphotopath);
            $updatedpro->update([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password,
                'CIN' => $request->CIN,
                'photo' => $Newphotopath,
            ]);
        } else {
            $updatedpro->update([
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
            'updatedpro' => $updatedpro
        ], 200);
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
            'message' => 'pro user deleted successfully'
        ]);
    }
}
