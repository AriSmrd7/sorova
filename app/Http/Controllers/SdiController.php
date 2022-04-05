<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataSdi;
use App\Models\DetailSta;
use App\Models\Stationing;
use Illuminate\Support\Facades\Validator;

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

    public function saveStationing(Request $request)
    {
        if($request->ajax())
        {
            $rules = array(
                'id_sta'  => 'required',
                'panjang.*'  => 'required',
                'lebar.*'  => 'required',
                'jumlah_lubang.*'  => 'required',
                'bekas_roda.*'  => 'required',
                'lebar_retak.*'  => 'required'
            );
            $error = Validator::make($request->all(), $rules);
            
            if($error->fails())
            {
                return response()->json([
                    'error'  => $error->errors()->all()
                ]);
            }

            $id_sta = $request->id_sta;
            $panjang = $request->panjang;
            $lebar = $request->lebar;
            $jumlah_lubang = $request->jumlah_lubang;
            $bekas_roda = $request->bekas_roda;
            $lebar_retak = $request->lebar_retak;

            foreach($panjang as $key => $value) 
            {
                 $item = new DetailSta();
                 $item->id_sta = $id_sta[$key];
                 $item->panjang = $panjang[$key];
                 $item->lebar = $lebar[$key];
                 $item->jumlah_lubang = $jumlah_lubang[$key];
                 $item->bekas_roda = $bekas_roda[$key];
                 $item->lebar_retak = $lebar_retak[$key];
                 $item ->save();
            }
            return response()->json([
                                'success'  => 'Data Added successfully.'
                            ]);
        }
    }
}
