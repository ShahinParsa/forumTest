<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // auth for session
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // show last 3 topics
        $topics= Topic::orderBy('created_at', 'desc')->paginate(6);
        return view('welcome',compact('topics'));
    }

}
