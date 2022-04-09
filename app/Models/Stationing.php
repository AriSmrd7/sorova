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
}
