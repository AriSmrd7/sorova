<?php

namespace App\Http\Controllers;

use App\Models\DataSdi;
use App\Models\DetailSta;
use App\Models\ResultSdi;
use App\Models\Stationing;
use App\Models\TempForLuas;
use Illuminate\Http\Request;

class TruncateTable extends Controller
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
        DataSdi::truncate();
        DetailSta::truncate();
        ResultSdi::truncate();
        Stationing::truncate();
        TempForLuas::truncate();

        return 'Data berhasil di hapus';
    }
}
