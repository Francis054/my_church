<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DuesPayment extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "dues_payments";

    protected $fillable = [
        "user_id",
        "member_id",
        "dues_id",
        "amount_paid",
        "balance",
    ];
}
