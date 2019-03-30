<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithdrawTransaction extends Model
{
    public function withdrawRequest()
    {
        return $this->belongsTo(WithdrawRequest::class);
    }

    public function nonProfitOrganization()
    {
        return $this->belongsTo(NonProfitOrganization::class);
    }

    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}
