<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Project;
use App\Application\Services\ProjectService;
use App\Application\Services\MemberService;
use Brian2694\Toastr\Facades\Toastr;

class ProjectController extends Controller
{
    private $service;
    private $memberservice;

    public function __construct(ProjectService $service,MemberService $memberservice)
    {
        $this->service = $service;
        $this->memberservice = $memberservice;
        $this->middleware('auth');
    }

    public function index()
    {
        $projects = $this->service->findAll();
        return view('projects.index',['projects' => $projects]);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $name = $request->get('name');
        $shortname = $request->get('shortname');
        $description = $request->get('description');
        $from = $request->get('from');
        $to = $request->get('to');
        
        if(is_null($name)){
            Toastr::error('Nombre obligatorio', 'Error de datos', ["positionClass" => "toast-bottom-right"]);
            return back();
        }

        if(is_null($shortname)){
            Toastr::error('Nombre corto obligatorio', 'Error de datos', ["positionClass" => "toast-bottom-right"]);
            return back();
        }

        if(is_null($description)){
            Toastr::error('Descripción obligatorio', 'Error de datos', ["positionClass" => "toast-bottom-right"]);
            return back();
        }

        if(is_null($from)){
            Toastr::error('Desde obligatorio', 'Error de datos', ["positionClass" => "toast-bottom-right"]);
            return back();
        }

        $project = new Project([
            'name' => $name,
            'description' => $description,
            'from' => $from,
            'to' => $to,
            'shortname' => $shortname
        ]);

        $isValid = $this->service->save($project);

        if(!$isValid)
        {
            Toastr::error('Contactese con el administrador!', 'Error de conexión', ["positionClass" => "toast-bottom-right"]);
            $back = true;
        }

        Toastr::success('Se guardó correctamente', '', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('projects.index');
    }

    public function show ($id)
    {
        $project = $this->service->findById($id);

        return view('projects.project',['project' => $project]);
    }
}
