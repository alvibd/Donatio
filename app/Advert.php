<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    public function advertiser()
    {
        return $this->belongsTo(Advertiser::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
