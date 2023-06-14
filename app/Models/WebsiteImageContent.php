<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteImageContent extends Model
{
    protected $table = 'website_image_content';

    protected $fillable = [
        'image_name',
    ];
}
