<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = 
    [
        'inscription_number',
        'type',
        'nickname',
        'card_number'
    ];

    protected $casts = 
    [
        'inscription_number'    => 'string',
        'type'                  => 'string',
        'nickname'              => 'string',
        'card_number'           => 'integer',
    ];
}
