<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategoryAnswers;

class SubCategoryQuestions extends Model
{

    protected $fillable = ['question'];

    public function answers()
{
    return $this->hasMany(SubCategoryAnswers::class, 'sub_category_question_id', 'id');
}

    use HasFactory;
}
