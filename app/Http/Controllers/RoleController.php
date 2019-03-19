<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $roles = Role::paginate(10);

        return view('role.list', ['roles' => $roles]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
    public function create(Request $request)
    {
        $permissions = Permission::all();

        if($request->isMethod('GET'))
        {
            return view('role.create', ['permissions' => $permissions]);
        }
        elseif ($request->isMethod('POST')) {
            
            $this->validate($request, [
                'name' => 'required|string|min:4',
                'display_name' => 'required|string|min:4',
                'description' => 'sometimes|string|min:10',
                'permissions' => 'required|array|min:1',
                'permissions.*' => 'required|integer|exists:permissions,id'
            ]);

            $role = new Role();
            $role->name = $request->display_name;
            $role->display_name = $request->name;
            $role->description = $request->description;

            $role->saveOrFail();

            $role->syncPermissions($request->permissions);

            Session()->flash('message', 'Successfully created role');

            return redirect()->route('admin.role.list');
        }
    }

    /**
     * @param Request $request
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Throwable
     */
    public function edit(Request $request, Role $role)
    {
        if($request->isMethod('GET'))
        {
            $permissions = Permission::all();
            return view('role.edit', ['role' => $role, 'permissions' => $permissions]);
        }
        elseif ($request->isMethod('POST')) {
            
            $role->display_name = $request->name;
            $role->description = $request->description;

            $role->saveOrFail();

            $role->syncPermissions($request->permissions);

            Session()->flash('message', 'Successfully edited role');

            return redirect()->route('admin.role.list');
        }
    }
}
