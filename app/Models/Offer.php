<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'description', 'plan_id',
        'actual_price', 'discounted_price', 'valid_until', 'is_active'
    ];

    protected $casts = [
        'valid_until' => 'date',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function getSavingsAttribute()
    {
        return $this->actual_price - $this->discounted_price;
    }

    public function getDiscountPercentAttribute()
    {
        if ($this->actual_price > 0) {
            return round((($this->actual_price - $this->discounted_price) / $this->actual_price) * 100);
        }
        return 0;
    }
}
