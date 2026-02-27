<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'plan_id', 'status'
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
