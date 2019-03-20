<?php

namespace App\Http\Controllers;

use App\Advertiser;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertiserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
    public function create(Request $request)
    {
        if ($request->isMethod('POST'))
        {
            $this->validate($request, [
                'name' => 'required|string|min:15|unique:advertisers',
                'registration_no' => 'required|string|min:5|unique:advertisers',
                'phone_no' => 'required|string|min:11',
                'email' => 'required|email|unique:advertisers',
                'address' => 'required|string|max:255'
            ]);

            $advertiser = new Advertiser();

            $advertiser->name = $request->name;
            $advertiser->registration_no = $request->registration_no;
            $advertiser->phone_no = $request->phone_no;
            $advertiser->email = $request->email;
            $advertiser->address = $request->address;
            $advertiser->owner()->associate(Auth::user());

            $advertiser->saveOrFail();

            Auth::user()->syncRoles(Role::whereName('advertiser')->get()->pluck('id')->all());

            Session()->flash('message', 'Successfully created advertiser profile');

            return redirect()->route('advertiser.list', ['user' => Auth::user()]);
        }
        elseif ($request->isMethod('GET'))
        {
            return view('advertiser.create');
        }
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdvertisers(Request $request, User $user)
    {
        if (Auth::user()->hasRole('superadministrator|advertiser'))
        {
            $advertisers = [];
            $advertisers = Auth::user()->advertisers()->paginate(10);

            return view('advertiser.list', ['advertisers' => $advertisers]);
        }
        else abort(403);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminAdvertiserList(Request $request)
    {
        $advertisers = Advertiser::paginate(10);

        return view('advertiser.list', ['advertisers' => $advertisers]);
    }

    /**
     * @param Request $request
     * @param Advertiser $advertiser
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile(Request $request, Advertiser $advertiser)
    {

        if (!Auth::user()->hasRoleAndOwns(['advertiser'], $advertiser, ['requireAll' => true, 'foreignKeyName' => 'owner_id']) xor Auth::user()->hasRole('superadministrator'))
        {
            abort(403);
        }

        return view('advertiser.profile', ['advertiser' => $advertiser]);
    }
}
