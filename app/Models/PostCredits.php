<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCredits extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_sub_category', 
        'service_sub_category_parent', 
        'credit_question', 
        'credit_answer', 
        'credits', 
       
    ];
}
