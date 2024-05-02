<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        "amount",
        "coin_short_name",
        "date",
        "explorer_url",
        "id",
        "processing_fees",
        "to_address",
        "total_amount",
        "transaction_fees",
        "txid",
        "wallet_id",
        "wallet_name",
        "user_id"
    ];
}
