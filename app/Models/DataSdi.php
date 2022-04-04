<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSdi extends Model
{
    use HasFactory;

    protected $table = 'tb_data';
    protected $primaryKey = 'id_data';
    protected $keyType = 'string';
    protected $fillable = [
        'id_data',
        'ruas_jalan',
        'sta_awal',
        'sta_akhir',
        'lebar',
        'jumlah_lajur',
        'jumlah_jalur',
        'jumlah_arah',
    	'tipe_perkerasan',
        'foto_map'	
    ];
}
