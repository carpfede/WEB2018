<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\Services\ProjectService;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $service;

    public function __construct(ProjectService $service)
    {
        $this->service = $service;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = $this->service->findAll();

        foreach ($projects as $value) {
            # code...
            echo '<pre>'.var_dump($value).'</pre>';
        }

        Cache::add('projects',$projects,100000);

        return view('home');
        // return view('home');
    }
}
