<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataSdi;
use App\Models\DetailSta;
use App\Models\Stationing;

class SdiController extends Controller
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
        return view('data-sdi');
    }

    public function hitungSdi(){
        return view('hitung-sdi');
    }

    public function saveStationing(Request $request){
        $request->validate([
            'panjang.*' => 'required',
            'lebar.*' => 'required',
            'lubang.*' => 'required',
            'bekas.*' => 'required',
            'retak.*' => 'required'
        ]);
        foreach ($request->panjang as $key => $value) {
            DetailSta::create($value);
        }
     
        return back()->with('success', 'New subject has been added.');
    }
}
