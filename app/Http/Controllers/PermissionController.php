<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $permissions = Permission::paginate(10);

        return view('permission.list', ['permissions' => $permissions]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {
        if($request->isMethod('GET'))
        {
            return view('permission.create');
        }
        elseif ($request->isMethod('POST')) {
            
            $this->validate($request, [
                'name' => 'required|string|min:4',
                'display_name' => 'required|string|min:4',
                'description' => 'sometimes|string|min:10'
            ]);

            $permission = new Permission();
            $permission->name = $request->display_name;
            $permission->display_name = $request->name;
            $permission->description = $request->description;

            $role->saveOrFail();

            Session()->flash('message', 'Successfully created permission');

            return redirect()->route('admin.permission.list');
        }
    }

    /**
     * @param Request $request
     * @param Permission $permission
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Throwable
     */
    public function edit(Request $request, Permission $permission)
    {
        if($request->isMethod('GET'))
        {
            return view('permission.edit', ['permission' => $permission]);
        }
        elseif ($request->isMethod('POST')) {
            
            $permission->display_name = $request->name;
            $permission->description = $request->description;

            $permission->saveOrFail();

            Session()->flash('message', 'Successfully edited permission');

            return redirect()->route('admin.permission.list');
        }
    }
}
