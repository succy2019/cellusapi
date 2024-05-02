<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAuth extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'acct_pin',
        'facial_auth',
 
    
    ];
}
