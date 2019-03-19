<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Support\Facades\Hash;

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
            $roles = Role::all();
            return view('user.profile', ['user' => $user, 'roles' => $roles]);
        }
        else abort(403);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
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
    
            Session()->flash('message', 'Successfully edited information');

            $roles = Role::all();
    
            return redirect()->route('user.profile', ['user' => $user, 'roles' => $roles]);
        }
        else abort(403);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
    public function changePassword(Request $request, User $user)
    {
        if (Auth::id() == $user->id || Auth::user()->hasRole('superadministrator')) 
        {
            $validator = Validator::make($request->all(), [
                'OldPassword' => [
                    'required',
                    'string',
                    'min:8',
                    function ($attribute, $value, $fail) use ($user) {
                        if (!Hash::check($value, $user->password)) {
                            $fail('Current Password is incorrect.');
                        }
                    }
                ],
                'NewPassword' => ['required', 'string', 'min:8', 'confirmed']
            ]);

            if ($validator->fails()) {
                return redirect()
                            ->route('user.profile', ['user' => $user])
                            ->withErrors($validator);
            }

            $user->password = bcrypt($request->password);
            $user->saveOrFail();

            Session()->flash('message', 'Successfully changed password');

            $roles = Role::all();
    
            return redirect()->route('user.profile', ['user' => $user, 'roles' => $roles]);
        }
        else abort(403);
    }

    public function changeRoles(Request $request, User $user)
    {
        $this->validate($request, [
            'roles' => 'required|array|min:1',
            'roles.*' => 'required|integer|exists:roles,id'
        ]);

        $user->syncRoles($request->roles);

        Session()->flash('message', 'Successfully changed role(s)');

        $roles = Role::all();
    
        return redirect()->route('user.profile', ['user' => $user, 'roles' => $roles]);
    }
}
