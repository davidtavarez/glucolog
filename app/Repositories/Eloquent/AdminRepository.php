<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\AdminInterface;
use App\User;

class AdminRepository implements AdminInterface
{
    public function store($request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_user' => $request->is_user,
            'is_admin' => $request->is_admin
        ]);
    }
    public function update($request, $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->is_admin = $request->is_admin;
        $user->is_user = $request->is_user;
        $user->update();
    }
}