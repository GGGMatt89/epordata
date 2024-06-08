<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = ['customer_id', 'user_id', 'cust_name', 'cust_surname', 'meet_address', 'scheduled_at', 'notes', 'remote'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
