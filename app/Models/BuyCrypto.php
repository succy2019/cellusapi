<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyCrypto extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "amount",
        "network",
        "status",
        "type",
        "to_pay"
    ];
}
