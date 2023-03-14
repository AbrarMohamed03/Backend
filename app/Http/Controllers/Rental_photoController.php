<?php

namespace App\Http\Controllers;

use App\Models\Rental_photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Rental_photoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Rental_photo::all();

        return response()->json([
            'status' => true,
            'paths' => $photos
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
        $rental_id = $request->rental_id;
        $numberofphotos = 0;
        
        foreach ($request->file('path') as $file) {
            $filename = random_int(99999, 999999999999999);
            $extension = $file->getClientOriginalExtension();
            $imagepath = $filename . '.' . $extension;

            Storage::disk('public')->put('RentalPhotos/' . $imagepath, file_get_contents($file));

            Rental_photo::create([
                'path' => $imagepath,
                'rental_id' => $rental_id,
            ]);
            $numberofphotos = $numberofphotos + 1;
        }

        return response()->json([
            'status' => true,
            'message' => $numberofphotos .' Photos have been created successfully',
        ], 200);
    }


    /**
     * Display the specified resource.
     */
    public function show(Rental_photo $rental_photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rental_photo $rental_photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rental_photo $rental_photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deletephoto = Rental_photo::find($id);

        if (!$deletephoto) {
            return response()->json([
                'message' => 'The photo with the specified ID does not exist in the database.',
            ], 404);
        } else {
            $path = $deletephoto->path;
            $deletedphotopath = 'RentalPhotos/' . $path;

            if (Storage::disk('public')->exists($deletedphotopath)) {

                Storage::disk('public')->delete($deletedphotopath); //delete phot from local storage
                $deletephoto->delete(); //delete phot from the database
            } else {
                return response()->json([
                    'message' => 'The image does not exist in the local storage',
                ]);
            }
            return response()->json([
                'status' => true,
                'message' => 'photo has been deleted successfully',
            ], 200);
        }
    }
}
