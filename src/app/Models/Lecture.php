<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $fillable = ['product_id', 'title', 'place', 'beginning', 'end', 'last', 'cfp', 'price', 'cr_body', 'provider', 'description'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class)->withTimestamps();
    }
}
