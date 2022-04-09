<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DetailSta extends Model
{
    use HasFactory;

    protected $table = 'tb_detail_stationing';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = [
        'id_data',
        'id_sta',
        'panjang',
        'lebar',
        'jumlah_lubang',
        'bekas_roda',
        'lebar_retak'
    ];

    public static function bagiPanjang($panjang){
        $hasil = (int) $panjang / 100;
        return $hasil;
    }
    
    public static function bagiLebar($lebar){
        $hasil = (int) $lebar / 100;
        return $hasil;
    }

    public static function calcLuas($panjang,$lebar){
        $hasil = $panjang * $lebar;
        return $hasil;
    }

    public static function sumLuas(){
        $luas = TempForLuas::sum('luas_row');
        return $luas;
    }

    public static function persentaseLuasRetak($luasTotal){
        $persentase = round(($luasTotal / 530) * 100,5);
        return $persentase;
    }

    public static function jumlahLubang($id_data,$id_sta){
        $luas = DetailSta::where('id_sta',$id_sta)
                        ->where('id_data',$id_data)
                        ->sum('luas_row');
        return $luas;
    }
}
