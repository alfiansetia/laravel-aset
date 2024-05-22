<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Jenis;
use App\Models\Location;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $jenis = Jenis::all();
        $locations = Location::all();
        return view('pages.aset.index', compact(['categories', 'jenis', 'locations']));
    }
}
