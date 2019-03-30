<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    public function nonProfitOrganization()
    {
        return $this->belongsTo(NonProfitOrganization::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function withdrawTransactions()
    {
        return $this->hasMany(WithdrawTransaction::class);
    }

    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}
