<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Location::all();
        return $this->response('', $data, 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name'      => 'required|unique:locations,name',
            ]
        );
        $location = Location::create([
            'name'      => $request->name,
        ]);
        return $this->response('Sukses Tambah Data!', $location, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        return $this->response('', $location, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        $this->validate(
            $request,
            [
                'name'  => 'required|unique:categories,name,' . $location->id,
            ]
        );
        $location->update([
            'name'      => $request->name,
        ]);
        return $this->response('Sukses Ubah Data!', $location, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();
        return $this->response('Sukses Hapus Data!', $location, 200);
    }
}
