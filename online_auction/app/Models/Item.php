<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Item extends Authenticatable
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'item_name',
        'company_name',
        'location',
        'input_date',
        'initial_price',
        'description'
    ];
}
