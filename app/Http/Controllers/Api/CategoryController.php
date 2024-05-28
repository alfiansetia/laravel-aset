<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::all();
        return $this->response('', CategoryResource::collection($data), 200);
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
        $category = Category::create([
            'name'      => $request->name,
        ]);
        return $this->response('Sukses Tambah Data!', $category, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $this->response('', new CategoryResource($category), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->validate(
            $request,
            [
                'name'  => 'required|unique:categories,name,' . $category->id,
            ]
        );
        $category->update([
            'name'      => $request->name,
        ]);
        return $this->response('Sukses Ubah Data!', new CategoryResource($category), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->response('Sukses Hapus Data!', new CategoryResource($category), 200);
    }
}
