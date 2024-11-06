<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategoryQuestions;

class SubCategoryAnswers extends Model
{


    protected $fillable = ['answer'];

    public function question()
    {
        return $this->belongsTo(SubCategoryQuestions::class, 'sub_category_question_id', 'id');
    }

    use HasFactory;


  
}
