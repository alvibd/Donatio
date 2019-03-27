<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertiser extends Model
{
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function adverts()
    {
        return $this->hasMany(Advert::class);
    }

    public function advertiserTransactions()
    {
        return $this->hasMany(AdvertiserTransaction::class);
    }
}
