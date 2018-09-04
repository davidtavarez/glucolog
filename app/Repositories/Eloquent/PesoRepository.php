<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\PesoInterface;
use App\Peso;
use Auth;
class PesoRepository implements PesoInterface
{
    public function store($request)
    {
        Peso::create([
            'user_id' => Auth::user()->id,
            'peso' => $request->peso,
            'fecha' => $request->fecha
        ]);
    }
}