<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\Middleware\DataResponse;

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
        require_once("GetNewsData.php");
        $newsData = new \GetNewsData();
        $data = $newsData->getData(1);
        return view('home')->with("data", $data);
    }
}
