<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userwallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wallet-type',
        'wallet_address',
        'coin_id',
        'wallet_id',
 
    
    ];
}
