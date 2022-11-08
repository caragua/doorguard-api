<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScanReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = 
    [
        'card_reader_id',
        'card_number',
        'description',
        'pending'
    ];
}
