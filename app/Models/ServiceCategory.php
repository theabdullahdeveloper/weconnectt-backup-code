<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_category',
        'service_category_image',
        'service_category_status',
        'available_online',
        'view_swipper',
        'view_icon_line',
        'icon_color',
        'icon_class',
    ];
}
