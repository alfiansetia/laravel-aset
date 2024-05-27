<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['jumlah'] = Aset::query()->sum('jumlah');
        $data['nilai'] = Aset::query()->where('jumlah', '>', 0)->sum('nilai');
        $data['terpakai'] = Aset::query()->where('status', 'terpakai')->sum('jumlah');
        $data['tidak_terpakai'] = Aset::query()->where('status', 'tidak terpakai')->sum('jumlah');
        $data['baik'] = Aset::query()->where('kondisi', 'baik')->sum('jumlah');
        $data['rusak'] = Aset::query()->where('kondisi', 'rusak')->sum('jumlah');
        return view('home', compact('data'));
    }
}
