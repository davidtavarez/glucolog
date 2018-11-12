<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserValidation;
use App\Http\Requests\ProfileValidation;

use App\Models\User;
use App\Repositories\Contracts\UserInterface;
use Auth;


class UserController extends Controller
{
    protected $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return $this->user->index();
    }

    public function create()
    {
        return $this->user->create();
    }

    public function store(UserValidation $request)
    {
        return $this->user->store($request);
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return $this->user->edit($user);
    }

    public function update(UserValidation $request, User $user)
    {
        return $this->user->update($request, $user);
    }

    public function destroy(User $user)
    {
        return $this->user->destroy($user);
    }

    public function profile()
    {
        $user = Auth::user();

        return view('users.profile', compact('user'));
    }

    public function edit_profile(ProfileValidation $request)
    {
        return $this->user->edit_profile($request);
    }
}