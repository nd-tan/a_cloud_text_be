<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorPort extends Model
{
    use HasFactory;

    protected $table = 'sensor_ports';

    protected $fillable = [
        'alias_name',
        'port_no',
        'sensor_id',
        'plus_offset',
        'minus_offset',
        'device_id',
        'not_round',
        'show_digits',
    ];

    public $timestamps = true;
}
