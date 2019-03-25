<?php
/**
 * Created by PhpStorm.
 * User: kolorob02
 * Date: 3/20/19
 * Time: 12:06 PM
 */

namespace App;


class AppConstant
{

    public static $gender = [
        'male' => 'MALE',
        'female' => 'FEMALE',
        'other' => 'OTHER'
    ];

    public static $advert_status = [
        'pending' => 'PENDING',
        'processing' => 'PROCESSING',
        'approved' => 'APPROVED',
        'refunded' => 'REFUNDED'
    ];
}