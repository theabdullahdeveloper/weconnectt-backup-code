<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuestionAnswerByUserForPost;
class Posts extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_sub_category','permanently_disabled', 'service_sub_category_parent', 'credits',
        'post_time', 'postcode', 'email', 'city',
    ];

    public function questionAnswers()
    {
        return $this->hasMany(QuestionAnswerByUserForPost::class, 'post_id'); // Explicitly define the foreign key
    }



    
}
