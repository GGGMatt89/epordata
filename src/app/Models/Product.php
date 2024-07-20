<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'type', 'category', 'provider_id', 'provider_name'];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }

    // public function customers()
    // {
    //     return $this->belongsToMany(Customer::class)->withTimestamps();
    // }
}
