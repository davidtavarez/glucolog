<?php

namespace App\Http\Controllers;

use App\Peso;
use Illuminate\Http\Request;
use App\Repositories\Contracts\PesoInterface;

class PesoController extends Controller
{
    protected $pesoRepository;

    public function __construct(PesoInterface $pesoRepository)
    {
        $this->pesoRepository = $pesoRepository;
        $this->middleware('auth');
    }

    public function index()
    {
        $pesos = Peso::all();
        return view('pesos.index', compact('pesos'));
    }


    public function create()
    {
        return view('pesos.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'peso' => 'required',
            'fecha' => 'required'
        ]);

        $this->pesoRepository->store($request);

        return redirect('/pesos');
    }


}
