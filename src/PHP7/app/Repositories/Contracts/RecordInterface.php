<?php

namespace App\Repositories\Contracts;

interface RecordInterface
{
    public function store($request);
    public function index();
    public function validateCondition($request);
}