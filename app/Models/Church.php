<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Church extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "churches";

    protected $fillable = [
        'name',
        'head_pastor',
        'phone_number',
        'location',
        'address',
        'email',
        'mission_statement',
        'logo',
    ];
}
