<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
