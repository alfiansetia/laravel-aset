<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AsetResource;
use App\Models\Aset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Aset::with(['jenis', 'location', 'category'])->get();
        return $this->response('', AsetResource::collection($data), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'image'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'name'          => 'required',
                'jenis'         => 'required|exists:jenis,id',
                'kategori'      => 'required|exists:categories,id',
                'nilai'         => 'required|integer|gte:0',
                'lokasi'        => 'required|exists:locations,id',
                'kondisi'       => 'required|in:baik,rusak',
                'tgl_terima'    => 'required|date_format:Y-m-d|before_or_equal:today',
                'batas'         => 'required|integer|gte:0',
                'status'        => 'required|in:terpakai,tidak terpakai',
                'jumlah'        => 'required|integer|gt:0',
            ]
        );
        $count = Aset::latest('id')->first();
        $code = 'AST' . str_pad(($count->id ?? 0) + 1, 4, "0", STR_PAD_LEFT);
        $img = null;
        if ($files = $request->file('image')) {
            $destinationPath = public_path('assets/img/aset/');
            if (!file_exists($destinationPath)) {
                File::makeDirectory($destinationPath, 755, true);
            }
            $img = 'aset_' . date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $img);
        }
        $aset = Aset::create([
            'image'         => $img,
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
            'jumlah'        => $request->jumlah,
        ]);
        return $this->response('Sukses Tambah Data!', new AsetResource($aset), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Aset $aset)
    {
        return $this->response('', new AsetResource($aset->load(['jenis', 'location', 'category'])), 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aset $aset)
    {
        $this->validate(
            $request,
            [
                'image'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'name'          => 'required',
                'jenis'         => 'required|exists:jenis,id',
                'kategori'      => 'required|exists:categories,id',
                'nilai'         => 'required|integer|gte:0',
                'lokasi'        => 'required|exists:locations,id',
                'kondisi'       => 'required|in:baik,rusak',
                'tgl_terima'    => 'required|date_format:Y-m-d|before_or_equal:today',
                'batas'         => 'required|integer|gte:0',
                'status'        => 'required|in:terpakai,tidak terpakai',
                'jumlah'        => 'required|integer|gt:0',
            ]
        );
        $img = $aset->getRawOriginal('image');
        if ($files = $request->file('image')) {
            $destinationPath = public_path('assets/img/aset/');
            if (!empty($img) && file_exists($destinationPath . $img)) {
                File::delete($destinationPath . $img);
            }
            if (!file_exists($destinationPath)) {
                File::makeDirectory($destinationPath, 755, true);
            }
            $img = 'aset_' . date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $img);
        }
        $aset->update([
            'image'         => $img,
            'name'          => $request->name,
            'jenis_id'      => $request->jenis,
            'category_id'   => $request->kategori,
            'nilai'         => $request->nilai,
            'location_id'   => $request->lokasi,
            'kondisi'       => $request->kondisi,
            'tgl_terima'    => $request->tgl_terima,
            'batas'         => $request->batas,
            'status'        => $request->status,
            'jumlah'        => $request->jumlah,
        ]);
        return $this->response('Sukses Ubah Data!', new AsetResource($aset), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aset $aset)
    {
        $aset->delete();
        return $this->response('Sukses Hapus Data!', new AsetResource($aset), 200);
    }
}
