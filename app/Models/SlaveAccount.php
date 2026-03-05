<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlaveAccount extends Model
{
    protected $fillable = ['master_account_id', 'server', 'password'];

    protected $hidden = ['password'];

    protected $casts = [
        'password' => 'encrypted',
    ];

    public function masterAccount()
    {
        return $this->belongsTo(MasterAccount::class);
    }
}
