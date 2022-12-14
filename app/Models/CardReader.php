<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CardReader extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = 
    [
        'mac_address',
        'nickname',
        'usage',
        'data'
    ];

    protected $casts = 
    [
        'mac_address'   => 'string',
        'nickname'      => 'string',
        'usage'         => 'integer',
        'data'          => 'string',
    ];
}
