<?php

namespace App\Repositories\Eloquent;

use App\Models\Weight;
use App\Repositories\Contracts\WeightInterface;
use Auth;

class WeightRepository implements WeightInterface
{
    public function index()
    {
        return Weight::where('board_id', Auth::user()->board_id)->get();
    }

    public function store($request)
    {
        $weight = Weight::create([
            'user_id' => Auth::user()->id,
            'board_id' => Auth::user()->board_id,
            'weight' => $request->weight,
            'date' => $request->date,
        ]);
        
        return response()->json(['message' => 'Peso creado exitosamente.', 'weight' => $weight], 201);
    }
}
