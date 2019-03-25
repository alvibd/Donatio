<?php

namespace App\Http\Controllers;

use App\Advert;
use App\Advertiser;
use App\AppConstant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdvertController extends Controller
{
    public function create(Request $request, Advertiser $advertiser)
    {
        if (Auth::user()->hasRole('superadministraor') || Auth::user()->hasRoleAndOwns(['advertiser'], $advertiser, ['requireAll' => false, 'foreignKeyName' => 'owner_id']))
        {
            if ($request->isMethod('GET'))
            {
                return view('advert.create', ['advertiser' => $advertiser]);
            }
            elseif($request->isMethod('POST'))
            {
                $this->validate($request, [
                    'name' => 'required|string|min:10|max:100',
                    'start_date' => 'required|date|after_or_equal:today',
                    'end_date' => 'required|date|after_or_equal:start_date',
                    'money' => 'required|numeric|min:1',
                    'file' => 'required|file|mimes:mp4|max:10240'
                ]);

                $advert = new Advert();

                $advert->advertiser()->associate($advertiser);
                $advert->user()->associate($advertiser->owner);
                $advert->advert_name = $request->name;
                $advert->start_date = $request->start_date;
                $advert->end_date = $request->end_date;
                $advert->balance = $request->money*100;
                $advert->status = AppConstant::$advert_status['pending'];

                $video = null;

                if ($request->hasFile('file')) {
                    $video = $request->file('file')->store('public');
                    $advert->file_name = Storage::url($video);
                }

                $advert->saveOrFail();

                Session()->flash('message', 'Upload successful. Awaiting censor approval. Your money will be refunded in case of your advert fails in censorship');

                return redirect()->route('advertiser.profile', ['advertiser' => $advertiser]);
            }
        }
        else
            abort(403);
    }
}
