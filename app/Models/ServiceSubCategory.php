<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategoryQuestions;

class ServiceSubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_sub_category',
        'service_sub_category_parent',
        'service_sub_category_image',
        'service_sub_category_status',
        'sub_category_available_online',
        'sub_category_view_index_page',
        'sub_category_icon_class',
    ];

    public function questions()
    {
        return $this->hasMany(SubCategoryQuestions::class);
    }
}
