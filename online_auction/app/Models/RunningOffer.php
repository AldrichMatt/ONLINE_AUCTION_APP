<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RunningOffer extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'auction_id',
        'item_id',
        'user_id',
        'offer_date',
        'offer_price'
    ];
}
