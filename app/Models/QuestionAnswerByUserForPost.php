<?php

namespace App\Models;

use App\Models\Posts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswerByUserForPost extends Model
{
    use HasFactory;
    protected $fillable = ['post_id', 'question', 'answer'];

    public function post()
    {
        return $this->belongsTo(Posts::class, 'post_id'); // Specify the foreign key explicitly if necessary
    }
}
