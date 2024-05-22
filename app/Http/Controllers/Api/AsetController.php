<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Aset::with(['jenis', 'location', 'category'])->get();
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
                'name'          => 'required',
                'jenis'         => 'required|exists:jenis,id',
                'kategori'      => 'required|exists:categories,id',
                'nilai'         => 'required|integer|gte:0',
                'lokasi'        => 'required|exists:locations,id',
                'kondisi'       => 'required|in:baik,rusak',
                'tgl_terima'    => 'required|date_format:Y-m-d',
                'batas'         => 'required|integer|gte:0',
                'status'        => 'required|in:terpakai,tidak terpakai',
            ]
        );
        $count = Aset::latest('id')->first();
        $code = 'AST' . str_pad(($count->id ?? 0) + 1, 4, "0", STR_PAD_LEFT);
        $aset = Aset::create([
            'code'          => $code,
            'name'          => $request->name,
            'jenis_id'      => $request->jenis,
            'category_id'   => $request->kategori,
            'nilai'         => $request->nilai,
            'location_id'   => $request->lokasi,
            'kondisi'       => $request->kondisi,
            'tgl_terima'    => $request->tgl_terima,
            'batas'         => $request->batas,
            'status'        => $request->status,
        ]);
        return $this->response('Sukses Tambah Data!', $aset, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Aset $aset)
    {
        return $this->response('', $aset->load(['jenis', 'location', 'category']), 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aset $aset)
    {
        $this->validate(
            $request,
            [
                'name'          => 'required',
                'jenis'         => 'required|exists:jenis,id',
                'kategori'      => 'required|exists:categories,id',
                'nilai'         => 'required|integer|gte:0',
                'lokasi'        => 'required|exists:locations,id',
                'kondisi'       => 'required|in:baik,rusak',
                'tgl_terima'    => 'required|date_format:Y-m-d',
                'batas'         => 'required|integer|gte:0',
                'status'        => 'required|in:terpakai,tidak terpakai',
            ]
        );
        $aset->update([
            'name'          => $request->name,
            'jenis_id'      => $request->jenis,
            'category_id'   => $request->kategori,
            'nilai'         => $request->nilai,
            'location_id'   => $request->lokasi,
            'kondisi'       => $request->kondisi,
            'tgl_terima'    => $request->tgl_terima,
            'batas'         => $request->batas,
            'status'        => $request->status,
        ]);
        return $this->response('Sukses Ubah Data!', $aset, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aset $aset)
    {
        $aset->delete();
        return $this->response('Sukses Hapus Data!', $aset, 200);
    }
}
