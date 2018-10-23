<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\RecordInterface;
use App\Models\Record;
use Auth;
class RecordRepository implements RecordInterface
{
    public function store($request)
    {
        Record::create([
            'user_id' => Auth::user()->id,
            'fecha' => $request->fecha,
            'fecha' => $request->fecha,
            'ayuno' => $request->ayuno,
            'comentario' => $request->comentario,
            'comida' => $request->comida,
            'medida' => $request->medida,
            'tipo_comida' => $request->tipo_comida
        ]);
    }
}