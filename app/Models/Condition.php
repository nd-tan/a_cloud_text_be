<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    use HasFactory;

    protected $table = 'conditions';

    protected $fillable = [
        'name',
        'condition',
        'device_id'
    ];

    public $timestamps = true;

    public function conditionSensors() {
        return $this->hasMany('condition_sensor', 'condition_id', 'id');
    }
}
