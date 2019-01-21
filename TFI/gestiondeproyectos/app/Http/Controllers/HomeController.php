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
        $projects = $this->service->findCurrent();
        Cache::forget('projects');
        Cache::add('projects',$projects,1);
        return view('home');
    }
}
