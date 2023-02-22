<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionHistory extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    use HasFactory;
    protected $fillable = [
        'history_id', //history is auction id + item id + ddmmyyy
        'auction_id',
        'item_id',
        'user_id',
        'report_date',
        'sold_price'
    ];
}
