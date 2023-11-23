<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $table = 'devices';

    protected $fillable = [
        'device_string',
        'contractor_id',
        'group_id',
        'product_id',
        'name',
        'state',
        'is_exit',
        'is_virtual',
        'publish_topic',
        'subscribe_topic',
        'email_week',
        'email_start_time',
        'email_end_time',
        'email_resent_time',
        'state_time',
        'truble_sending',
        'machine_week',
        'machine_start_time',
        'machine_end_time',
        'show_sum_time1',
        'show_sum_time2',
        'break_start_time1',
        'break_end_time1',
        'break_start_time2',
        'break_end_time2',
        'break_start_time3',
        'break_end_time3',
        'remark',
    ];

    public $timestamps = true;
}
