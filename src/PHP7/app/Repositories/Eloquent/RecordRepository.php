<?php

namespace App\Repositories\Eloquent;

use App\Models\Record;
use App\Repositories\Contracts\RecordInterface;
use Auth;
use Carbon\Carbon;

class RecordRepository implements RecordInterface
{
    public function index()
    {
        $from = Carbon::now()->subDays(7);
        $records = Record::where('board_id', Auth::user()->board_id)->where('date', '>=', $from)->get();
        return response()->json(['records' => $records]);
    }

    public function store($request)
    {
        $record = Record::create([
            'user_id' => Auth::user()->id,
            'board_id' => Auth::user()->board_id,
            'date' =>  Carbon::parse($request->date .' '.$request->time),
            'status' => $this->validateCondition($request),
            'comment' => $request->comment,
            'measure' => $request->measure,
            'condition' => $request->condition,
        ]);

        return response()->json(['message' => 'Medida creada exitosamente.', 'record' => $record], 201);
    }

    public function validateCondition($request)
    {
        $measure = $request->measure;
        $condition = (int)$request->condition;

        // Antes de comida
        if ($condition === 1) {
            if ($measure < 40) {
                return 'Muy baja';
            }

            else if ($measure > 40 && $measure < 70) {
                return 'Baja pero Aceptable';
            }

            else if ($measure >= 70 && $measure < 90) {
                return 'Buen control';
            }

            else if ($measure >= 90 && $measure < 110) {
                return 'Ideal';
            }

            else if ($measure >= 110 && $measure < 170) {
                return 'Alta pero Aceptable';
            }

            else if ($measure >= 170) {
                return 'Muy Alta';
            }
        }

        // 2 Horas pos-comida
        if ($condition === 2) {
            if ($measure < 70) {
                return 'Muy baja';
            }

            else if ($measure > 70 && $measure < 90) {
                return 'Baja pero Aceptable';
            }

            else if ($measure >= 90 && $measure < 100) {
                return 'Buen control';
            }

            else if ($measure >= 100 && $measure < 140) {
                return 'Ideal';
            }

            else if ($measure >= 140 && $measure < 210) {
                return 'Alta pero Aceptable';
            }

            else if ($measure >= 210) {
                return 'Muy Alta';
            }
        }

    }

    public function list()
    {
        return Record::where('board_id', Auth::user()->board_id)->paginate(20);
    }
}
