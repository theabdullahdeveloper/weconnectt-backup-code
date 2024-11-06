<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transitions extends Model
{
    protected $fillable = [
        'LoginedUserEmail',  
        'name',  
        'phone_number',     
        'email',     
        'postcode',     
        'credits',     
        'phone_number',     
    ];
    use HasFactory;
}
