<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userlog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ip_address',
        'location',
        'last_access',
 
    
    ];
}
