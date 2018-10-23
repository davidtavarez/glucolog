<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RecordInterface;
class RecordController extends Controller
{

    protected $recordRepository;

    public function __construct(RecordInterface $recordRepository)
    {
        $this->recordRepository = $recordRepository;
    }
    
    public function index()
    {
        $records = Record::all();
        return view('records.index', compact('records'));
    }


    public function create()
    {
        return view('records.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'measure' => 'required',
            'is_in_fast' => 'required'
        ]);
        $this->recordRepository->store($request);

        return redirect('/home');
    }


    public function show(Record $record)
    {
        return view('records.show', compact('record'));
    }


}
