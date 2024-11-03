<?php

namespace App\Http\Controllers;

use App\Models\Datapoint;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalusers = User::count();
        $totalframework = Datapoint::where('type', 'framework')->count();
        $totallibrary = Datapoint::where('type', 'library')->count();
        return view('home', compact('totalusers', 'totalframework', 'totallibrary'));
    }
}
