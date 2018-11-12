<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\AuthInterface;

class AuthController extends Controller
{
    protected $repo;
    public function __construct(AuthInterface $repo)
    {
        $this->repo = $repo;
    }
    public function register(Request $request)
    {
        return $this->repo->register($request);
    }

    public function login(Request $request)
    {
        return $this->repo->login($request);
    }

    public function logout(Request $request)
    {
        return $this->repo->logout($request);
    }
}
