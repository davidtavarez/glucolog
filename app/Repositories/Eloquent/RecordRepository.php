<?php

namespace App\Repositories\Eloquent;

use App\Models\Record;
use App\Repositories\Contracts\RecordInterface;
use Auth;

class RecordRepository implements RecordInterface
{
    public function index()
    {
        $records = Record::where('board_id', Auth::user()->board_id)->paginate(15);
        return view('records.index', compact('records'));
    }
    
    public function store($request)
    {
        Record::create([
            'user_id' => Auth::user()->id,
            'board_id' => Auth::user()->board_id,
            'date' => $request->date,
            'status' => $this->validateCondition($request),
            'comment' => $request->comment,
            'food' => $request->food,
            'measure' => $request->measure,
            'condition' => $request->condition,
        ]);

        return redirect('/records');
    }

    public function validateCondition($request)
    {
        $measure = $request->measure;
        $condition = (int)$request->condition;
        //Before eat
        if($condition === 1) {
            if($measure >= 65 && $measure <= 100){
                return 'Ideal';
            }

            if($measure >= 70 && $measure <= 145){
                return 'Buen control';
            }

            if($measure < 70 || ($measure > 145 && $measure <= 162)){
                return 'Aceptable';
            }

            if($measure > 162){
                return 'Mal control';
            }
        }

        //After eat
        if($condition === 2) {
            if($measure >= 80 && $measure <= 126){
                return 'Ideal';
            }

            if($measure >= 90 && $measure <= 180){
                return 'Buen control';
            }

            if($measure < 70 || ($measure > 200 && $measure <= 250)){
                return 'Aceptable';
            }

            if($measure > 250){
                return 'Mal control';
            }
        }

        //Before sleep
        if($condition === 3) {
            if($measure >= 80 && $measure <= 100){
                return 'Ideal';
            }

            if($measure >= 120 && $measure <= 180){
                return 'Buen control';
            }

            if(($measure > 80 && $measure <= 120) || ($measure > 180 && $measure <= 200)){
                return 'Aceptable';
            }

            if($measure < 80 || $measure > 200){
                return 'Mal control';
            }
        }

        //Early Morning
        if($condition === 4) {
            if($measure >= 65 && $measure <= 100){
                return 'Ideal';
            }

            if($measure >= 80 && $measure <= 162){
                return 'Buen control';
            }

            if(($measure > 70 && $measure <= 80) || ($measure > 162 && $measure <= 200)){
                return 'Aceptable';
            }

            if($measure < 70 || $measure > 200){
                return 'Mal control';
            }
        }
    }
}
