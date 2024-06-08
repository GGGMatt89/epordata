<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $fillable = ['title', 'excerpt', 'body', 'preview_title', 'preview_subtitle', 'image_path'];
}
