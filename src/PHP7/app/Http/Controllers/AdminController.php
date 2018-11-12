<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\AdminInterface;
use App\Models\User;
use App\Http\Requests\UserAccountValidation;

class AdminController extends Controller
{
    protected $adminRepository;

    public function __construct(AdminInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
        $this->middleware('Admin');
    }

    public function index()
    {
        $users = User::all();
        return view('admin.index', compact('users'));
    }


    public function create()
    {
        return view('admin.create');
    }

    public function store(UserAccountValidation $request)
    {
        $this->adminRepository->store($request);

        return redirect('/admin');
    }


    public function edit(User $user)
    {
        return view('admin.edit', compact('user'));
    }


    public function update(Request $request,User $user)
    {

        $this->adminRepository->update($request,$user);

        return redirect('/admin');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/admin');;
    }
}
