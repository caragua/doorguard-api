<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendee extends Model
{
    use HasFactory, SoftDeletes;

    public static $codes = [
        'level' => 
        [
            10 => '參加者',
            11 => '參加者（一日）',
            12 => '參加者（二日）',
            20 => '贊助者',
            30 => '超級贊助者'
        ],
        'is_minor' =>
        [
            0 => '已成年',
            1 => '未成年'
        ]
    ];

    protected $fillable = 
    [
        'inscription_number',
        'level',
        'nickname',
        'is_minor',
        'card_number'
    ];
}
