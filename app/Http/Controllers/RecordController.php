<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RecordInterface;
class RecordController extends Controller
{

    protected $recordRepository;

    public function __construct(RecordInterface $recordRepository)
    {
        $this->recordRepository = $recordRepository;
        $this->middleware('auth');
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
        $this->recordRepository->store($request);

        return redirect('/home');
    }


    public function show(Record $record)
    {
        return view('records.show', compact('record'));
    }


}
