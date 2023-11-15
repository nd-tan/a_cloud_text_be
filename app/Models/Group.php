<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = 'groups';
    protected $fillable = [
        'id',
        'group_id',
        'contractor_id',
        'name',
        'path',
        'info_board',
        'latitude',
        'longitude',
        'group_week',
    ];

}
