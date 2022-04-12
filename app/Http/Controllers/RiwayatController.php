<?php

namespace App\Http\Controllers;

use App\Models\DataSdi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $idUser = Auth::user()->id;
        $dataSta = DataSdi::where('id_user',$idUser)->paginate(25);

        return view('riwayat',compact('dataSta'))->with('i', (request()->input('page', 1) - 1) * 25);
    }
}
