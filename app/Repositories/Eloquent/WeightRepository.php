<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\WeightInterface;
use App\Models\Weight;
use Auth;
class WeightRepository implements WeightInterface
{
    public function store($request)
    {
        Weight::create([
            'user_id' => Auth::user()->id,
            'weight' => $request->weight,
            'date' => $request->date
        ]);
    }
}