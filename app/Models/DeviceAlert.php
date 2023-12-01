<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceAlert extends Model
{
    use HasFactory;
    protected $table = 'device_alert';
    protected $fillable = [
        'name',
        'sensor_id',
        'sensor_port',
        'threshold_value',
        'duration',
        'logic',
        'threshold_condition',
        'judgment_interval_type',
        'email',
    ];
}
