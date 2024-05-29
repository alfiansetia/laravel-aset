<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AsetResource;
use App\Models\Aset;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $data = Aset::where('jumlah', '>', 0)->with(['jenis', 'location', 'category'])->get();
        return $this->response('', AsetResource::collection($data));
    }
}
