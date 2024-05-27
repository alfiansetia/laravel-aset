<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function show(string $code)
    {
        $aset = Aset::query()->with(['jenis', 'location', 'category'])->where('code', $code)->first();
        if (!$aset) {
            return $this->response('Data Not Found!', null, 404);
        }
        return $this->response('', $aset);
    }
}
