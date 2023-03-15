<?php

namespace App\Http\Controllers;

use App\Models\Activitie_photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Activitie_photoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Activitie_photo::all();

        return response()->json([
            'status' => true,
            'photos' => $photos
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
        try {
            $activities_id = $request->activities_id;
            $numberofphotos = 0;

            foreach ($request->file('photo') as $file) {
                $photopath = 'Activi-'.random_int(10000, 100000) . '.' . $file->getClientOriginalExtension();

                Storage::disk('public')->put('ActivitiePhotos/' . $photopath, file_get_contents($file));

                Activitie_photo::create([
                    'photo' => $photopath,
                    'activities_id' => $activities_id,
                ]);
                $numberofphotos++;
            }

            return response()->json([
                'status' => true,
                'message' => $numberofphotos . ' photo(s) have been created successfully',
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'error2' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Activitie_photo $Activitie_photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activitie_photo $Activitie_photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $ids)
    {

        $files = $request->file('photo');
        if (!$files) {
            return response()->json([
                'status' => false,
                'message' => 'No photo(s) were provided',
            ], 422);
        }
        $idsArray = explode(',', $ids);
        foreach ($idsArray as $id) {
            $updatedphoto = Activitie_photo::find($id); //find photo
            $deletedpath = $updatedphoto->path;
            $numberofphotos = 0;
            try {
                //loop in the provide files
                foreach ($files as $file) {
                    $photopath = 'Activi-'.random_int(10000, 100000) . '.' . $file->getClientOriginalExtension();
                    Storage::disk('public')->put('ActivitiePhotos/' . $photopath, file_get_contents($file)); //save the new images to the storage 
                    //save the new path to the DB
                    $updatedphoto->Update([
                        'photo' => $photopath,
                    ]);
                    $numberofphotos++;
                };
            } catch (\Throwable $e) {
                return response()->json([
                    'status' => false,
                    'error2' => $e->getMessage(),
                ], 500);
            }
            Storage::disk('public')->delete('ActivitiePhotos/' . $deletedpath); //delete the photo from storage
        }
        return response()->json([
            'status' => true,
            'message' => $numberofphotos . ' photo(s) have been updated successfully',
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ids)
    {
        $idsArray = explode(',', $ids);
        $deletedCount = 0;

        foreach ($idsArray as $id) {
            $deletephoto = Activitie_photo::find($id);

            if (!$deletephoto) {
                continue;
            }

            $path = $deletephoto->path;
            $deletedphotopath = 'ActivitiePhotos/' . $path;

            if (Storage::disk('public')->exists($deletedphotopath)) {
                Storage::disk('public')->delete($deletedphotopath); //delete phot from local storage
                $deletephoto->delete(); //delete phot from the database
                $deletedCount++;
            }
        }

        if ($deletedCount > 0) {
            return response()->json([
                'status' => true,
                'message' => $deletedCount . ' photo(s) have been deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'The specified photo(s) do not exist in the database or the local storage',
            ], 404);
        }
    }
}
