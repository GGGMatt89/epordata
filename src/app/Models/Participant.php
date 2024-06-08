<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = ['first_name', 'last_name', 'customer_id', 'lecture_id', 'role', 'payed'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }
}
