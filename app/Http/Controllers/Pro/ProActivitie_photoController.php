<?php

namespace App\Http\Controllers\Pro;

use App\Http\Controllers\Controller;
use App\Models\Activitie_photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProActivitie_photoController extends Controller
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
            $photos = $request->file('photo');

            if (empty($photos)) {
                return response()->json([
                    'status' => false,
                    'error1' => 'No photos found',
                ], 400);
            }

            foreach ($photos as $photo) {
                $photopath = 'Activi-' . uniqid() . '.' . $photo->getClientOriginalExtension();
                $photo->storeAs('public/ActivitiePhotos', $photopath);
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
    public function show(Request $request, $ids)
    {
        $idsArray = explode(',', $ids);
        $photos = [];

        foreach ($idsArray as $id) {
            $photo = Activitie_photo::find($id);

            if ($photo) {
                $path = $photo->photo;

                // check if photo exists in storage
                if (Storage::disk('public')->exists('ActivitiePhotos/' . $path)) {
                    $url = Storage::url('ActivitiePhotos/' . $path);

                    $photos[] = [
                        'id' => $photo->id,
                        'path in DB' => $path,
                        'storage url' => $url,
                    ];
                }
            }
        }

        if (empty($photos)) {
            return response()->json([
                'status' => false,
                'message' => 'Photos not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'photos' => $photos,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activitie_photo $Activitie_photo)
    {
        //
    }
    /**
     * deletes any photos that do not have a matching path in the database
     */
    public function deleteUnusedPhotos()
    {
        $photos = Activitie_photo::all();

        foreach ($photos as $photo) {
            $path = $photo->photo;

            // check if photo exists in storage
            if (Storage::disk('public')->exists('ActivitiePhotos/' . $path)) {
                continue;
            }

            // delete photo from database if it does not exist in storage
            $photo->delete();
        }
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
        $numberofphotos = 0;
        try {
            // associate each new photo with its corresponding photo ID using an array
            $newPhotos = [];
            foreach ($idsArray as $index => $id) {
                $updatedphoto = Activitie_photo::find($id); //find photo
                $deletedpath = $updatedphoto->path;

                // check if a new photo was provided for this photo ID
                if (isset($files[$index])) {
                    $file = $files[$index];
                    $photopath = 'Activi-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    Storage::disk('public')->put('ActivitiePhotos/' . $photopath, file_get_contents($file));
                    $newPhotos[$id] = $photopath;
                } else {
                    $newPhotos[$id] = null;
                }
            }

            // loop through the new photos array and update each photo with its corresponding new photo
            foreach ($newPhotos as $id => $photopath) {
                if ($photopath) {
                    $updatedphoto = Activitie_photo::find($id);
                    $updatedphoto->update([
                        'photo' => $photopath,
                    ]);
                    $numberofphotos++;
                }
            }
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'error2' => $e->getMessage(),
            ], 500);
        }

        // delete old photos from storage
        $this->deleteUnusedPhotos();

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

