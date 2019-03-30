<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NonProfitOrganization extends Model
{
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function withdrawRequests()
    {
        return $this->hasMany(WithdrawRequest::class);
    }
    
    public function withdrawTransactions()
    {
        return $this->hasMany(WithdrawTransaction::class);
    }
}
