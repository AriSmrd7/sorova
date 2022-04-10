<?php

namespace App\Http\Controllers;

use App\Models\DataSdi;
use Illuminate\Http\Request;

class RiwayatController extends Controller
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
        $dataSta = DataSdi::paginate(25);

        return view('riwayat',compact('dataSta'))->with('i', (request()->input('page', 1) - 1) * 25);;
    }
}
