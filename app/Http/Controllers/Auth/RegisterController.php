<?php

namespace App\Http\Controllers\Auth;

use App\AppConstant;
use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_no' => 'required|string|min:11',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['accepted']
        ]);
    }

    /**
     * @param array $data
     * @return User
     * @throws \Throwable
     */
    protected function create(array $data)
    {
        $user = new User();

        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->name = $data['first_name'].' '.$data['last_name'];
        $user->email = $data['email'];
        $user->phone_no = $data['phone_no'];
        $user->password = Hash::make($data['password']);
        $user->gender = AppConstant::$gender['male'];
        $user->date_of_birth = Carbon::today();

        $user->saveOrFail();

        $user->attachRole(Role::whereName('user')->first());

        return $user;
    }
}
