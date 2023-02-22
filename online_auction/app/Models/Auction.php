<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    use HasFactory;

    protected $fillable = [
        'item_id',
        'auction_date',
        'starting_price',
        'status'
    ];
}
