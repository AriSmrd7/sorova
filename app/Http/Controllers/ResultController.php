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
        $data = $id;
        return view('result',compact('data'));
    }
}
