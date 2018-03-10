<?php

namespace App\Repositories\Contracts;

interface AdminInterface
{
    public function store($request);
    public function update($request,$user);
}