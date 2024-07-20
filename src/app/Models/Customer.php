<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'title', 'bus_name', 'cus_code', 'tax_code', 'vat_num', 'univ_code', 'email', 'pec', 'office_phone', 'mobile_phone', 'address', 'city', 'post_code', 'region', 'rating', 'category', 'handler', 'ref_name', 'ref_surname', 'ref_title', 'ref_phone', 'ref_email', 'profile_id'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    // public function products()
    // {
    //     return $this->belongsToMany(Product::class)->withTimestamps()->withPivot('expiration', 'notes');
    // }

    public function lectures()
    {
        return $this->belongsToMany(Lecture::class)->withTimestamps();
    }
}
