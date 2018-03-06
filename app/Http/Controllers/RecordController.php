<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Record::all();
        return view('records.index');
    }


    public function create()
    {
        return view('records.create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Record $record)
    {
        //
    }


    public function edit(Record $record)
    {
        //
    }


    public function update(Request $request, Record $record)
    {
        //
    }


    public function destroy(Record $record)
    {
        //
    }
}
