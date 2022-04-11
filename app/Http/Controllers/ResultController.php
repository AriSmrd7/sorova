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

        $dataSta = DB::table('tb_stationing')
                        ->select('tb_stationing.*',DB::raw('MAX(tb_detail_stationing.lebar_retak) as lebar'),DB::raw(' MAX(tb_detail_stationing.bekas_roda) as bekas '))
                        ->leftJoin('tb_detail_stationing','tb_stationing.id_data', '=', 'tb_detail_stationing.id_data')
                        ->groupBy('tb_stationing.nama_sta')
                        ->where('tb_stationing.id_data','=',$id)
                        ->get();

        $avgSta = DB::table('tb_stationing')
                        ->selectRaw('AVG(sdi_final) as rata_rata')
                        ->where('id_data','=',$id)
                        ->first();
                        
        $resultData = DB::table('tb_stationing')
                            ->leftJoin('tb_result', function($join)
                                {
                                    $join->on('tb_stationing.id_data', '=', 'tb_result.id_data');
                                    $join->on('tb_stationing.nama_sta', '=', 'tb_result.id_sta');
                                })
                            ->groupBy('tb_stationing.id_sta')
                            ->having('tb_stationing.id_data','=',$id)
                          ->get();

        $dataPie = DB::table('tb_result')
                        ->select('kondisi_jalan',DB::raw("ROUND((COUNT(kondisi_jalan)/(SELECT COUNT(*) FROM tb_result WHERE id_data='$id'))*100,0) AS persentase"))
                        ->where('id_data','=',$id)
                        ->groupBy('kondisi_jalan')
                        ->get();

        return view('result',compact('dataPrimer','dataSta','resultData','dataPie','avgSta'))
        ->with('i');
    }
}
