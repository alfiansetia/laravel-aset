<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JenisResource;
use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Jenis::all();
        return $this->response('', JenisResource::collection($data), 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name'      => 'required|unique:categories,name',
            ]
        );
        $jenis = Jenis::create([
            'name'      => $request->name,
        ]);
        return $this->response('Sukses Tambah Data!', new JenisResource($jenis), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Jenis $jenis)
    {
        return $this->response('', new JenisResource($jenis), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jenis $jenis)
    {
        $this->validate(
            $request,
            [
                'name'  => 'required|unique:jenis,name,' . $jenis->id,
            ]
        );
        $jenis->update([
            'name'      => $request->name,
        ]);
        return $this->response('Sukses Ubah Data!', new JenisResource($jenis), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jenis $jenis)
    {
        $jenis->delete();
        return $this->response('Sukses Hapus Data!', new JenisResource($jenis), 200);
    }
}
