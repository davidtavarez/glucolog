<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Record;
use DB;
class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Record::whereDate('created_at', DB::raw('CURDATE()'))->get();
        return view('home', compact('records'));
    }
}
