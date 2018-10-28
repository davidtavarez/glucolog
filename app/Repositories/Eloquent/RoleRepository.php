<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RoleInterface;
use Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Validator;

class RoleRepository implements RoleInterface
{
    public function index()
    {
        if (Auth::user() && Auth::user()->hasPermissionTo('Super Admin')) {
            $roles = Role::get();
        } else {
            $roles = Role::where('institution_id', '=', Auth::user()->institution_id)->get();
        }

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        if (Auth::user() && Auth::user()->hasPermissionTo('Super Admin')) {
            $permissions = Permission::all();
        } else {
            $permissions = Permission::where('name', '!=', 'Super Admin')->get();
        }

        return view('roles.create', compact('permissions'));
    }

    public function edit($role)
    {
        if (Auth::user() && Auth::user()->hasPermissionTo('Super Admin')) {
            $permissions = Permission::all();
        } else {
            $permissions = Permission::where('name', '!=', 'Super Admin')->get();
        }
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function store($request)
    {
        $name = $request['name'];
        $role = new Role();
        $role->name = $name;
        $role->institution_id = Auth::user()->institution_id;

        $permissions = $request['permissions'];

        $role->save();

        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail();
            //Fetch the newly created role and assign permission
            $role = Role::where('name', '=', $name)->first();
            $role->givePermissionTo($p);
        }

        return redirect()->route('roles.index')
            ->with(['flash_message' =>
                'Rol ' . $role->name . ' agregado!', 'class' => 'success']);
    }

    public function update($request, $role)
    {
        $input = $request->except(['permissions']);
        $permissions = $request['permissions'];
        $role->fill($input)->save();

        $p_all = Permission::all(); //Get all permissions

        foreach ($p_all as $p) {
            $role->revokePermissionTo($p); //Remove all permissions associated with role
        }

        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail(); //Get corresponding form //permission in db
            $role->givePermissionTo($p); //Assign permission to role
        }

        return redirect()->route('roles.index')
            ->with(['flash_message' =>
                'Rol ' . $role->name . ' actualizado!', 'class' => 'success']);

    }

    public function destroy($role)
    {
        $role->delete();

        return redirect()->route('roles.index')
            ->with(['flash_message' =>
                'Role eliminado correctamente!', 'class' => 'success']);
    }
}
