<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
