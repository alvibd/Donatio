<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('viewAds', function (\App\Advert $model, \App\NonProfitOrganization $organization){

    while ($model
        ->whereRaw('(start_date <= now() and end_date >= now() and balance > 35)')
        ->orderByRaw('(DATEDIFF(end_date, '.\Carbon\Carbon::today()->toDateString().')/balance) DESC')
        ->count())
    {
        $adverts = $model
            ->whereRaw('(start_date <= now() and end_date >= now() and balance > 0)')
            ->orderByRaw('(DATEDIFF(end_date, '.\Carbon\Carbon::today()->toDateString().')/balance) DESC')
            ->get()
            ;
        foreach ($adverts as $advert)
        {
            $advert->view_count += 1;
            $advert->balance -= .35*100;
            if ( $advert->balance <0 ) break;
            $advert->saveOrFail();

            $ngo = $organization->inRandomOrder()->first();
            $ngo->balance += .35*100;
            $ngo->saveOrFail();

            $this->line($ngo->name. ' got donation.');
        }
    }
    $this->info("Successfully charged all the adverts for random NGOs.");
})->describe('Emulates an Advert view system.');
