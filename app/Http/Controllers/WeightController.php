<?php

namespace App\Http\Controllers;

use App\Weight;
use Illuminate\Http\Request;
use App\Repositories\Contracts\WeightInterface;

class WeightController extends Controller
{
    protected $weightRepository;

    public function __construct(WeightInterface $weightRepository)
    {
        $this->weightRepository = $weightRepository;

    }

    public function index()
    {
        $weights = Weight::all();
        return view('weight.index', compact('weights'));
    }


    public function create()
    {
        return view('weight.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'weight' => 'required',
            'date' => 'required'
        ]);

        $this->weightRepository->store($request);

        return redirect('/weights');
    }


}
