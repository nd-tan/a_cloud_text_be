<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;

    protected $table = 'alerts';

    protected $fillable = [
        'name',
        'status',
        'condition',
        'state',
        'device_id',
        'email_contents',
        'email_sending',
        'type',
        'priority',
    ];

    public $timestamps = true;
}
