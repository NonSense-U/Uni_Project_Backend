<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreLocationRequest $request)
    {
        // Validation is already handled by StoreLocationRequest

        $user = FacadesAuth::user();

        if($user->location!==null)
        {
            return  response(['message'=>'already added a location!'],412,[]);
        }

        $location = Location::create([

            'user_id' => $user->id,
            'town' => $request->town,
            'street' => $request->street,
            'additional' => $request->additional,
        ]);

        return response()->json(['message' => 'Location created!', 'location' => $location]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        $user = FacadesAuth::user();
        return response()->json(['location' => $user->location]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        //
    }
}
