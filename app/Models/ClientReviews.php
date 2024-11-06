<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientReviews extends Model
{
    protected $fillable = [
        'feedbacker_name',  
        'feedbacker_email',     
        'feedback',     
        'rating',     
        'email',     
        'date',     
    ];
    use HasFactory;
}
