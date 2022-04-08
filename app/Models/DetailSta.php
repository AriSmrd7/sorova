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
        if($update){
            return 'success';
        }
        else{
            return 'gagal';
        }
    }

    public static function sumLuas(){
        $luas = TempForLuas::sum('luas_row');
        return $luas;
    }
}
