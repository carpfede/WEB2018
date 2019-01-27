@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card bg-light">
        <div class="card-body">
            <h4 class="card-title">Datos del proyecto</h4>
            <div class="form-group row justify-content-center">
                <label class="col-2 text-right">Nombre</label>
                <div class="col-4">
                    <input type="text" class="form-control form-control-sm" disabled value="{{ $project->name }}">
                </div>
                <label class="col-2 text-right">Nombre Corto</label>
                <div class="col-4">
                    <input type="text" class="form-control form-control-sm" disabled value="{{ $project->shortname }}">
                </div>
            </div>
            <div class="form-group row justify-content-center d-flex">
                <label class="col-2 text-right">Descripción</label>
                <div class="col-4">
                <textarea class="form-control" rows="3" disabled value="{{ $project->description }}"></textarea>
                </div>
            </div>
            <div class="form-group row justify-content-center">
                <label class="col-2 text-right">Desde</label>
                <div class="col-4">
                    <input type="date" class="form-control form-control-sm" disabled value="{{ $project->from }}">
                </div>
                <label class="col-2 text-right">Hasta</label>
                <div class="col-4">
                    <input type="date" class="form-control form-control-sm" disabled value="{{ $project->to }}">
                </div>
            </div>
        </div>
    </div>
    <div class="mt-1">
        <a href="{{route('projects.index')}}">Volver al listado</a>
    </div>
</div>
@endsection
