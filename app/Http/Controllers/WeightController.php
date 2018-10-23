<?php

namespace App\Http\Controllers;

use App\Models\Weight;
use App\Repositories\Contracts\WeightInterface;
use App\Http\Requests\WeightValidation;
use Illuminate\Http\Request;

class WeightController extends Controller
{
    protected $repo;

    public function __construct(WeightInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return $this->repo->index();
    }

    public function create()
    {
        return view('weight.create');
    }

    public function store(WeightValidation $request)
    {
        return $this->repo->store($request);
    }

}
