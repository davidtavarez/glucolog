<?php

namespace App\Repositories\Contracts;

interface UserInterface
{
    public function store($request);
    public function edit_profile($request);
} 