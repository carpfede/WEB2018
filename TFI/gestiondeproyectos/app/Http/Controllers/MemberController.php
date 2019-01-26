<?php

namespace App\Http\Controllers;

use App\Domain\Member;
use Illuminate\Http\Request;
use App\Application\Services\MemberService;
use App\Application\Services\RoleService;
use Brian2694\Toastr\Facades\Toastr;

class MemberController extends Controller
{
    private $service;
    private $roleservice;

    public function __construct(MemberService $service, RoleService $roleservice)
    {
        $this->service = $service;
        $this->roleservice = $roleservice;
        $this->middleware('auth');
    }

    public function index()
    {
        $members = $this->service->findAll();

        return view('members.index',['members' => $members]);
    }

    public function create()
    {
        $roles = $this->roleservice->findAll();

        return view('members.create',['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $back = false;

        $firstName = $request->get('firstName');
        $lastName = $request->get('lastName');
        $address = $request->get('address');
        $birthday = $request->get('birthday');
        $CUIT = $request->get('CUIT');
        $email = $request->get('email');
        $role = $request->get('role');

        if(is_null($CUIT))
        {
            Toastr::error('CUIT obligatorio', 'Error de datos', ["positionClass" => "toast-bottom-right"]);
            $back = true;
        }

        if(is_null($firstName))
        {
            Toastr::error('Nombre obligatorio', 'Error de datos', ["positionClass" => "toast-bottom-right"]);
            $back = true;
        }

        if(is_null($lastName))
        {
            Toastr::error('Apellido obligatorio', 'Error de datos', ["positionClass" => "toast-bottom-right"]);
            $back = true;
        }

        if(is_null($email))
        {
            Toastr::error('E-mail obligatorio', 'Error de datos', ["positionClass" => "toast-bottom-right"]);
            $back = true;
        }

        if(is_null($role))
        {
            Toastr::error('Rol obligatorio', 'Error de datos', ["positionClass" => "toast-bottom-right"]);
            $back = true;
        }

        if($back){
            return back();
        }

        $member = new Member(
            [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'address' => $address,
                'birthday' => $birthday,
                'CUIT' => $CUIT,
                'email' => $email,
                'role_id' => $role
            ]
        );
        
        $isValid = $this->service->save($member);

        if(!$isValid)
        {
            Toastr::error('Contactese con el administrador!', 'Error de conexión', ["positionClass" => "toast-bottom-right"]);
            $back = true;
        }

        Toastr::success('Se guardó correctamente', '', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('members.index');
    }

    public function show($id)
    {
        $member = $this->service->findById($id);

        return view('members.detail',['member' => $member]);
    }

    public function edit($id)
    {
        $member = $this->service->findById($id);
        $roles = $this->roleservice->findAll();

        return view('members.edit',['member' => $member,'roles' => $roles]);
    }

    public function update(Request $request, $id)
    {
        $back = false;

        $firstName = $request->get('firstName');
        $lastName = $request->get('lastName');
        $address = $request->get('address');
        $birthday = $request->get('birthday');
        $CUIT = $request->get('CUIT');
        $email = $request->get('email');
        $role = $request->get('role');

        if(is_null($CUIT))
        {
            Toastr::error('CUIT obligatorio', 'Error de datos', ["positionClass" => "toast-bottom-right"]);
            $back = true;
        }

        if(is_null($firstName))
        {
            Toastr::error('Nombre obligatorio', 'Error de datos', ["positionClass" => "toast-bottom-right"]);
            $back = true;
        }

        if(is_null($lastName))
        {
            Toastr::error('Apellido obligatorio', 'Error de datos', ["positionClass" => "toast-bottom-right"]);
            $back = true;
        }

        if(is_null($email))
        {
            Toastr::error('E-mail obligatorio', 'Error de datos', ["positionClass" => "toast-bottom-right"]);
            $back = true;
        }

        if(is_null($role))
        {
            Toastr::error('Rol obligatorio', 'Error de datos', ["positionClass" => "toast-bottom-right"]);
            $back = true;
        }

        $member = new Member(
            [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'address' => $address,
                'birthday' => $birthday,
                'CUIT' => $CUIT,
                'email' => $email,
                'role_id' => $role
            ]
        );

        $isValid = $this->service->update($member,$id);

        if(!$isValid)
        {
            Toastr::error('Contactese con el administrador!', 'Error de conexión', ["positionClass" => "toast-bottom-right"]);
            $back = true;
        }

        Toastr::success('Se guardó correctamente', '', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('members.index');
    }
}
