<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessRight extends Model
{
    use HasFactory;

    protected $fillable = [
        'contractor_id',
        'remark',
        'name',
        'access_rights',
        'dashboard',
        'data',
        'data_export',
        'device',
        'alert',
        'alert_mail',
        'sensor',
        'account',
        'groups',
        'test',
    ];
}
