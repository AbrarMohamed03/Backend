<?php

namespace App\Http\Controllers\Pro;

use App\Http\Controllers\Controller;
use App\Models\Activitie;
use Illuminate\Http\Request;
use App\Models\Service;


class ProActivitieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $activitie = Activitie::select('a.*')
            ->from('activities as a')
            ->join('services as s', 'a.service_id', '=', 's.id')
            ->where('s.pro_id', $id)
            ->get();

        return response()->json([
            'status' => true,
            'activitie' => $activitie,
        ], 200);
    }
    // select Activitie* 
    // from Activitie a, Service s
    // where a.Service_id = s.id
    // and s.pro_id = id

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
        // return $request;
        $service = Service::create([
            'pro_id' => $request->pro_id
        ]);

        $NewserviceId = $service->id;

        $activitie = Activitie::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'location' => $request->location,
            'duration' => $request->duration,
            'duration_type' => $request->duration_type,
            'price_per_person' => $request->price_per_person,
            'type_id' => $request->type_id,
            'city_id' => $request->city_id,
            'service_id' => $NewserviceId,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'activitie has been created successfully',
            'Activitie' => $activitie,
            'service' => $service
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $activities = Activitie::findOrfail($request->id);

        return response()->json([
            'status' => true,
            'Activities' => $activities
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activitie $activitie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $updateactivitie = Activitie::findOrfail($request->id);

        $updateactivitie->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'location' => $request->location,
            'duration' => $request->duration,
            'duration_type' => $request->duration_type,
            'price_per_person' => $request->price_per_person,
            'type_id' => $request->type_id,
            'city_id' => $request->city_id,
            'service_id' => $request->service_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'activitie has been update successfully',
            'updateactivitie' => $updateactivitie
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $deletedactivitie = Activitie::findOrfail($request->id);
        $deletedactivitie->delete();

        $idser = $deletedactivitie->service_id;

        $deletedservice = Service::where('id', $idser);
        $deletedservice->delete();

        return response()->json([
            'status' => true,
            'message' => 'activitie deleted successfully'
        ]);
    }
}
