<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
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

    public function profile(User $user)
    {
        return view('user.profile', ['user' => $user]);
    }
}
