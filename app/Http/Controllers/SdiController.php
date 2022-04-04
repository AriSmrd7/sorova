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
            'id_sta' => 'required',
            'addmore.*.panjang' => 'required',
            'addmore.*.lebar' => 'required',
            'addmore.*.jumlah_lubang' => 'required',
            'addmore.*.bekas_roda' => 'required',
            'addmore.*.lebar_retak' => 'required'
        ]);
        foreach ($request->addmore as $key => $value) {
            var_dump($value);
            exit;
            $rows = new DetailSta();
            $rows->id_sta = $request->id_sta;
            $rows->panjang = $value['panjang'];
            $rows->lebar = $value['lebar'];
            $rows->jumlah_lubang = $value['jumlah_lubang'];
            $rows->bekas_roda = $value['bekas_roda'];
            $rows->lebar_retak = $value['lebar_retak'];
            $rows->save();
        }
     
        return back()->with('success', 'New subject has been added.');
    }
}
