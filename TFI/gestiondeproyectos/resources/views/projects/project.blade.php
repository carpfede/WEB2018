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
                <div class="col-10">
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
    <div class="card bg-light">
        <div class="card-body">
            <div class="row">
                <div class="col-2 border-right border-dark">
                    <div class="row">
                        <div class="col">
                            <div class="input-group">
                                <h5 class="card-title" aria-describedby="basic-addon2">Sprints</h5>
                                <div class="input-group-append ml-4">
                                    <a style="cursor:pointer;" data-toggle="modal" data-target="#sprintModal"><i class="fas fa-plus text-success"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach($project->sprints as $s)
                        <div class="row">
                            <div class="col">
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary">$s->version</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-10">
                    @php ($sprint = $project->sprints->last())
                    <h4 class="card-title">Tareas</h4>
                    @if($sprint != null)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th>Asignado a</th>
                                    <th>Tiempo restante</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sprints->tasks as $task)
                                    <tr>
                                        <td><a href=""><i class="fas fa-plus text-success"></i></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                    <div class="alert alert-primary">
                        Seleccione el sprint
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="mt-1">
        <a href="{{route('projects.index')}}">Volver al listado</a>
    </div>

    <div class="modal fade" id="sprintModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo sprint</h5>
                    <div class="form-grouop">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times"></i></button>
                        <button id="create-button" class="close" aria-hidden="true"><i class="far fa-save"></i></button>
                    </div>
                </div>
                <form action="{{route('sprints.store')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group row justify-content-center">
                            <label class="col-3 text-right">Número</label>
                            <div class="col-4">
                                <input type="text" class="form-control form-control-sm" name="name">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-3 text-right">Versión</label>
                            <div class="col-4">
                                <input type="text" class="form-control form-control-sm" name="shortname">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-3 text-right">Desde</label>
                            <div class="col-4">
                                <input type="date" class="form-control form-control-sm" name="from">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-3 text-right">Fin estimado</label>
                            <div class="col-4">
                                <input type="date" class="form-control form-control-sm" name="to">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
</style>
@endsection
