<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    use HasFactory;

    const THE_CONTRACT_HAS_NOT_EXPIRED_YET = 0;
    const DURING_THE_CONTRACT_PERIOD = 1;
    const END_OF_CONTRACT_TERM = 2;

    protected $table = 'contractors';

    protected $fillable = [
        'id',
        'name',
        'postal_code',
        'address',
        'phone_number',
        'person',
        'logo',
        'start_date',
        'end_date',
        'remark',
        'is_system',
        'state'
    ];
}
