<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Auction extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    use HasFactory;

    protected $fillable = [
        'item_id',
        'auction_date',
        'employee_id',
        'starting_price',
        'status'
    ];
}
