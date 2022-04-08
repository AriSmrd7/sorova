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
}
