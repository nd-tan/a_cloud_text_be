<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConditionSensor extends Model
{
    use HasFactory;

    protected $table = 'condition_sensor';

    protected $fillable = [
        'condition_id',
        'sensor_port_id',
        'sensor_port_name',
        'threshould',
        'view_no',
        'condition',
    ];
}
