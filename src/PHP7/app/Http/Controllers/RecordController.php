<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordValidation;
use App\Models\Record;
use App\Repositories\Contracts\RecordInterface;

class RecordController extends Controller
{

    protected $repo;

    public function __construct(RecordInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return $this->repo->index();
    }

    public function create()
    {
        return view('records.create');
    }

    public function store(RecordValidation $request)
    {
        return $this->repo->store($request);
    }

    public function show(Record $record)
    {
        return view('records.show', compact('record'));
    }

    public function list()
    {
        return $this->repo->list();
    }
}
