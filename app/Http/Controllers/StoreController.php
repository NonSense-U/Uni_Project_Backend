<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use Illuminate\Http\Request;

class StoreController extends Controller
{

    public function searchByName(Request $request)
    {
        $validated = $request->validate([
            'storeName' => 'required|string|max:255',
        ]);

        $stores = Store::where('storeName', 'like', '%' . $validated['storeName'] . '%')->get();

        return response()->json($stores);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Store::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoreRequest $request)
    {
        $request->validate([
            'storeName' => ['required','string','max:255'],
            'rating' => ['nullable']
        ]);
        Store::create([
            'storeName' => $request->storeName,
            'rating' => $request->rating,
            'store_owner_id' => $request->user()->storeOwner->id
        ]);

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoreRequest $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        //
    }
}
