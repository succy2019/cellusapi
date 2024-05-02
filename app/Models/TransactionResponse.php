<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionResponse extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'txid',
        'explorer_url',
        'merchant_id',
        'type',
        'coin_short_name',
        'wallet_id',
        'wallet_name',
        'address_label',
        'address',
        'amount',
        'confirmations',
        'date',
    ];
}
