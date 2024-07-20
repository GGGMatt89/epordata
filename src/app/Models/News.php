<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'excerpt', 'body', 'preview_title', 'preview_subtitle', 'date', 'image_path'];
}
