<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailSta;
use App\Models\DataSdi;
use App\Models\ResultSdi;
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
        $dataSta = ResultSdi::dataSta($id);
        $avgSta = ResultSdi::avgSta($id);
        $resultData = ResultSdi::resultData($id);
        $dataPie = ResultSdi::pieChartData($id);                        

        $dataBar = ResultSdi::barChartData($id);
    
        return view('result',compact('dataPrimer','dataSta','resultData','dataPie','avgSta','dataBar'))
                    ->with('i');
    }
}
