<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
  use HasFactory, SoftDeletes;

  public $table = "members";

  protected $fillable = [
    'first_name',
    'middle_name',
    'last_name',
    'phone_number',
    'home_town',
    'place_of_stay',
    'parent_status',
    'parent_name',
    'parent_number',
    'marriage_status',
    'spouse_name',
    'spouse_number',
    'number_of_children',
    'position',
    
  ];
}
