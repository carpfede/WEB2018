<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Project;
use App\Domain\Sprint;
use App\Domain\Task;
use App\Domain\SubTask;
use App\Application\Services\ProjectService;
use App\Application\Services\MemberService;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

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
        $projects = $this->service->findCurrent();
        $members = $this->memberservice->findAll();
        return view('projects.index',['projects' => $projects, 'members' => $members]);
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

        $member = Auth::user()->member->id;

        $isValid = $this->service->save($project,$member);

        if(!$isValid)
        {
            Toastr::error('Contactese con el administrador!', 'Error de conexión', ["positionClass" => "toast-bottom-right"]);
            $back = true;
        }

        Toastr::success('Se guardó correctamente', '', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('projects.index');
    }

    public function show ($id, $sprintId = null)
    {
        $project = $this->service->findById($id);
        $sprint = \App\Domain\Sprint::find($sprintId);

        return view('projects.project',['project' => $project, 'sprint' => $sprint]);
    }

    public function updateMembers(Request $request)
    {
        $members = $request->get('members');
        $project = $request->get('project');
        $isValid = $this->service->updateMembers($project,$members);


        if(!$isValid)
        {
            Toastr::error('Contactese con el administrador!', 'Error de conexión', ["positionClass" => "toast-bottom-right"]);
        }

        Toastr::success('Se guardó correctamente', '', ["positionClass" => "toast-bottom-right"]);

        return back();
    }

    public function storeSprint(Request $request)
    {
        $number = $request->get('number');
        $version = $request->get('version');
        $from = $request->get('from');
        $toEstimated = $request->get('toEstimated');
        $project = $request->get('project');

        $sprint = new Sprint([
            'number' => $number,
            'version' => $version,
            'from' => $from,
            'toEstimated' => $toEstimated,
            'project_id' => $project
        ]);

        $isValid = $this->service->saveSprint($sprint);

        if(!$isValid)
        {
            Toastr::error('Contactese con el administrador!', 'Error de conexión', ["positionClass" => "toast-bottom-right"]);
        }

        Toastr::success('Se guardó correctamente', '', ["positionClass" => "toast-bottom-right"]);

        return back();
    }

    public function storeTask(Request $request)
    {
        $name = $request->get('name');
        $priority = $request->get('priority');
        $status = $request->get('status');
        $description = $request->get('description');
        $type = $request->get('type');
        $sprint = $request->get('sprint');
        $member = $request->get('member');

        $task = new Task([
            'name' => $name,
            'priority' => $priority,
            'description' => $description,
            'status' => $status,
            'type' => $type,
            'sprint_id' => $sprint,
            'member_id' => $member
        ]);

        $isValid = $this->service->saveTask($task);

        if(!$isValid)
        {
            Toastr::error('Contactese con el administrador!', 'Error de conexión', ["positionClass" => "toast-bottom-right"]);
            return back();
        }

        Toastr::success('Se guardó correctamente', '', ["positionClass" => "toast-bottom-right"]);

        return back();
    }

    public function updateTask(Request $request)
    {
        $isValid = $this->service->updateTask($request->get('id'),$request->get('status'));

        if(!$isValid)
        {
            Toastr::error('Tarea inexistente', 'Error', ["positionClass" => "toast-bottom-right"]);
        }

        Toastr::success('Se guardó correctamente', '', ["positionClass" => "toast-bottom-right"]);

        return back();
    }

    public function storeSubtask(Request $request)
    {
        $name = $request->get('name');
        $estimated = $request->get('estimated');
        $status = $request->get('status');
        $task = $request->get('task');
        $member = $request->get('member');

        $subtask = new SubTask([
            'name' => $name,
            'estimated' => $estimated,
            'remaining' => $estimated,
            'status' => $status,
            'task_id' => $task,
            'member_id' => $member
        ]);

        $isValid = $this->service->saveSubTask($subtask);

        if(!$isValid)
        {
            Toastr::error('Contactese con el administrador!', 'Error de conexión', ["positionClass" => "toast-bottom-right"]);
        }

        Toastr::success('Se guardó correctamente', '', ["positionClass" => "toast-bottom-right"]);

        return back();
    }
}
