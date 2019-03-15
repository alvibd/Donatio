<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers(Request $request)
    {
        $user = [];
        if (Auth::user()->hasRole('superadministrator')) {
            $user = User::paginate(20);
        } else {
            abort();
        }

        return view();
    }
}
