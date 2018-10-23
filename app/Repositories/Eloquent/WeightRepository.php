<?php

namespace App\Repositories\Eloquent;

use App\Models\Weight;
use App\Repositories\Contracts\WeightInterface;
use Auth;

class WeightRepository implements WeightInterface
{
    public function index()
    {
        $weights = Weight::where('board_id', Auth::user()->board_id)->get();
        return view('weight.index', compact('weights'));
    }

    public function store($request)
    {
        Weight::create([
            'user_id' => Auth::user()->id,
            'board_id' => Auth::user()->board_id,
            'weight' => $request->weight,
            'date' => $request->date,
        ]);
        return redirect('/weights');
    }
}
