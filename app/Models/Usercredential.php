<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usercredential extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bvn',
        'nin',
        'address',
        'bvn_document',
        'nin_document',
        'proof_of_address',
        'acccount_level',
        'kyc_level',
 
    
    ];
}
