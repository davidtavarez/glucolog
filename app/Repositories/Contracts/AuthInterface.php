<?php

namespace App\Repositories\Contracts;

interface AuthInterface
{
    public function register($request);
    public function login($request);
    public function logout($request);
}