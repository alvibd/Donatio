<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUsers(Request $request)
    {
        $user = [];
        if (Auth::user()->hasRole('superadministrator')) {
            $user = User::paginate(20);
        } else {
            abort(403);
        }

        return view('user_list', ['users' => $user]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile(User $user)
    {
        if (Auth::id() == $user->id || Auth::user()->hasRole('superadministrator'))
        {
            return view('user.profile', ['user' => $user]);
        }
        else abort(403);
    }

    public function editProfile(Request $request, User $user)
    {

        if(Auth::id() == $user->id || Auth::user()->hasRole('superadministrator'))
        {
            $this->validate($request, [
                'first_name' => 'required|string|max:100',
                'last_name' => 'required|string|max:100',
                'phone_no' => 'required|string|min:12',
                'gender' => [
                    'required',
                    Rule::in(['MALE', 'FEMALE', 'OTHER'])
                    ],
                'date_of_birth' => 'required|date|before_or_equal:'.Carbon::today()->subYear(18)
            ]);
    
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->phone_no = $request->phone_no;
            $user->gender = $request->gender;
            $user->date_of_birth = $request->date_of_birth;
            $user->saveOrFail();
    
            Session()->flash('message', 'Successful');
    
            return redirect()->route('user.profile', ['user' => $user]);
        }
        else abort(403);
    }

    public function changePassword(Request $request, User $user)
    {
        if (Auth::id() == $user->id || Auth::user()->hasRole('superadministrator')) 
        {
            $this->validate($request, []);
        }
    }
}
