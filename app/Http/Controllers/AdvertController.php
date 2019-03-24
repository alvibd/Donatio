<?php

namespace App\Http\Controllers;

use App\Advert;
use App\Advertiser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

                $video = null;

                if ($request->hasFile('file')) {
                    $video = $request->file('file');
                    return ['file_name' => $video];
                }

            }
        }
        else
            abort(403);
    }
}
