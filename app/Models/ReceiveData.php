<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiveData extends Model
{
    use HasFactory;

    protected $table = 'receive_data';

    protected $fillable = [
        'device_id',
        'device_name',
        'contractor_id',
        'group_id',
        'group_name',
        'tm',
        'd1_raw',
        'd2_raw',
        'd3_raw',
        'd4_raw',
        'd5_raw',
        'd6_raw',
        'd7_raw',
        'd8_raw',
        'd1_calc',
        'd2_calc',
        'd3_calc',
        'd4_calc',
        'd5_calc',
        'd6_calc',
        'd7_calc',
        'd8_calc',
        'a1_raw',
        'a2_raw',
        'a3_raw',
        'a4_raw',
        'a5_raw',
        'a6_raw',
        'a7_raw',
        'a8_raw',
        'a1_calc',
        'a2_calc',
        'a3_calc',
        'a4_calc',
        'a5_calc',
        'a6_calc',
        'a7_calc',
        'a8_calc',
        'adgp',
        'eitemp',
        'eihumi',
        'eilprs',
        'seaprs',
        'msg',
        'rping',
    ];

    public $timestamps = true;
}
