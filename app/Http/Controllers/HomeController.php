<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function showPage($path)
    {
        $page = Page::where('path', $path)->first();

        if ($page->active)
            return view('client.pages.page')->withPage($page);
        else
           return app()->abort(404);
    }
}
