<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\AdminInterface;
use App\User;
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

    public function store(Request $request)
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
        $request->validate([
            'password' => 'required|same:password',
            'password_confirmation' => 'required|same:password',     
          ]);

        $this->adminRepository->update($request,$user);

        return back();
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/admin');;
    }
}
