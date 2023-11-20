<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = 'groups';
    protected $fillable = [
        'group_id',
        'contractor_id',
        'name',
        'path',
        'info_board',
        'latitude',
        'longitude',
        'group_week',
        'group_start_time',
        'group_end_time',
        'break_start_time1',
        'break_end_time1',
        'break_start_time2',
        'break_end_time2',
        'break_start_time3',
        'break_end_time3',
        'remark',
        'updated_ID',
    ];
}