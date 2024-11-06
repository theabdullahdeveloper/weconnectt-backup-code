<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCreditDetail extends Model
{
    protected $fillable = [
        'user_id',
        'payment_date',
        'payment_amount',
        'currency',
        'credits_purchased',
        
       
    ];
    use HasFactory;
}
