@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Proyectos</h4>
            <a href="{{route('projects.create')}}" class="float-right"><i class="fas fa-plus-circle fa-2x text-success"></i></i></a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Nombre corto</th>
                        <th>Descripción</th>
                        <th>Desde</th>
                        <th>Hasta</th>
                        <th>Versión</th>
                        <th>Miembros</th>
                        <th>Tareas</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td>{{$project->name}}</td>
                            <td>{{$project->shortname}}</td>
                            <td><p>{{$project->description}}</p></td>
                            <td>{{$project->from}}</td>
                            <td>{{$project->to}}</td>
                            <td class="text-center">{{@nullsafe($project->sprints->last()->version)}}</td>
                            <td class="text-center">{{$project->members->count()}}</td>
                            <td class="text-center">{{@nullsafe($project->sprints->last()->tasks->count())}}</td>
                            <td>
                                <a href="{{route('projects.show',$project->id)}}"><i class="far fa-eye text-secondary" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>  
@endsection