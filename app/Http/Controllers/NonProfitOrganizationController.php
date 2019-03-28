<?php

namespace App\Http\Controllers;

use App\NonProfitOrganization;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NonProfitOrganizationController extends Controller
{
    public function create(Request $request)
    {
        if ($request->isMethod('GET'))
        {
            return view('ngo.create');
        }
        elseif ($request->isMethod("POST"))
        {
            $this->validate($request, [
                'name' => 'required|string|min:15|unique:non_profit_organizations',
                'tin_no' => 'required|string|min:5|unique:non_profit_organizations',
                'phone_no' => 'required|string|min:11',
                'email' => 'required|email|unique:non_profit_organizations',
                'address' => 'required|string|max:255'
            ]);

            $ngo = new NonProfitOrganization();

            $ngo->name = $request->name;
            $ngo->tin_no = $request->tin_no;
            $ngo->phone_no = $request->phone_no;
            $ngo->email = $request->email;
            $ngo->address = $request->address;
            $ngo->manager()->associate(Auth::user());

            $ngo->saveOrFail();

            Auth::user()->syncRoles(Role::whereName('non_profit_organization')->get()->pluck('id')->all());

            Session()->flash('message', 'Successfully created advertiser profile');

            return redirect()->route('user.profile', ['user' => Auth::user()]);
        }
    }
}
