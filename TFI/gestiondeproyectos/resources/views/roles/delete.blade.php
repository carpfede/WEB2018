@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Detalle del Rol</h4>
            <form action="{{route('roles.destroy', $role->id)}}" method="POST">
                {{method_field('delete')}}
                {{csrf_field()}}
                <div class="form-group row justify-content-center">
                    <label class="col-2 text-right">Nombre</label>
                    <div class="col-4">
                        <input type="text" class="form-control form-control-sm" name="name" value="{{$role->name}}" disabled>
                    </div>
                </div>
                <div class="form-group row justify-content-center d-flex">
                    <label class="col-2 text-right">Descripción</label>
                    <div class="col-4">
                    <textarea class="form-control" rows="3" name="description" disabled>{{$role->description}}</textarea>
                    </div>
                </div>
                <div class="form-group row justify-content-center d-flex">
                    <label class="col-2 text-right">Sistema</label>
                    <div class="col-4">
                        <div class="form-check disabled">
                            @if($role->system)
                                <input type="checkbox" class="form-check-input" checked disabled>
                            @else
                                <input type="checkbox" class="form-check-input" disabled>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-center d-flex">
                        <input type="submit" class="btn btn-primary" value="Eliminar"/>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-1">
        <a href="{{route('roles.index')}}">Volver al listado</a>
    </div>
</div>
@endsection