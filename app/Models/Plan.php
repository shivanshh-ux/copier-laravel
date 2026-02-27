<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'actual_price',
        'discounted_price', 'duration_days', 'is_active'
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function getEffectivePriceAttribute()
    {
        return $this->discounted_price ?? $this->actual_price;
    }

    public function getDiscountPercentAttribute()
    {
        if ($this->discounted_price && $this->actual_price > 0) {
            return round((($this->actual_price - $this->discounted_price) / $this->actual_price) * 100);
        }
        return 0;
    }
}
