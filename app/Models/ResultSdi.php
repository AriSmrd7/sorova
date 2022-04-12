<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ResultSdi extends Model
{
    use HasFactory;
    protected $table = 'tb_result';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = [
                'id_sta',
                'id_data',	
                'nilai_sdi',	
                'kondisi_jalan'
            ];

    public static function checkKondisi($sdi){
        $kondisi = $sdi > 150 
                            ? 'RUSAK BERAT' 
                            : ( $sdi >= 100 && $sdi <= 150 
                                ? 'RUSAK RINGAN' 
                                : ( $sdi >= 50 && $sdi <= 100 
                                    ? 'SEDANG' 
                                    : 'BAIK'
                                ) 
                            );
        return $kondisi;
    }

    public static function createResult($nilai_sdi,$kondisi_jalan,$id_data,$id_sta)
    {
        $add = new ResultSdi();
        $add->id_sta = $id_sta;
        $add->id_data = $id_data;
        $add->nilai_sdi = $nilai_sdi;
        $add->kondisi_jalan = $kondisi_jalan;
        $add->save();

        return true;
    }

    public static function pieChartData($id){
        $dataPie = DB::table('tb_result')
                ->select('kondisi_jalan',DB::raw("ROUND((COUNT(kondisi_jalan)/(SELECT COUNT(*) FROM tb_result WHERE id_data='$id'))*100,0) AS persentase"))
                ->where('id_data','=',$id)
                ->groupBy('kondisi_jalan')
                ->get();

        return $dataPie;
    }

    public static function dataSta($id){
        $dataSta = DB::table('tb_stationing')
                ->select('tb_stationing.*',DB::raw('MAX(tb_detail_stationing.lebar_retak) as lebar'),DB::raw(' MAX(tb_detail_stationing.bekas_roda) as bekas '))
                ->leftJoin('tb_detail_stationing','tb_stationing.id_data', '=', 'tb_detail_stationing.id_data')
                ->groupBy('tb_stationing.nama_sta')
                ->where('tb_stationing.id_data','=',$id)
                ->get();
        return $dataSta;
    }

    public static function avgSta($id){
        $avgSta = DB::table('tb_stationing')
                ->selectRaw('AVG(sdi_final) as rata_rata')
                ->where('id_data','=',$id)
                ->first();
        return $avgSta;
    }

    public static function resultData($id){
        $resultData = DB::table('tb_stationing')
                    ->leftJoin('tb_result', function($join)
                        {
                            $join->on('tb_stationing.id_data', '=', 'tb_result.id_data');
                            $join->on('tb_stationing.nama_sta', '=', 'tb_result.id_sta');
                        })
                    ->groupBy('tb_stationing.id_sta')
                    ->having('tb_stationing.id_data','=',$id)
                    ->get();
        return $resultData;
    }

    public static function barChartData($id){
        $dataBar = DB::table('tb_result')
                ->select('id_sta','nilai_sdi')
                ->where('id_data','=',$id)
                ->orderBy('id_sta','ASC')
                ->get();

        return $dataBar;
    }

    public static function checkCase($data){
        $case = $data == 'RUSAK BERAT' 
                            ? 'REKONSTRUKSI/PENINGKATAN STRUKTUR' 
                            : ( $data == 'RUSAK RINGAN'
                                ? 'PEMELIHARAAN REHABILITASI' 
                                : ( $data == 'SEDANG' 
                                    ? 'PEMELIHARAAN RUTIN/BERKALA' 
                                    : 'PEMELIHARAAN RUTIN'
                                ) 
                            );
        return $case;
    }
}