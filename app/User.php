<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function advertisers()
    {
        return $this->hasMany(Advertiser::class, 'owner_id');
    }

    public function adverts()
    {
        return $this->hasMany(Advert::class);
    }

    public function nonProfitOrganization()
    {
        return $this->hasOne(NonProfitOrganization::class, 'manager_id');
    }

    public function withdrawRequests()
    {
        return $this->hasMany(WithdrawRequest::class, 'manager_id');
    }

    public function withdrawTransactions()
    {
        return $this->hasMany(WithdrawTransaction::class, 'processed_by');
    }
}
