@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Editar Rol</h4>
            <form class="mt-2" action="{{route('members.update', $member->id)}}" method="POST">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="form-group row justify-content-center">
                    <label class="col-2 text-right">Nombre</label>
                    <div class="col-4">
                        <input type="text" class="form-control form-control-sm" value="{{$member->firstName}}" name="firstName">
                    </div>
                </div>
                <div class="form-group row justify-content-center d-flex">
                    <label class="col-2 text-right">Apellido</label>
                    <div class="col-4">
                        <input type="text" class="form-control form-control-sm" value="{{$member->lastName}}" name="lastName">
                    </div>
                </div>
                <div class="form-group row justify-content-center d-flex">
                    <label class="col-2 text-right">Dirección</label>
                    <div class="col-4">
                        <input type="text" class="form-control form-control-sm" value="{{$member->address}}" name="address">
                    </div>
                </div>
                <div class="form-group row justify-content-center d-flex">
                    <label class="col-2 text-right">Nacimiento</label>
                    <div class="col-4">
                        <input type="date" class="form-control form-control-sm" value="{{$member->birthday}}" name="birthday">
                    </div>
                </div>
                <div class="form-group row justify-content-center d-flex">
                    <label class="col-2 text-right">CUIT</label>
                    <div class="col-4">
                        <input type="text" class="form-control form-control-sm" value="{{$member->CUIT}}" name="CUIT">
                    </div>
                </div>
                <div class="form-group row justify-content-center d-flex">
                    <label class="col-2 text-right">Email</label>
                    <div class="col-4">
                        <input type="text" class="form-control form-control-sm" value="{{$member->firstName}}" name="email">
                    </div>
                </div>
                <div class="form-group row justify-content-center d-flex">
                    <label class="col-2 text-right">Rol</label>
                    <div class="col-4">
                        <select class="form-control form-control-sm" name="role">
                            <option value="">Seleccionar rol</option>
                            @foreach ($roles as $role)
                                @if($role->id == $member->role_id)
                                    <option selected value="{{ $role->id }}">{{ $role->name }}</option>
                                @else
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row justify-content-center d-flex">
                    <input type="submit" class="btn btn-primary" value="Guardar"/>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-1">
        <a href="{{route('members.index')}}">Volver al listado</a>
    </div>
</div>
@endsection
