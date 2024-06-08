<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $fillable = ['first_name', 'last_name', 'birth_date', 'tax_code', 'res_address', 'res_city', 'post_code', 'mobile_phone', 'area', 'image', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
