<?php

namespace App\Http\Controllers;

use App\Domain\Role;
use Illuminate\Http\Request;
use App\Application\Services\RoleService;
use Brian2694\Toastr\Facades\Toastr;

class RoleController extends Controller
{
    private $service;

    public function __construct(RoleService $service)
    {
        $this->service = $service;
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = $this->service->findAll();

        return view('roles.index',['roles' => $roles]);
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $name = $request->get('name');
        $description = $request->get('description');
        $system = $request->get('system');

        if(is_null($name) || is_null($description))
        {
            Toastr::error('Nombre y descripción obligatorios', 'Error de datos', ["positionClass" => "toast-bottom-right"]);
            return back();
        }

        $role = new Role(
            [
                'name' => $name,
                'description' => $description,
                'system' => $system
            ]
        );

        $isValid = $this->service->save($role);

        if(!$isValid)
        {
            Toastr::error('Contactese con el administrador!', 'Error de conexión', ["positionClass" => "toast-bottom-right"]);
            return back();
        }

        Toastr::success('Se guardó correctamente', '', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('roles.index');
    }

    public function show($id)
    {
        $role = $this->service->findById($id);

        return view('roles.detail',['role' => $role]);
    }

    public function edit($id)
    {
        $role = $this->service->findById($id);

        return view('roles.edit',['role' => $role]);
    }

    public function update(Request $request, $id)
    {
        $name = $request->get('name');
        $description = $request->get('description');
        
        if(is_null($name) || is_null($description))
        {
            Toastr::error('Nombre y descripción obligatorios', 'Error de datos', ["positionClass" => "toast-bottom-right"]);
            return back();
        }

        $role = new Role(
            [
                'name' => $name,
                'description' => $description
            ]
        );

        $isValid = $this->service->update($role,$id);

        if(!$isValid)
        {
            Toastr::error('Contactese con el administrador!', 'Error de conexión', ["positionClass" => "toast-bottom-right"]);
            return back();
        }

        Toastr::success('Se guardó correctamente', '', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('roles.index');
    }

    public function destroy($id)
    {
        $isValid = $this->service->delete($id);

        if(!$isValid)
        {
            Toastr::error('Contactese con el administrador!', 'Error de conexión', ["positionClass" => "toast-bottom-right"]);
            return back();
        }

        Toastr::success('Se elimino correctamente', '', ["positionClass" => "toast-bottom-right"]);

        return redirect()->route('roles.index');
    }

    public function delete($id)
    {
        $role = $this->service->findById($id);

        return view('roles.delete',['role' => $role]);
    }
}
