<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataSdi;
use App\Models\DetailSta;
use App\Models\Stationing;
use App\Models\TempForLuas;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SdiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $_Stationing;
    private $_detailSta;
    private $_dataSdi;
    private $_tempForLuas;
    

    public function __construct()
    {
        $this->middleware('auth');

        $this->_Stationing = new Stationing();
        $this->_detailSta = new DetailSta();
        $this->_dataSdi = new DataSdi();
        $this->_tempForLuas = new TempForLuas();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Str::orderedUuid();

        return view('data-sdi',compact('id'));
    }

    public function saveData(Request $request){

        $request->validate([
            'ruas' => 'required',
            'sta_awal' => 'required',
            'sta_akhir' => 'required',
            'lebar' => 'required',
            'lajur' => 'required|in:1,2,3,4',
            'jalur' => 'required|in:1,2,3',
            'arah' => 'required|in:1,2',
            'tipe' => 'required|in:Lentur,Kaku',
            'foto_map' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
            'ruas.required' => 'Kolom ruas jalan tidak boleh dikosongkan',
            'sta_awal.required' => 'Kolom STA awal tidak boleh dikosongkan',
            'sta_akhir.required' => 'Kolom STA akhir tidak boleh dikosongkan',
            'lebar.required' => 'kolom lebar tidak boleh dikosongkan',
            'lajur.required' => 'Jumlah lajur belum dipilih',
            'jalur.required' => 'Jumlah jalur belum dipilih',
            'arah.required' => 'Jumlah arah belum dipilih',
            'tipe.required' => 'Tipe perkerasan belum dipilih',
            'foto_map.required' => 'Gambar belum diunggah dengan benar',
        ]
        );

        $id_data =  $request->id_data;

        $imageName = time().'.'.$request->foto_map->extension();  
        $request->foto_map->move(public_path('fotomaps'), $imageName);

        $this->_dataSdi->id = $id_data;
        $this->_dataSdi->ruas_jalan = $request->ruas;
        $this->_dataSdi->sta_awal =  $request->sta_awal.'+'. $request->sta_awal2;
        $this->_dataSdi->sta_akhir =  $request->sta_akhir.'+'. $request->sta_akhir2;
        $this->_dataSdi->lebar =  $request->lebar;
        $this->_dataSdi->jumlah_lajur = $request->lajur;
        $this->_dataSdi->jumlah_jalur =  $request->jalur;
        $this->_dataSdi->jumlah_arah = $request->arah;
        $this->_dataSdi->tipe_perkerasan = $request->tipe;
        $this->_dataSdi->foto_map = $imageName;
        $this->_dataSdi->id_user = Auth::user()->id;
        $this->_dataSdi->save();

        $data_sAwal = $request->sta_awal.$request->sta_awal2;
        $data_sAkhir = $request->sta_akhir.$request->sta_akhir2;
        $rangeSta = range($data_sAwal,$data_sAkhir,100);
        for ($i = 0; $i < count($rangeSta); $i++) {
            $datas[] = [
                'id_data'=>$id_data, 
                'nama_sta'=>$rangeSta[$i],	
            ];
        }
        Stationing::insert($datas);


        return redirect()->route('data-sdi.hitung',$id_data);

    }

    public function hitungSdi($id){

        $check = Stationing::checkLastRows($id);
        if ($check < 1){
           return redirect()->route('riwayat');
        }
        else{
                
            $sta = DataSdi::where('id',$id)->first();

            $dataSta = DB::table('tb_stationing')
                        ->select('*')
                        ->whereNotExists(function ($query) {
                            $query->from('tb_detail_stationing')
                                ->select('*')
                                ->where('tb_stationing.nama_sta','=',DB::raw('tb_detail_stationing.id_sta'))
                                ->where('tb_stationing.id_data','=',DB::raw('tb_detail_stationing.id_data'));
                        })
                        ->where('tb_stationing.id_data','=',$id)
                        ->get();

            return view('hitung-sdi',compact('sta','dataSta'));
        }
    }

    public function saveStationing(Request $request)
    {
        if($request->ajax())
        {
            $rules = array(
                'id_data_detail'  => 'required',
                'stationing'  => 'required',
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

            $id_sta = $request->stationing;
            $id_data_detail = $request->id_data_detail;
            $panjang = $request->panjang;
            $lebar = $request->lebar;
            $jumlah_lubang = $request->jumlah_lubang;
            $bekas_roda = $request->bekas_roda;
            $lebar_retak = $request->lebar_retak;

            foreach($panjang as $key => $value) 
            {
                $data = array(
                    'id_data' => $id_data_detail,
                    'id_sta' => $id_sta,
                    'panjang' => $panjang[$key],
                    'lebar' => $lebar[$key],
                    'jumlah_lubang' => $jumlah_lubang[$key],
                    'bekas_roda' => $bekas_roda[$key],
                    'lebar_retak' => $lebar_retak[$key],
                );

                $insert_data[] = $data; 
            }
            DetailSta::insert($insert_data);

            return response()->json([
                                'success'  => 'Data Added successfully.'
                            ]);
        }
    }
}
