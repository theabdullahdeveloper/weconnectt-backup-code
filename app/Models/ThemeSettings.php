<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeSettings extends Model
{
    protected $fillable = [
        'favicon',  
        'logo', 
        'facebook_link',    
        'twitter_link',  
        'linkedin_link', 
        'header_Links', 
        'footer_copyright',
        'c_email',         // Ensure c_email is fillable
        'c_no',            // Ensure c_no is fillable
        'id'               // Ensure id is also fillable if you want to set it manually
    ];
    use HasFactory;
}
