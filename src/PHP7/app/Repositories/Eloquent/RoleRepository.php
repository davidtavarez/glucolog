<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RoleInterface;
use Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleInterface
{
    public function index()
    {
        if (Auth::user() && Auth::user()->hasPermissionTo('Super Admin')) {
            return Role::paginate(20);
        } else {
            return Role::where('board_id', '=', Auth::user()->board_id)->get();
        }
    }

    public function getPermissions()
    {
        if (Auth::user() && Auth::user()->hasPermissionTo('Super Admin')) {
            return Permission::all();
        } else {
            return Permission::where('name', '!=', 'Super Admin')->get();
        }
    }

    public function store($request)
    {
        $name = $request['name'];
        $role = Role::create([
            'name' => $request->name,
            'board_id' => Auth::user()->board_id,
        ]);
        $permissions = $request['permissions'];

        $role->save();

        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail();
            //Fetch the newly created role and assign permission
            $role = Role::where('name', '=', $name)->first();
            $role->givePermissionTo($p);
        }
        return response()->json(['message' => 'Role creado exitosamente.', 'role' => $role], 201);
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
       
        return response()->json(['message' => 'Role actualizado exitosamente.', 'role' => $role]);

    }

    public function destroy($role)
    {
        $role->delete();
        return response()->json(['message' => 'Role eliminado exitosamente.']);
    }
}
