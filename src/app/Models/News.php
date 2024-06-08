<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'excerpt', 'body', 'preview_title', 'preview_subtitle', 'date', 'image_path'];
}
