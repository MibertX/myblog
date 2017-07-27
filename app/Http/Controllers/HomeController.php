<?php

namespace App\Http\Controllers;

use App\Jobs\ChangeLocale;
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
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('main_layout');
    }

    
    public function changeLocale($lang)
    {
        session()->set('locale', $lang);

        return redirect()->back();
    }
}
