<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::all();

        return response()->json([
            'status' => true,
            'posts' => $admins
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
        $admins = Admin::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'admin has been created successfully',
            'posts' => $admins
        ] ,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        $admin = Admin::findOrfail($admin->id);
        
        return response()->json([
            'status' => true,
            'Admin' => $admin
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $updatedadmin = Admin::findOrfail($admin->id);

        $updatedadmin->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        
        return response()->json([
            'status' => true,
            'message' => 'admin has been updates successfully',
            'admin' => $updatedadmin
        ] ,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $deletedadmin = Admin::findOrfail($admin->id);
        $deletedadmin->delete();

        return response()->json([
            'status' => true,
            'message' => 'admin with the ID : '.$admin->id .' has been deleted successfully'
        ]);
    }
}
