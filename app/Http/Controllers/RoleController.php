<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\RoleInterface;
use App\Http\Requests\RoleValidation;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    protected $role;
    public function __construct(RoleInterface $role)
    {
        $this->role = $role;
    }

    public function index()
    {
        return $this->role->index();
    }

    public function getPermissions()
    {
        return $this->role->getPermissions();
    }

    public function store(RoleValidation $request)
    {
        return $this->role->store($request);
    }

    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        return $this->role->edit($role);
    }

    public function update(RoleValidation $request, Role $role)
    {
        return $this->role->update($request, $role);
    }

    public function destroy(Role $role)
    {
        return $this->role->destroy($role);
    }
}
