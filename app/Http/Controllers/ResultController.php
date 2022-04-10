<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailSta;
use App\Models\DataSdi;
use App\Models\Stationing;
use Illuminate\Support\Facades\DB;

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

        $dataSta = Stationing::where('id_data',$id)->paginate(25);;
        $maxBR = DetailSta::where('id_data',$id)->max('bekas_roda');
        $maxLR = DetailSta::where('id_data',$id)->max('lebar_retak');

        $resultData = DB::table('tb_stationing')
                            ->leftJoin('tb_result', function($join)
                                {
                                    $join->on('tb_stationing.id_data', '=', 'tb_result.id_data');
                                    $join->on('tb_stationing.nama_sta', '=', 'tb_result.id_sta');
                                })
                            ->groupBy('tb_stationing.id_sta')
                            ->having('tb_stationing.id_data','=',$id)
                          ->get();

        return view('result',compact('dataPrimer','dataSta','maxBR','maxLR','resultData'))
        ->with('i', (request()->input('page', 1) - 1) * 25);
    }
}
