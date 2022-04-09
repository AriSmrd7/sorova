<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Stationing extends Model
{
    use HasFactory;

    protected $table = 'tb_stationing';
    protected $primaryKey = 'id_sta';
    protected $keyType = 'string';
    protected $fillable = [
                'id_sta',
                'id_data',	
                'nama_sta',	
                'sdi_1',
                'sdi_2',	
                'sdi_3',
                'sdi_4',
                'sdi_final',
                'total_luas',
                'jumlah_lubang',
                'persen_luas_retak'	
            ];

    public static function checkLastRows($id){
        $count = DB::table('tb_stationing')
                    ->select('*')
                    ->whereNotExists(function ($query) {
                        $query->from('tb_detail_stationing')
                            ->select('*')
                            ->where('tb_stationing.nama_sta','=',DB::raw('tb_detail_stationing.id_sta'))
                            ->where('tb_stationing.id_data','=',DB::raw('tb_detail_stationing.id_data'));
                    })
                    ->where('tb_stationing.id_data','=',$id)
                    ->get();
        return $count->count();
    }

    
    public static function updateStationing(
                                    $totalLuas, 
                                    $luasRetak, 
                                    $jumlahLubang,
                                    $sdi_1,
                                    $sdi_2,
                                    $sdi_3,
                                    $sdi_4,
                                    $sdi_final,
                                    $id_data,
                                    $id_sta
                                    ){
            $update = DB::table('tb_stationing')
                ->where('id_data', $id_data)
                ->where('nama_sta', $id_sta)
                ->update([
                'total_luas' => $totalLuas,
                'jumlah_lubang' => $jumlahLubang,
                'persen_luas_retak' => $luasRetak,
                'sdi_1' => $sdi_1,
                'sdi_2' => $sdi_2,
                'sdi_3' => $sdi_3,
                'sdi_4' => $sdi_4,
                'sdi_final' => $sdi_final
                ]);
    }

    public static function sdiCalc_1($persenLuasRetak){
        if($persenLuasRetak > 30)
        {
            $sdi_1 = 40;
        }
        elseif($persenLuasRetak >= 10 && $persenLuasRetak <= 30){
            $sdi_1 = 20;
        }
        elseif($persenLuasRetak > 0 && $persenLuasRetak < 10){
            $sdi_1 = 5;
        }
        else{
            $sdi_1 = 0;
        }
        return $sdi_1;
    }

    public static function sdiCalc_2($lebarRetak,$sdi_1){
        if($lebarRetak > 3){
            $sdi_2 = $sdi_1 * 2;
        }
        elseif($lebarRetak >= 1 && $lebarRetak <= 3){
            $sdi_2 = $sdi_1;
        }
        elseif($lebarRetak > 0 && $lebarRetak < 1){
            $sdi_2 = $sdi_1;
        }
        else{
            $sdi_2 = 0;
        }
        return $sdi_2;
    }

    public static function sdiCalc_3($jumlahLubang,$sdi_2){
        if($jumlahLubang > 50){
            $sdi_3 = $sdi_2 + 225;
        }
        elseif($jumlahLubang >= 10 && $jumlahLubang <= 50){
            $sdi_3 = $sdi_2 + 75;
        }
        elseif($jumlahLubang > 0 && $jumlahLubang < 10){
            $sdi_3 = $sdi_2 + 15;
        }
        else{
            $sdi_3 = 0;
        }
        return $sdi_3;
    }

    public static function sdiCalc_4($bekasRoda,$sdi_3){
        if($bekasRoda > 3){
            $sdi_4 = $sdi_3 + 20;
        }
        elseif($bekasRoda >= 1 && $bekasRoda <= 3){
            $x = 2;
            $sdi_4 = $sdi_3 + (5 * $x);
        }
        elseif($bekasRoda > 0 && $bekasRoda < 1){
            $x = 0.5;
            $sdi_4 = $sdi_3 + (5 * $x);
        }
        else{
            $sdi_4 = 0;
        }
        return $sdi_4;
    }
}
