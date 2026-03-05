<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterAccount extends Model
{
    protected $fillable = ['customer_id', 'server', 'password'];

    protected $hidden = ['password'];

    protected $casts = [
        'password' => 'encrypted',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function slaveAccounts()
    {
        return $this->hasMany(SlaveAccount::class);
    }
}
