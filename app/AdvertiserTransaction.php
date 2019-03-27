<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertiserTransaction extends Model
{
    public function advert()
    {
        return $this->belongsTo(Advert::class);
    }

    public function advertiser()
    {
        return $this->belongsTo(Advertiser::class);
    }


}
