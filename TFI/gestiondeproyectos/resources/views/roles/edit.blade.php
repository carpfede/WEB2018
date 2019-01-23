@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Nuevo Rol</h4>
            <form class="mt-2" action="{{route('roles.update', $role->id)}}" method="POST">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="form-group row justify-content-center">
                    <label class="col-2 text-right">Nombre</label>
                    <div class="col-4">
                        <input type="text" class="form-control form-control-sm" name="name" value="{{$role->name}}">
                    </div>
                </div>
                <div class="form-group row justify-content-center d-flex">
                    <label class="col-2 text-right">Descripción</label>
                    <div class="col-4">
                    <textarea class="form-control" rows="3" name="description">{{$role->description}}</textarea>
                    </div>
                </div>
                <div class="form-group row justify-content-center d-flex">
                    <input type="submit" class="btn btn-primary" value="Guardar"/>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-1">
        <a href="{{route('roles.index')}}">Volver al listado</a>
    </div>
</div>
@endsection
