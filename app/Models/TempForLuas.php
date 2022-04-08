<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempForLuas extends Model
{
    use HasFactory;

    protected $table = 'tb_temp_calc';
    protected $primaryKey = 'id';
    protected $fillable = [
        'luas_row',
    ];
}
