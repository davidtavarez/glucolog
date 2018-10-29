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
            $roles = Role::where('board_id', '=', Auth::user()->board_id)->get();
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
        $role = Role::create([
            'name' => $request->name,
            'board_id' => Auth::user()->board_id
        ]);
        $permissions = $request['permissions'];

        $role->save();

        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail();
            //Fetch the newly created role and assign permission
            $role = Role::where('name', '=', $name)->first();
            $role->givePermissionTo($p);
        }
        flash('Role creado exitosamente.')->success();

        return redirect()->route('roles.index');
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
        flash('Role actualizado exitosamente.')->success();

        return redirect()->route('roles.index');

    }

    public function destroy($role)
    {
        $role->delete();
        flash('Role eliminado exitosamente.')->success();
        return redirect()->route('roles.index');
    }
}
