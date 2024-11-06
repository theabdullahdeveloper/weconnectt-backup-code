<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedOn extends Model
{
    protected $fillable = [
        'logo',  
        'alt',     
    ];
    use HasFactory;
}
