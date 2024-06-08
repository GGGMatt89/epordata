<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = ['bus_name', 'code', 'tax_code', 'vat_num', 'univ_code', 'email', 'pec', 'office_phone', 'mobile_phone', 'address', 'city', 'post_code', 'region', 'category', 'ref_name', 'ref_surname', 'ref_title', 'ref_phone', 'ref_email'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
