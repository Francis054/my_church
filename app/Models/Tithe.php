<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tithe extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'tithes';

    protected $fillable = [
        'member_id',
        'amount_paid',
        'month',
    ];
}
