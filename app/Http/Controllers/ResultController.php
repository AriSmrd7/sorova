<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailSta;
use App\Models\DataSdi;
use App\Models\Stationing;

class ResultController extends Controller
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
    public function index($id)
    {
        $dataPrimer = DataSdi::where('id',$id)->first();

        $dataSta = Stationing::where('id_data',$id)->paginate(20);;
        $maxBR = DetailSta::where('id_data',$id)->max('bekas_roda');
        $maxLR = DetailSta::where('id_data',$id)->max('lebar_retak');
        return view('result',compact('dataPrimer','dataSta','maxBR','maxLR'))
        ->with('i', (request()->input('page', 1) - 1) * 20);
    }
}
