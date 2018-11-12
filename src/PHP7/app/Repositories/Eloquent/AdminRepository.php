<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\AdminInterface;
use App\Models\User;

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
        $newPassword = $request->get('password');

        if(empty($newPassword)){
            $user->update($request->except('password'));
        }else{
            $user->update($request->all());
        }
    }
}