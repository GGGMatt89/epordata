<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ['title', 'excerpt', 'body', 'preview_title', 'preview_subtitle', 'beginning', 'expiration', 'image_path'];
}
