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
        'user_id',
        'member_id',
        'amount_paid',
        
    ];
}
