<?php

namespace App\Http\Controllers;

use App\NonProfitOrganization;
use App\Role;
use App\WithdrawRequest;
use App\WithdrawTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NonProfitOrganizationController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
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

            Session()->flash('message', 'Successfully created NGO profile');

            return redirect()->route('user.profile', ['user' => Auth::user()]);
        }
    }

    /**
     * @param Request $request
     * @param NonProfitOrganization $organization
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile(Request $request, NonProfitOrganization $organization)
    {
        if (Auth::user()->hasRole('superadministrator')
            || Auth::user()->hasRoleAndOwns(['non_profit_organization'], $organization, ['foreignKeyName' => 'manager_id']))
        {
            return view('ngo.profile', ['ngo' => $organization->load('withdrawRequests')]);
        }
        else abort(403);
    }

    /**
     * @param Request $request
     * @param NonProfitOrganization $organization
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
    public function withdrawMoney(Request $request, NonProfitOrganization $organization)
    {
        if (Auth::user()->hasRoleAndOwns('non_profit_organization', $organization, ['foreignKeyName' => 'manager_id']))
        {
            if ($request->isMethod("GET"))
            {
                return view('ngo.withdraw', ['ngo' => $organization]);
            }
            elseif ($request->isMethod('POST'))
            {
                $this->validate($request, [
                    'money' => [
                        'required',
                        'numeric',
                        function($attribute, $value, $fail) use ($organization)
                        {
                            if ($value*100 > $organization->balance)
                            {
                                $fail($attribute.' cannot be more than balance');
                            }
                        },

                        function($attribute, $value, $fail) use ($organization)
                        {
                            if ($value <= 0)
                            {
                                $fail($attribute.' cannot be less than or equal $0.00');
                            }
                        }
                    ]
                ]);

                $withdraw = new WithdrawRequest();

                $withdraw->amount = $request->money*100;
                $withdraw->tax = 0;
                $withdraw->service_charge = 0;
                $withdraw->manager()->associate(Auth::user());
                $withdraw->nonProfitOrganization()->associate($organization);
                $withdraw->saveOrFail();

                $transaction = new WithdrawTransaction();
                $transaction->status = 'PENDING';
                $transaction->withdrawRequest()->associate($withdraw);
                $transaction->nonProfitOrganization()->associate($organization);
                $transaction->saveOrFail();

                Session()->flash('message', 'Successfully created withdraw request.');

                return redirect()->route('non_profit_organization.profile', ['organization' => $organization]);
            }
        }
        else abort(403);
    }

    /**
     * @param WithdrawRequest $withdrawRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewTransactions(WithdrawRequest $withdrawRequest)
    {
        if (Auth::user()->hasRoleAndOwns('non_profit_organization', $withdrawRequest->nonProfitOrganization, ['foreignKeyName' => 'manager_id']))
        {
            return view('ngo.transactions', ['withdraw' => $withdrawRequest]);
        }
        else abort(403);
    }

    /**
     * @param Request $request
     * @param WithdrawRequest $withdrawRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
    public function acceptTransaction(Request $request, WithdrawRequest $withdrawRequest)
    {
        if (Auth::user()->hasRole('superadministrator'))
        {
            if ($request->isMethod("GET"))
            {
                return view('ngo.accept_transaction', ['withdraw' => $withdrawRequest]);
            }
            elseif ($request->isMethod('POST'))
            {
                $this->validate($request, [
                   'service_charge' => [
                       'required',
                       'numeric',
                       function($attribute, $value, $fail) use ($withdrawRequest)
                       {
                           if ($withdrawRequest->nonProfitOrganization->balance < $value*100)
                           {
                               $fail($attribute.' cannot be less than Organization balance.');
                           }
                       }
                   ],
                    'tax' => 'required|numeric',
                    'service_charge' => 'required|numeric',
                ]);

                $withdrawRequest->amount -= ($request->service_charge*100 + $request->tax*100);
                $withdrawRequest->tax = $request->tax*100;
                $withdrawRequest->service_charge = $request->service_charge*100;
                $withdrawRequest->saveOrFail();

                $transaction = new WithdrawTransaction();
                $transaction->status = 'APPROVED';
                $transaction->withdrawRequest()->associate($withdrawRequest);
                $transaction->nonProfitOrganization()->associate($withdrawRequest->nonProfitOrganization);
                $transaction->processedBy()->associate(Auth::user());
                $transaction->saveOrFail();

                $ngo = $withdrawRequest->nonProfitOrganization;

                $ngo->balance -= $request->amount;
                $ngo->saveOrFail();

                Session()->flash('message', 'Successfully processed withdraw request.');

                return redirect()->route('non_profit_organization.profile', ['organization' => $withdrawRequest->nonProfitOrganization]);
            }
        }
        else abort(403);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $organizations = NonProfitOrganization::paginate(10);

        return view('ngo.list', ['organizations' => $organizations]);
    }
}
