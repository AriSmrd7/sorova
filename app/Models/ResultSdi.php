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
}