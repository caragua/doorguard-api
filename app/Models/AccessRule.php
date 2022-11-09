<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccessRule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = 
    [
        'site_id',
        'description',
        'check_attendee_type',
        'check_age',
        'single_pass'
    ];

    protected $casts = 
    [
        'site_id'               => 'integer',
        'description'           => 'string',
        'check_attendee_type'   => 'string',
        'check_age'             => 'integer',
        'single_pass'           => 'integer'
    ];
}
