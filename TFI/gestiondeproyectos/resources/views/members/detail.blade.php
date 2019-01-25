@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Detalles del Miembro</h4>
            <div class="form-group row justify-content-center">
                <label class="col-2 text-right">Nombre</label>
                <div class="col-4">
                    <input type="text" class="form-control form-control-sm" value="{{$member->firstName}}" disabled>
                </div>
            </div>
            <div class="form-group row justify-content-center d-flex">
                <label class="col-2 text-right">Apellido</label>
                <div class="col-4">
                    <input type="text" class="form-control form-control-sm" value="{{$member->lastName}}" disabled>
                </div>
            </div>
            <div class="form-group row justify-content-center d-flex">
                <label class="col-2 text-right">Dirección</label>
                <div class="col-4">
                    <input type="text" class="form-control form-control-sm" value="{{$member->address}}" disabled>
                </div>
            </div>
            <div class="form-group row justify-content-center d-flex">
                <label class="col-2 text-right">Nacimiento</label>
                <div class="col-4">
                    <input type="date" class="form-control form-control-sm" value="{{$member->birthday}}" disabled>
                </div>
            </div>
            <div class="form-group row justify-content-center d-flex">
                <label class="col-2 text-right">CUIT</label>
                <div class="col-4">
                    <input type="text" class="form-control form-control-sm" value="{{$member->CUIT}}" disabled>
                </div>
            </div>
            <div class="form-group row justify-content-center d-flex">
                <label class="col-2 text-right">Email</label>
                <div class="col-4">
                    <input type="text" class="form-control form-control-sm" value="{{$member->email}}" disabled>
                </div>
            </div>
            <div class="form-group row justify-content-center d-flex">
                <label class="col-2 text-right">Rol</label>
                <div class="col-4">
                    <select class="form-control form-control-sm" name="role" disabled>
                        <option value="">{{$member->role->name}}</option>
                    </select>
                </div>
            </div>
            <div class="form-group row justify-content-center d-flex">
                <label class="col-2 text-right">Usuario</label>
                <div class="col-4">
                    <input type="text" class="form-control form-control-sm" value="{{$member->user->username}}" disabled>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-1">
        <a href="{{route('members.index')}}">Volver al listado</a>
    </div>
</div>
@endsection
