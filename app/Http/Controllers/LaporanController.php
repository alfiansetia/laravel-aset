<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $data = Aset::with(['jenis', 'location', 'category'])->get();
        return view('pages.laporan.index', compact('data'));
    }
}
