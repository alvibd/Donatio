<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertiser extends Model
{
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
